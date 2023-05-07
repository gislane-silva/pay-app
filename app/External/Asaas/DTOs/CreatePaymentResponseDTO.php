<?php

namespace App\External\Asaas\DTOs;

use App\Helpers\UtilsHelper;
use GuzzleHttp\Psr7\Response;

class CreatePaymentResponseDTO
{
    private string $id;
    private string $customer;

    private const FIELDS_REQUIRED = [
        'id',
        'customer'
    ];

    public function __construct(Response $response)
    {
        $data = json_decode($response->getBody()->getContents(), true);
        UtilsHelper::validateFields($data, self::FIELDS_REQUIRED);
        $this->setId($data['id']);
        $this->setCustomer($data['customer']);
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return CreatePaymentResponseDTO
     */
    public function setId(string $id): CreatePaymentResponseDTO
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getCustomer(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return CreatePaymentResponseDTO
     */
    public function setCustomer(string $name): CreatePaymentResponseDTO
    {
        $this->name = $name;
        return $this;
    }
}
