<?php

namespace App\External\Asaas\DTOs;

use App\Helpers\UtilsHelper;
use GuzzleHttp\Psr7\Response;

class PaymentLinkResponseDTO
{
    private string $url;

    private const FIELDS_REQUIRED = [
        'url'
    ];

    public function __construct(Response $response)
    {
        $data = json_decode($response->getBody()->getContents(), true);
        UtilsHelper::validateFields($data, self::FIELDS_REQUIRED);
        $this->setUrl($data['url']);
    }

    public function toArray(): array
    {
        return [
            'url' => $this->getUrl()
        ];
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return PaymentLinkResponseDTO
     */
    public function setUrl(string $url): PaymentLinkResponseDTO
    {
        $this->url = $url;
        return $this;
    }
}
