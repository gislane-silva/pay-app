<?php

namespace App\External\Asaas;

use App\External\Asaas\DTOs\CreateClientRequestDTO;
use App\External\Asaas\DTOs\CreateClientResponseDTO;
use App\External\Asaas\DTOs\CreatePaymentRequestDTO;
use App\External\Asaas\DTOs\CreatePaymentResponseDTO;
use GuzzleHttp\Client;
use Illuminate\Http\Response;

class AsaasAPI
{
    protected Client $client;
    const URI = "https://sandbox.asaas.com/api/v3/";

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => self::URI,
            'headers' => [
                "Content-Type" => "application/json",
                "access_token" => config('services.asaas.key')
            ]
        ]);
    }

    public function createClient(CreateClientRequestDTO $request)
    {
        $response = $this->client->post('customers', [
            'json' => $request->toArray()
        ]);

        if ($response->getStatusCode() == Response::HTTP_OK) {
            return new CreateClientResponseDTO($response);
        }

        return new \Exception('Erro ao criar cliente');
    }

    public function createPayment(CreatePaymentRequestDTO $request)
    {
        $response = $this->client->post('payments', [
            'json' => $request->toArray()
        ]);

        if ($response->getStatusCode() == Response::HTTP_OK) {
            return new CreatePaymentResponseDTO($response);
        }

        return new \Exception('Erro ao criar pagamento');
    }
}
