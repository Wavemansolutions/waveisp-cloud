<?php

namespace App\Services;

use App\Models\Router;
use Exception;
use RouterOS\Client;
use RouterOS\Config;
use RouterOS\Query;

class MikrotikService
{
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
                'message' => $e->getMessage(),
                'data' => [],
            ];
        }
    }

    public function client(Router $router): Client
    {
        $config = new Config([
            'host' => $router->ip_address,
            'user' => $router->username,
            'pass' => $router->password,
            'port' => (int) $router->api_port,
            'ssl' => (bool) $router->api_ssl,
            'timeout' => 8,
        ]);

        return new Client($config);
    }
}