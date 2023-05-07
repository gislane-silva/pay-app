<?php

namespace External\Asaas;

use App\Exceptions\PaymentErrorException;
use App\External\Asaas\AsaasAPI;
use App\External\Asaas\AsaasClient;
use App\External\Asaas\DTOs\CreateClientRequestDTO;
use App\External\Asaas\DTOs\CreateClientResponseDTO;
use App\External\Asaas\DTOs\CreatePaymentRequestDTO;
use App\External\Asaas\DTOs\CreatePaymentResponseDTO;
use App\External\Asaas\DTOs\PaymentLinkRequestDTO;
use App\External\Asaas\DTOs\PaymentLinkResponseDTO;
use App\External\Asaas\DTOs\PixQrCodeResponseDTO;
use App\External\Asaas\Enum\BillingTypeEnum;
use App\External\Asaas\Enum\ChargeTypeEnum;
use App\External\Common\ClientInterface;
use Faker\Factory;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Response as HttpCode;
use Tests\TestCase;

class AsaasAPITest extends TestCase
{
    private AsaasAPI $asaasAPI;
    public $faker;
    public function setUp(): void
    {
        parent::setUp();
        $this->faker = Factory::create();
    }

    public function testCreateClientSuccessfully()
    {
        $payload = '{
            "id": "cus_13bFHumeyglN",
            "name": "Teste"
        }';

        $request = (new CreateClientRequestDTO())->setName($this->faker->name)
            ->setCpfCnpj($this->faker->numerify('###########'));

        $this->initAsaasAPI($payload);

        $result = $this->asaasAPI->createClient($request);

        self::assertInstanceOf(CreateClientResponseDTO::class, $result);
    }

    public function testCreateClientWhenUnexpectError()
    {
        $payload = '{}';

        $request = (new CreateClientRequestDTO())->setName($this->faker->name)
            ->setCpfCnpj($this->faker->numerify('###########'));

        $this->initAsaasAPI($payload, HttpCode::HTTP_UNPROCESSABLE_ENTITY);

        self::expectException(PaymentErrorException::class);
        $this->asaasAPI->createClient($request);
    }

    public function testCreatePixPaymentSuccessfully()
    {
        $payload = '{
            "id": "pay_13bFHumeyglN",
            "customer": "cus_13bFHumeyglN"
        }';

        $request = (new CreatePaymentRequestDTO())->setCustomer($this->faker->text)
            ->setBillingType(BillingTypeEnum::BILLING_TYPE_PIX)
            ->setValue($this->faker->randomFloat(2, 0, 200))
            ->setDueDate("2023-05-06");

        $this->initAsaasAPI($payload);

        $result = $this->asaasAPI->createPayment($request);

        self::assertInstanceOf(CreatePaymentResponseDTO::class, $result);
    }

    public function testCreatePixPaymentWhenUnexpectError()
    {
        $payload = '{}';

        $request = (new CreatePaymentRequestDTO())->setCustomer($this->faker->text)
            ->setBillingType(BillingTypeEnum::BILLING_TYPE_PIX)
            ->setValue($this->faker->randomFloat(2, 0, 200))
            ->setDueDate("2023-05-06");

        $this->initAsaasAPI($payload, HttpCode::HTTP_UNPROCESSABLE_ENTITY);

        self::expectException(PaymentErrorException::class);
        $this->asaasAPI->createPayment($request);
    }

    public function testGenerateTicketLinkSuccessfully()
    {
        $payload = '{
            "url": "https://sandbox.asaas.com/c/553073424078"
        }';

        $request = (new PaymentLinkRequestDTO())->setValue('70,00')
            ->setBillingType(BillingTypeEnum::BILLING_TYPE_TICKET)
            ->setChargeType(ChargeTypeEnum::DETACHED)
            ->setName($this->faker->name)
            ->setDueDateLimitDays('10');

        $this->initAsaasAPI($payload);

        $result = $this->asaasAPI->generateTicketLink($request);

        self::assertInstanceOf(PaymentLinkResponseDTO::class, $result);
    }

    public function testGenerateTicketLinkWhenUnexpectError()
    {
        $payload = '{}';

        $request = (new PaymentLinkRequestDTO())->setValue('70,00')
            ->setBillingType(BillingTypeEnum::BILLING_TYPE_TICKET)
            ->setChargeType(ChargeTypeEnum::DETACHED)
            ->setName($this->faker->name)
            ->setDueDateLimitDays('10');

        $this->initAsaasAPI($payload, HttpCode::HTTP_UNPROCESSABLE_ENTITY);

        self::expectException(PaymentErrorException::class);
        $this->asaasAPI->generateTicketLink($request);
    }

    public function testGeneratePixQrCodeSuccessfully()
    {
        $payload = '{
            "encodedImage": "iVBORw0KGgoAAAANSUhEUgAAAMgAAADICAYAAACtWK6eAAAAAXNSR0IArs",
            "payload": "00020101021226730014br.gov.bcb.pix2551pix-h.asaas.com/pixqrcode"
        }';

        $this->initAsaasAPI($payload);

        $result = $this->asaasAPI->generatePixQrCode($this->faker->text);

        self::assertInstanceOf(PixQrCodeResponseDTO::class, $result);
    }

    public function testGeneratePixQrCodeWhenUnexpectError()
    {
        $payload = '{}';

        $this->initAsaasAPI($payload, HttpCode::HTTP_UNPROCESSABLE_ENTITY);

        self::expectException(PaymentErrorException::class);
        $this->asaasAPI->generatePixQrCode($this->faker->text);
    }

    private function initAsaasAPI(string $body, int $httpCode = HttpCode::HTTP_OK)
    {
        $this->asaasAPI = new AsaasAPI($this->mockClient($body, $httpCode));
    }

    private function mockClient(
        string $body,
        int $httpCode
    ): ClientInterface
    {
        $mock = new MockHandler([
            new Response($httpCode, ['X-Foo' => 'Bar'], $body)
        ]);

        $handlerStack = HandlerStack::create($mock);
        $client = new Client(['handler' => $handlerStack, 'http_errors' => false]);

        return (new AsaasClient())->setHttpClient($client);
    }
}
