<?php

namespace App\External\Asaas\DTOs;

class CreateClientRequestDTO
{
    private $name;
    private $cpfCnpj;

    public function toArray(): array
    {
        return [
            'name' => $this->getName(),
            'cpfCnpj' => $this->getCpfCnpj()
        ];
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return CreateClientRequestDTO
     */
    public function setName($name): CreateClientRequestDTO
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCpfCnpj()
    {
        return $this->cpfCnpj;
    }

    /**
     * @param mixed $cpfCnpj
     * @return CreateClientRequestDTO
     */
    public function setCpfCnpj($cpfCnpj): CreateClientRequestDTO
    {
        $this->cpfCnpj = $cpfCnpj;
        return $this;
    }
}
