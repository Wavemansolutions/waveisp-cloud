<?php

namespace App\Http\Controllers;

use App\Models\Router;
use App\Models\RouterJob;
use Illuminate\Http\Request;

class RouterAgentController extends Controller
{
    public function script(Request $request, Router $router)
    {
        $this->authorizeAgent($request, $router);

        $router->update([
            'last_seen_at' => now(),
        ]);

        $job = RouterJob::where('router_id', $router->id)
            ->where('status', 'pending')
            ->orderBy('id')
            ->first();

        if (! $job) {
            return response($this->noJobScript($router), 200)
                ->header('Content-Type', 'text/plain');
        }

        $job->increment('attempts');

        $job->update([
            'status' => 'processing',
            'locked_at' => now(),
        ]);

        return response($this->buildJobScript($job->fresh(['router', 'customer'])), 200)
            ->header('Content-Type', 'text/plain');
    }

    public function ack(Request $request, RouterJob $job)
    {
        $job->load(['router', 'customer']);

        $this->authorizeAgent($request, $job->router);

        $status = $request->query('status', 'completed');

        if ($status === 'completed') {
            $job->update([
                'status' => 'completed',
                'result' => 'Router reported job completed.',
                'completed_at' => now(),
            ]);

            if ($job->customer) {
                $job->customer->update([
                    'mikrotik_created' => true,
                    'mikrotik_created_at' => now(),
                    'mikrotik_error' => null,
                ]);
            }

            return response('OK');
        }

        $job->update([
            'status' => 'failed',
            'result' => 'Router reported job failed.',
            'completed_at' => now(),
        ]);

        if ($job->customer) {
            $job->customer->update([
                'mikrotik_created' => false,
                'mikrotik_error' => 'Router agent reported job failed.',
            ]);
        }

        return response('FAILED');
    }

    private function authorizeAgent(Request $request, Router $router): void
    {
        $token = (string) $request->query('token');

        if (blank($router->agent_token) || ! hash_equals((string) $router->agent_token, $token)) {
            abort(403, 'Invalid router agent token.');
        }
    }

    private function noJobScript(Router $router): string
    {
        return ':log info "WaveISP agent checked: no pending job for router ' . $router->id . '";';
    }

    private function buildJobScript(RouterJob $job): string
    {
        if ($job->job_type !== 'create_hotspot_user') {
            $failUrl = route('agent.ack', [
                'job' => $job,
                'token' => $job->router->agent_token,
                'status' => 'failed',
            ]);

            return ':log error "WaveISP unsupported job type"; /tool fetch url="' . $failUrl . '" keep-result=no;';
        }

        $payload = $job->payload ?? [];

        $username = $this->ros($payload['username'] ?? '');
        $password = $this->ros($payload['password'] ?? '');
        $profile = $this->ros($payload['profile'] ?? 'WAVEISP-2M');
        $limitBytes = (int) ($payload['limit_bytes_total'] ?? 0);
        $comment = $this->ros($payload['comment'] ?? ('WaveISP job #' . $job->id));
        $macAddress = $this->ros($payload['mac_address'] ?? '');

        $macAdd = blank($macAddress) ? '' : ' mac-address="' . $macAddress . '"';

        $successUrl = route('agent.ack', [
            'job' => $job,
            'token' => $job->router->agent_token,
            'status' => 'completed',
        ]);

        $failUrl = route('agent.ack', [
            'job' => $job,
            'token' => $job->router->agent_token,
            'status' => 'failed',
        ]);

        return <<<RSC
:log info "WaveISP job {$job->id} started";
:do {
    :local username "{$username}";
    :local userId [/ip hotspot user find where name=\$username];

    :if ([:len \$userId] = 0) do={
        /ip hotspot user add name="{$username}" password="{$password}" profile="{$profile}" limit-bytes-total={$limitBytes} disabled=no comment="{$comment}"{$macAdd};
    } else={
        /ip hotspot user set \$userId password="{$password}" profile="{$profile}" limit-bytes-total={$limitBytes} disabled=no comment="{$comment}"{$macAdd};
    }

    /tool fetch url="{$successUrl}" keep-result=no;
    :log info "WaveISP job {$job->id} completed";
} on-error={
    /tool fetch url="{$failUrl}" keep-result=no;
    :log error "WaveISP job {$job->id} failed";
}
RSC;
    }

    private function ros(string $value): string
    {
        return str_replace(['\\', '"'], ['\\\\', '\"'], $value);
    }
}