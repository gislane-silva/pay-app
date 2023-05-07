<?php

namespace App\External\Asaas;

use App\Exceptions\PaymentError;
use App\External\Asaas\DTOs\CreateClientRequestDTO;
use App\External\Asaas\DTOs\CreateClientResponseDTO;
use App\External\Asaas\DTOs\CreatePaymentRequestDTO;
use App\External\Asaas\DTOs\CreatePaymentResponseDTO;
use App\External\Asaas\DTOs\PixQrCodeResponseDTO;
use App\External\Asaas\DTOs\TicketResponseDTO;
use Exception;
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

    /**
     * @param CreateClientRequestDTO $request
     * @return CreateClientResponseDTO
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function createClient(CreateClientRequestDTO $request): CreateClientResponseDTO
    {
        $response = $this->client->post('customers', [
            'json' => $request->toArray()
        ]);

        if ($response->getStatusCode() == Response::HTTP_OK) {
            return new CreateClientResponseDTO($response);
        }

        throw new PaymentError('Erro ao criar cliente');
    }

    /**
     * @param CreatePaymentRequestDTO $request
     * @return CreatePaymentResponseDTO
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function createPayment(CreatePaymentRequestDTO $request): CreatePaymentResponseDTO
    {
        $response = $this->client->post('payments', [
            'json' => $request->toArray()
        ]);

        if ($response->getStatusCode() == Response::HTTP_OK) {
            return new CreatePaymentResponseDTO($response);
        }

        throw new PaymentError('Erro ao criar pagamento');
    }

    public function generateTicket(string $idPayment)
    {
        $response = $this->client->get(sprintf('payments/%s/identificationField', $idPayment));

        if ($response->getStatusCode() == Response::HTTP_OK) {
            return new TicketResponseDTO($response);
        }

        throw new PaymentError('Erro ao gerar boleto');
    }

    public function generatePixQrCode(string $idPayment)
    {
        $response = $this->client->get(sprintf('payments/%s/pixQrCode', $idPayment));

        if ($response->getStatusCode() == Response::HTTP_OK) {
            return new PixQrCodeResponseDTO($response);
        }

        throw new PaymentError('Erro ao gerar QrCode');
    }
}
