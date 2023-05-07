<?php

namespace Tests\Unit\app\Services;

use App\DTOs\RequestDTO;
use App\External\Asaas\AsaasAPI;
use App\External\Asaas\DTOs\CreateClientResponseDTO;
use App\External\Asaas\DTOs\CreatePaymentResponseDTO;
use App\External\Asaas\DTOs\PaymentLinkResponseDTO;
use App\External\Asaas\DTOs\PixQrCodeResponseDTO;
use App\External\Asaas\Enum\BillingTypeEnum;
use App\External\Asaas\Enum\PaymentMethodEnum;
use App\External\Common\ResponseDTOInterface;
use App\Services\PaymentService;
use Faker\Factory;
use GuzzleHttp\Psr7\Response;
use Tests\TestCase;

class PaymentServiceTest extends TestCase
{
    public AsaasAPI $asaasAPI;
    private PaymentService $paymentService;
    public $faker;

    public function setUp(): void
    {
        parent::setUp();
        $this->asaasAPI = \Mockery::mock(AsaasAPI::class);
        $this->paymentService = new PaymentService($this->asaasAPI);
        $this->faker = Factory::create();
    }

    /**
     * @dataProvider providerPaymentMethod
     */
    public function testProcessSuccessfully(string $billingType, string $paymentMethod)
    {
        $this->asaasAPI->shouldReceive('createClient')->andReturn(
            (new CreateClientResponseDTO($this->mockResponseCreateClient()))
        );

        $this->asaasAPI->shouldReceive('createPayment')->andReturn(
            (new CreatePaymentResponseDTO($this->mockResponseCreatePayment()))
        );

        if ($billingType == BillingTypeEnum::BILLING_TYPE_CREDIT_CARD) {
            $result = $this->paymentService->process($this->mockRequestDTO($billingType, $paymentMethod));
            self::assertEquals(null, $result);
            return;
        }

        if ($billingType == BillingTypeEnum::BILLING_TYPE_TICKET) {
            $this->asaasAPI->shouldReceive('generateTicketLink')->andReturn(
                (new PaymentLinkResponseDTO($this->mockResponseGenerateTicketLink()))
            );
        }

        if ($billingType == BillingTypeEnum::BILLING_TYPE_PIX) {
            $this->asaasAPI->shouldReceive('generatePixQrCode')->andReturn(
                (new PixQrCodeResponseDTO($this->mockResponseGeneratePixQrCode()))
            );
        }

        $result = $this->paymentService->process($this->mockRequestDTO($billingType, $paymentMethod));
        self::assertInstanceOf(ResponseDTOInterface::class, $result);
    }

    public function providerPaymentMethod(): \Generator
    {
        yield 'CARD' => [BillingTypeEnum::BILLING_TYPE_CREDIT_CARD, PaymentMethodEnum::CARD];
        yield 'PIX' => [BillingTypeEnum::BILLING_TYPE_PIX, PaymentMethodEnum::PIX];
        yield 'TICKET' => [BillingTypeEnum::BILLING_TYPE_TICKET, PaymentMethodEnum::TICKET];
    }

    private function mockResponseCreateClient(): Response
    {
        return new Response(
            200,
            ['Content-Type' => 'application/json'],
            '{"id": "cus_1FHJl2312", "name": "Teste"}'
        );
    }

    private function mockResponseCreatePayment(): Response
    {
        return new Response(
            200,
            ['Content-Type' => 'application/json'],
            '{"id": "pay_1FHJl2312", "customer": "cus_1FHJl2312"}'
        );
    }

    private function mockResponseGeneratePixQrCode(): Response
    {
        return new Response(
            200,
            ['Content-Type' => 'application/json'],
            '{"encodedImage": "iVBORw0KGgoAAAANSUhEUgAAAMgAAADICAYAAACtWK6eAAAAAXNSR0IArs", "payload": "00020101021226730014br.gov.bcb.pix2551pix-h.asaas.com/pixqrcode"}'
        );
    }

    private function mockResponseGenerateTicketLink(): Response
    {
        return new Response(
            200,
            ['Content-Type' => 'application/json'],
            '{"url": "https://sandbox.asaas.com/c/553073424078"}'
        );
    }

    private function mockRequestDTO(string $billingType, string $paymentMethod): RequestDTO
    {
        $request = (new RequestDTO())->setName($this->faker->name)
            ->setValue('10')
            ->setEmail('teste@gmail.com')
            ->setCpf('123.456.178.00')
            ->setPhone('(77) 97777-7777')
            ->setPaymentMethod($paymentMethod);

        if ($billingType == BillingTypeEnum::BILLING_TYPE_CREDIT_CARD) {
            $request->setHolderName($this->faker->name)
                ->setNumber('5433219535504908')
                ->setExpiryMonth('05')
                ->setExpiryYear('2024')
                ->setCvv('123')
                ->setPostalCode('81000-000')
                ->setAddressNumber('1234')
                ->setAddressComplement('Apartamento')
                ->setInstallmentCount(1);
        }

        return $request;
    }
}
