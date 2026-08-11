<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Router;
use App\Models\RouterJob;
use App\Services\MikrotikService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RouterController extends Controller
{
    public function index()
    {
        $routers = Router::latest()->get();

        return view('admin.routers.index', compact('routers'));
    }

    public function create()
    {
        return view('admin.routers.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'ip_address' => ['required', 'string', 'max:120'],
            'api_port' => ['required', 'integer', 'min:1', 'max:65535'],
            'username' => ['required', 'string', 'max:120'],
            'password' => ['required', 'string', 'max:255'],
            'location' => ['nullable', 'string', 'max:160'],
            'api_ssl' => ['nullable'],
            'is_active' => ['nullable'],
        ]);

        $data['api_ssl'] = $request->boolean('api_ssl');
        $data['is_active'] = $request->boolean('is_active');
        $data['sync_mode'] = 'agent';
        $data['agent_token'] = Str::random(48);

        Router::create($data);

        return redirect()
            ->route('admin.routers.index')
            ->with('success', 'Router added successfully.');
    }

    public function edit(Router $router)
    {
        return view('admin.routers.edit', compact('router'));
    }

    public function update(Request $request, Router $router)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'ip_address' => ['required', 'string', 'max:120'],
            'api_port' => ['required', 'integer', 'min:1', 'max:65535'],
            'username' => ['required', 'string', 'max:120'],
            'password' => ['nullable', 'string', 'max:255'],
            'location' => ['nullable', 'string', 'max:160'],
            'api_ssl' => ['nullable'],
            'is_active' => ['nullable'],
        ]);

        if (blank($data['password'] ?? null)) {
            unset($data['password']);
        }

        $data['api_ssl'] = $request->boolean('api_ssl');
        $data['is_active'] = $request->boolean('is_active');
        $data['sync_mode'] = $router->sync_mode ?: 'agent';

        if (blank($router->agent_token)) {
            $data['agent_token'] = Str::random(48);
        }

        $router->update($data);

        return redirect()
            ->route('admin.routers.index')
            ->with('success', 'Router updated successfully.');
    }

    public function destroy(Router $router)
    {
        $router->delete();

        return redirect()
            ->route('admin.routers.index')
            ->with('success', 'Router deleted successfully.');
    }

    public function test(Router $router, MikrotikService $mikrotik)
    {
        $result = $mikrotik->testConnection($router);

        return redirect()
            ->route('admin.routers.index')
            ->with($result['success'] ? 'success' : 'error', $result['message'])
            ->with('mikrotik_data', $result['data']);
    }

    public function agent(Router $router)
    {
        if (blank($router->agent_token)) {
            $router->update([
                'sync_mode' => 'agent',
                'agent_token' => Str::random(48),
            ]);
        }

        $router->loadCount([
            'jobs as pending_jobs_count' => fn ($query) => $query->where('status', 'pending'),
            'jobs as processing_jobs_count' => fn ($query) => $query->where('status', 'processing'),
            'jobs as completed_jobs_count' => fn ($query) => $query->where('status', 'completed'),
            'jobs as failed_jobs_count' => fn ($query) => $query->where('status', 'failed'),
        ]);

        $jobs = RouterJob::where('router_id', $router->id)
            ->with('customer')
            ->latest()
            ->limit(20)
            ->get();

        $agentUrl = route('agent.script', [
            'router' => $router,
            'token' => $router->agent_token,
        ]);

        return view('admin.routers.agent', compact('router', 'jobs', 'agentUrl'));
    }

    public function regenerateAgentToken(Router $router)
    {
        $router->update([
            'sync_mode' => 'agent',
            'agent_token' => Str::random(48),
        ]);

        return redirect()
            ->route('admin.routers.agent', $router)
            ->with('success', 'Router agent token regenerated successfully.');
    }
}