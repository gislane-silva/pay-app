<?php

namespace App\External\Asaas;

use App\Exceptions\PaymentErrorException;
use App\External\Asaas\DTOs\CreateClientRequestDTO;
use App\External\Asaas\DTOs\CreateClientResponseDTO;
use App\External\Asaas\DTOs\CreatePaymentRequestDTO;
use App\External\Asaas\DTOs\CreatePaymentResponseDTO;
use App\External\Asaas\DTOs\PaymentLinkRequestDTO;
use App\External\Asaas\DTOs\PixQrCodeResponseDTO;
use App\External\Asaas\DTOs\PaymentLinkResponseDTO;
use GuzzleHttp\Client;
use Illuminate\Http\Response;

class AsaasAPI
{
    protected Client $client;

    public function __construct(AsaasClient $client)
    {
        $this->client = $client->getHttpClient();
    }

    public function createClient(CreateClientRequestDTO $request): CreateClientResponseDTO
    {
        $response = $this->client->post('customers', [
            'json' => $request->toArray()
        ]);

        if ($response->getStatusCode() == Response::HTTP_OK) {
            return new CreateClientResponseDTO($response);
        }

        throw new PaymentErrorException('Erro ao criar cliente');
    }

    public function createPayment(CreatePaymentRequestDTO $request): CreatePaymentResponseDTO
    {
        $response = $this->client->post('payments', [
            'json' => $request->toArray()
        ]);

        if ($response->getStatusCode() == Response::HTTP_OK) {
            return new CreatePaymentResponseDTO($response);
        }

        throw new PaymentErrorException('Erro ao criar pagamento');
    }

    public function generateTicketLink(PaymentLinkRequestDTO $request): PaymentLinkResponseDTO
    {
        $response = $this->client->post('paymentLinks',[
            'json' => $request->toArray()
        ]);

        if ($response->getStatusCode() == Response::HTTP_OK) {
            return new PaymentLinkResponseDTO($response);
        }

        throw new PaymentErrorException('Erro ao gerar link do boleto');
    }

    public function generatePixQrCode(string $idPayment): PixQrCodeResponseDTO
    {
        $response = $this->client->get(sprintf('payments/%s/pixQrCode', $idPayment));

        if ($response->getStatusCode() == Response::HTTP_OK) {
            return new PixQrCodeResponseDTO($response);
        }

        throw new PaymentErrorException('Erro ao gerar QrCode');
    }
}
