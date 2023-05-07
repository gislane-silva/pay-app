<?php

namespace App\External\Asaas\DTOs;

class CreditCardDTO
{
    private string $name;
    private string $email;
    private string $cpfCnpj;
    private string $postalCode;
    private string $addressNumber;
    private string $addressComplement;
    private string $phone;

    public function toArray(): array
    {
        return [
            'name' => $this->getName(),
            'email' => $this->getEmail(),
            'cpfCnpj' => $this->getCpfCnpj(),
            'postalCode' => $this->getPostalCode(),
            'addressNumber' => $this->getAddressNumber(),
            'addressComplement' => $this->getAddressComplement(),
            'phone' => $this->phone
        ];
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
     * @return CreditCardDTO
     */
    public function setName(string $name): CreditCardDTO
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return CreditCardDTO
     */
    public function setEmail(string $email): CreditCardDTO
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getCpfCnpj(): string
    {
        return $this->cpfCnpj;
    }

    /**
     * @param string $cpfCnpj
     * @return CreditCardDTO
     */
    public function setCpfCnpj(string $cpfCnpj): CreditCardDTO
    {
        $this->cpfCnpj = $cpfCnpj;
        return $this;
    }

    /**
     * @return string
     */
    public function getPostalCode(): string
    {
        return $this->postalCode;
    }

    /**
     * @param string $postalCode
     * @return CreditCardDTO
     */
    public function setPostalCode(string $postalCode): CreditCardDTO
    {
        $this->postalCode = $postalCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddressNumber(): string
    {
        return $this->addressNumber;
    }

    /**
     * @param string $addressNumber
     * @return CreditCardDTO
     */
    public function setAddressNumber(string $addressNumber): CreditCardDTO
    {
        $this->addressNumber = $addressNumber;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddressComplement(): string
    {
        return $this->addressComplement;
    }

    /**
     * @param string $addressComplement
     * @return CreditCardDTO
     */
    public function setAddressComplement(string $addressComplement): CreditCardDTO
    {
        $this->addressComplement = $addressComplement;
        return $this;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     * @return CreditCardDTO
     */
    public function setPhone(string $phone): CreditCardDTO
    {
        $this->phone = $phone;
        return $this;
    }
}
