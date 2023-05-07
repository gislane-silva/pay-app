<?php

namespace App\External\Asaas;


use App\External\Common\ClientInterface;
use GuzzleHttp\Client;

class AsaasClient implements ClientInterface
{
    const URI = "https://sandbox.asaas.com/api/v3/";

    private Client $client;

    public function getHttpClient(): Client
    {
        if (!empty($this->client)) {
            return $this->client;
        }

        return new Client($this->getConfig());
    }

    public function setHttpClient(Client $client): AsaasClient
    {
        $this->client = $client;
        return $this;
    }

    private function getConfig(): array
    {
        return [
            'base_uri' => self::URI,
            'http_errors' => false,
            'headers' => [
                "Content-Type" => "application/json",
                "access_token" => config('services.asaas.key')
            ]
        ];
    }
}
