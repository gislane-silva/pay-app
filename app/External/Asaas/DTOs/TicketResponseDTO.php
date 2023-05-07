<?php

namespace App\External\Asaas\DTOs;

use App\Helpers\UtilsHelper;
use GuzzleHttp\Psr7\Response;

class TicketResponseDTO
{
    private string $barCode;

    private const FIELDS_REQUIRED = [
        'barCode'
    ];

    public function __construct(Response $response)
    {
        $data = json_decode($response->getBody()->getContents(), true);
        UtilsHelper::validateFields($data, self::FIELDS_REQUIRED);
        $this->setBarCode($data['barCode']);
    }

    public function toArray(): array
    {
        return [
            'barCode' => $this->getBarCode()
        ];
    }

    /**
     * @return string
     */
    public function getBarCode(): string
    {
        return $this->barCode;
    }

    /**
     * @param string $barCode
     * @return TicketResponseDTO
     */
    public function setBarCode(string $barCode): TicketResponseDTO
    {
        $this->barCode = $barCode;
        return $this;
    }
}
