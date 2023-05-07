<?php

namespace App\External\Asaas\DTOs;

class CreditCardHolderInfoDTO
{
    private string $holderName;
    private string $number;
    private string $expiryMonth;
    private string $expiryYear;
    private string $cvv;

    public function toArray(): array
    {
        return [
            'holderName' => $this->getHolderName(),
            'number' => $this->getNumber(),
            'expiryMonth' => $this->getExpiryMonth(),
            'expiryYear' => $this->getExpiryYear(),
            'cvv' => $this->getCvv()
        ];
    }

    /**
     * @return string
     */
    public function getHolderName(): string
    {
        return $this->holderName;
    }

    /**
     * @param string $holderName
     * @return CreditCardHolderInfoDTO
     */
    public function setHolderName(string $holderName): CreditCardHolderInfoDTO
    {
        $this->holderName = $holderName;
        return $this;
    }

    /**
     * @return string
     */
    public function getNumber(): string
    {
        return $this->number;
    }

    /**
     * @param string $number
     * @return CreditCardHolderInfoDTO
     */
    public function setNumber(string $number): CreditCardHolderInfoDTO
    {
        $this->number = $number;
        return $this;
    }

    /**
     * @return string
     */
    public function getExpiryMonth(): string
    {
        return $this->expiryMonth;
    }

    /**
     * @param string $expiryMonth
     * @return CreditCardHolderInfoDTO
     */
    public function setExpiryMonth(string $expiryMonth): CreditCardHolderInfoDTO
    {
        $this->expiryMonth = $expiryMonth;
        return $this;
    }

    /**
     * @return string
     */
    public function getExpiryYear(): string
    {
        return $this->expiryYear;
    }

    /**
     * @param string $expiryYear
     * @return CreditCardHolderInfoDTO
     */
    public function setExpiryYear(string $expiryYear): CreditCardHolderInfoDTO
    {
        $this->expiryYear = $expiryYear;
        return $this;
    }

    /**
     * @return string
     */
    public function getCvv(): string
    {
        return $this->cvv;
    }

    /**
     * @param string $cvv
     * @return CreditCardHolderInfoDTO
     */
    public function setCvv(string $cvv): CreditCardHolderInfoDTO
    {
        $this->cvv = $cvv;
        return $this;
    }
}
