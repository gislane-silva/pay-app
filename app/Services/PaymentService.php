<?php

namespace App\Services;

use App\DTOs\RequestDTO;
use App\External\Asaas\AsaasAPI;
use App\External\Asaas\DTOs\CreateClientRequestDTO;
use App\External\Asaas\DTOs\CreateClientResponseDTO;
use App\External\Asaas\DTOs\CreatePaymentRequestDTO;
use App\External\Asaas\DTOs\CreatePaymentResponseDTO;
use App\External\Asaas\DTOs\CreditCardDTO;
use App\External\Asaas\DTOs\CreditCardHolderInfoDTO;
use App\External\Asaas\Enum\BillingTypeEnum;
use App\External\Asaas\Enum\PaymentMethodEnum;
use Carbon\Carbon;

class PaymentService
{
    private RequestDTO $requestDTO;
    private CreateClientResponseDTO $createClientResponseDTO;
    private CreatePaymentResponseDTO $createPaymentResponseDTO;
    private AsaasAPI $asaasAPI;

    public function __construct(AsaasAPI $asaasAPI)
    {
        $this->asaasAPI = $asaasAPI;
    }

    public function process(RequestDTO $requestDTO)
    {
        $this->requestDTO = $requestDTO;
        $this->createClient();
        return $this->createPayment();
    }

    private function createClient()
    {
        $this->createClientResponseDTO = $this->asaasAPI->createClient($this->prepareClientRequest());
    }

    private function createPayment()
    {
        $this->createPaymentResponseDTO = $this->asaasAPI->createPayment($this->preparePaymentRequest());

        if ($this->requestDTO->getPaymentMethod() == PaymentMethodEnum::PIX) {
            return $this->asaasAPI->generatePixQrCode($this->createPaymentResponseDTO->getId());
        }

        if ($this->requestDTO->getPaymentMethod() == PaymentMethodEnum::TICKET) {
            return $this->asaasAPI->generateTicket($this->createPaymentResponseDTO->getId());
        }

        return null;
    }

    private function prepareClientRequest(): CreateClientRequestDTO
    {
        $request = new CreateClientRequestDTO();
        $request->setName($this->requestDTO->getName())
            ->setCpfCnpj($this->requestDTO->getCpf());

        return $request;
    }

    private function preparePaymentRequest(): CreatePaymentRequestDTO
    {
        $request = new CreatePaymentRequestDTO();
        $request->setCustomer($this->createClientResponseDTO->getId())
            ->setBillingType(BillingTypeEnum::getBillingType($this->requestDTO->getPaymentMethod()))
            ->setDueDate(Carbon::now()->format('Y-m-d'))
            ->setValue($this->requestDTO->getValue());

        if ($this->requestDTO->getPaymentMethod() == PaymentMethodEnum::CARD) {
            $installmentValue = $this->requestDTO->getValue()/$this->requestDTO->getInstallmentCount();
            $request->setInstallmentCount($this->requestDTO->getInstallmentCount())
                ->setInstallmentValue($installmentValue)
                ->setCreditCard($this->prepareCreditCard())
                ->setCreditCardHolderInfo($this->prepareCreditCardHolderInfo());
        }

        return $request;
    }

    private function prepareCreditCard(): CreditCardDTO
    {
        $request = new CreditCardDTO();
        $request->setCpfCnpj($this->requestDTO->getCpf())
            ->setName($this->requestDTO->getName())
            ->setEmail($this->requestDTO->getEmail())
            ->setPostalCode($this->requestDTO->getPostalCode())
            ->setAddressNumber($this->requestDTO->getAddressNumber())
            ->setAddressComplement($this->requestDTO->getAddressComplement())
            ->setPhone($this->requestDTO->getPhone());

        return $request;
    }

    private function prepareCreditCardHolderInfo(): CreditCardHolderInfoDTO
    {
        $request = new CreditCardHolderInfoDTO();
        $request->setHolderName($this->requestDTO->getHolderName())
            ->setNumber($this->requestDTO->getNumber())
            ->setExpiryMonth($this->requestDTO->getExpiryMonth())
            ->setExpiryYear($this->requestDTO->getExpiryYear())
            ->setCvv($this->requestDTO->getCvv());

        return $request;
    }
}
