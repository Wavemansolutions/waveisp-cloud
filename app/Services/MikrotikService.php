<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\Router;
use Exception;
use RouterOS\Client;
use RouterOS\Config;
use RouterOS\Query;

class MikrotikService
{
    public function client(Router $router): Client
    {
        $config = new Config([
            'host' => $router->ip_address,
            'user' => $router->username,
            'pass' => $router->password,
            'port' => (int) $router->api_port,
            'ssl' => (bool) $router->api_ssl,
            'timeout' => 10,
        ]);

        return new Client($config);
    }

    public function testConnection(Router $router): array
    {
        try {
            $client = $this->client($router);

            $response = $client->query(new Query('/system/resource/print'))->read();

            return [
                'success' => true,
                'message' => 'MikroTik connection successful.',
                'data' => $response[0] ?? [],
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => 'MikroTik connection failed: ' . $e->getMessage(),
                'data' => [],
            ];
        }
    }

    public function createOrUpdateHotspotUser(Customer $customer): array
    {
        try {
            $customer->loadMissing(['router', 'plan']);

            if (! $customer->router) {
                throw new Exception('No router assigned to this customer.');
            }

            if (! $customer->plan) {
                throw new Exception('No plan assigned to this customer.');
            }

            if (blank($customer->username) || blank($customer->password)) {
                throw new Exception('Customer username or password is empty.');
            }

            $client = $this->client($customer->router);

            $profile = $customer->plan->mikrotik_profile ?: 'WAVEISP-2M';
            $limitBytes = (int) $customer->plan->data_limit_mb * 1024 * 1024;

            $existing = $this->findHotspotUser($client, $customer->username);

            $comment = 'WaveISP customer #' . $customer->id . ' - ' . ($customer->phone ?? 'no phone');

            if ($existing) {
                $query = (new Query('/ip/hotspot/user/set'))
                    ->equal('.id', $existing['.id'])
                    ->equal('name', $customer->username)
                    ->equal('password', $customer->password)
                    ->equal('profile', $profile)
                    ->equal('limit-bytes-total', (string) $limitBytes)
                    ->equal('disabled', 'no')
                    ->equal('comment', $comment);

                if (! blank($customer->mac_address)) {
                    $query->equal('mac-address', $customer->mac_address);
                }

                $client->query($query)->read();
            } else {
                $query = (new Query('/ip/hotspot/user/add'))
                    ->equal('name', $customer->username)
                    ->equal('password', $customer->password)
                    ->equal('profile', $profile)
                    ->equal('limit-bytes-total', (string) $limitBytes)
                    ->equal('disabled', 'no')
                    ->equal('comment', $comment);

                if (! blank($customer->mac_address)) {
                    $query->equal('mac-address', $customer->mac_address);
                }

                $client->query($query)->read();
            }

            $verify = $this->findHotspotUser($client, $customer->username);

            if (! $verify) {
                throw new Exception('HotSpot user was not found after creation attempt.');
            }

            return [
                'success' => true,
                'message' => 'MikroTik HotSpot user created/updated successfully.',
                'data' => $verify,
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => 'MikroTik sync failed: ' . $e->getMessage(),
                'data' => [],
            ];
        }
    }

    public function disableHotspotUser(Customer $customer): array
    {
        try {
            $customer->loadMissing('router');

            if (! $customer->router) {
                throw new Exception('No router assigned to this customer.');
            }

            $client = $this->client($customer->router);

            $existing = $this->findHotspotUser($client, $customer->username);

            if (! $existing) {
                throw new Exception('HotSpot user not found on MikroTik.');
            }

            $client->query(
                (new Query('/ip/hotspot/user/set'))
                    ->equal('.id', $existing['.id'])
                    ->equal('disabled', 'yes')
            )->read();

            return [
                'success' => true,
                'message' => 'HotSpot user disabled successfully.',
                'data' => [],
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => 'Disable failed: ' . $e->getMessage(),
                'data' => [],
            ];
        }
    }

    public function removeHotspotUser(Customer $customer): array
    {
        try {
            $customer->loadMissing('router');

            if (! $customer->router) {
                throw new Exception('No router assigned to this customer.');
            }

            $client = $this->client($customer->router);

            $existing = $this->findHotspotUser($client, $customer->username);

            if (! $existing) {
                return [
                    'success' => true,
                    'message' => 'Customer not found on MikroTik. Nothing to remove.',
                    'data' => [],
                ];
            }

            $client->query(
                (new Query('/ip/hotspot/user/remove'))
                    ->equal('.id', $existing['.id'])
            )->read();

            return [
                'success' => true,
                'message' => 'HotSpot user removed successfully.',
                'data' => [],
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => 'Remove failed: ' . $e->getMessage(),
                'data' => [],
            ];
        }
    }

    private function findHotspotUser(Client $client, string $username): ?array
    {
        $response = $client->query(
            (new Query('/ip/hotspot/user/print'))
                ->where('name', $username)
        )->read();

        return $response[0] ?? null;
    }
}