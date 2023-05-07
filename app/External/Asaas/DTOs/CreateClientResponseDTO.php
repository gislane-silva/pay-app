<?php

namespace App\External\Asaas\DTOs;

use App\Helpers\UtilsHelper;
use GuzzleHttp\Psr7\Response;

class CreateClientResponseDTO
{
    private string $id;
    private string $name;

    private const FIELDS_REQUIRED = [
        'id',
        'name'
    ];

    public function __construct(Response $response)
    {
        $data = json_decode($response->getBody()->getContents(), true);
        UtilsHelper::validateFields($data, self::FIELDS_REQUIRED);
        $this->setId($data['id']);
        $this->setName($data['name']);
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
     * @return CreateClientResponseDTO
     */
    public function setId(string $id): CreateClientResponseDTO
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return CreateClientResponseDTO
     */
    public function setName(string $name): CreateClientResponseDTO
    {
        $this->name = $name;
        return $this;
    }
}
