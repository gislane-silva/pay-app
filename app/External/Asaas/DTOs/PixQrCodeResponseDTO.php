<?php

namespace App\External\Asaas\DTOs;

use App\External\Common\ResponseDTOInterface;
use App\Helpers\UtilsHelper;
use GuzzleHttp\Psr7\Response;

class PixQrCodeResponseDTO implements ResponseDTOInterface
{
    private string $encodedImage;
    private string $payload;

    private const FIELDS_REQUIRED = [
        'encodedImage',
        'payload'
    ];

    public function __construct(Response $response)
    {
        $data = json_decode($response->getBody()->getContents(), true);
        UtilsHelper::validateFields($data, self::FIELDS_REQUIRED);
        $this->setEncodedImage($data['encodedImage']);
        $this->setPayload($data['payload']);
    }

    public function toArray(): array
    {
        return [
            'encodedImage' => $this->getEncodedImage(),
            'payload' => $this->getPayload()
        ];
    }

    /**
     * @return string
     */
    public function getEncodedImage(): string
    {
        return $this->encodedImage;
    }

    /**
     * @param string $encodedImage
     * @return PixQrCodeResponseDTO
     */
    public function setEncodedImage(string $encodedImage): PixQrCodeResponseDTO
    {
        $this->encodedImage = $encodedImage;
        return $this;
    }

    /**
     * @return string
     */
    public function getPayload(): string
    {
        return $this->payload;
    }

    /**
     * @param string $payload
     * @return PixQrCodeResponseDTO
     */
    public function setPayload(string $payload): PixQrCodeResponseDTO
    {
        $this->payload = $payload;
        return $this;
    }
}
