<?php

namespace App\External\Asaas\DTOs;

class CreatePaymentRequestDTO
{
    private string $customer;
    private string $billingType;
    private float $value;
    private string $dueDate;
    private ?int $installmentCount = null;
    private ?float $installmentValue = null;
    private ?CreditCardDTO $creditCard = null;
    private ?CreditCardHolderInfoDTO $creditCardHolderInfo = null;

    public function toArray(): array
    {
        $payload = [
            'customer' => $this->getCustomer(),
            'billingType' => $this->getBillingType(),
            'value' => $this->getValue(),
            'dueDate' => $this->getDueDate(),
        ];

        if (!is_null($this->getInstallmentValue())) {
            $payload['installmentValue'] = $this->getInstallmentValue();
        }

        if (!is_null($this->getInstallmentCount())) {
            $payload['installmentCount'] = $this->getInstallmentCount();
        }

        if (!is_null($this->getCreditCard())) {
            $payload['creditCard'] = $this->getCreditCard()->toArray();
        }

        if (!is_null($this->getCreditCardHolderInfo())) {
            $payload['creditCardHolderInfo'] = $this->getCreditCardHolderInfo()->toArray();
        }

        return $payload;
    }

    /**
     * @return string
     */
    public function getCustomer(): string
    {
        return $this->customer;
    }

    /**
     * @param string $customer
     * @return CreatePaymentRequestDTO
     */
    public function setCustomer(string $customer): CreatePaymentRequestDTO
    {
        $this->customer = $customer;
        return $this;
    }

    /**
     * @return string
     */
    public function getBillingType(): string
    {
        return $this->billingType;
    }

    /**
     * @param string $billingType
     * @return CreatePaymentRequestDTO
     */
    public function setBillingType(string $billingType): CreatePaymentRequestDTO
    {
        $this->billingType = $billingType;
        return $this;
    }

    /**
     * @return float
     */
    public function getValue(): float
    {
        return $this->value;
    }

    /**
     * @param float $value
     * @return CreatePaymentRequestDTO
     */
    public function setValue(float $value): CreatePaymentRequestDTO
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @return string
     */
    public function getDueDate(): string
    {
        return $this->dueDate;
    }

    /**
     * @param string $dueDate
     * @return CreatePaymentRequestDTO
     */
    public function setDueDate(string $dueDate): CreatePaymentRequestDTO
    {
        $this->dueDate = $dueDate;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getInstallmentCount(): ?int
    {
        return $this->installmentCount;
    }

    /**
     * @param int|null $installmentCount
     * @return CreatePaymentRequestDTO
     */
    public function setInstallmentCount(?int $installmentCount): CreatePaymentRequestDTO
    {
        $this->installmentCount = $installmentCount;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getInstallmentValue(): ?float
    {
        return $this->installmentValue;
    }

    /**
     * @param float|null $installmentValue
     * @return CreatePaymentRequestDTO
     */
    public function setInstallmentValue(?float $installmentValue): CreatePaymentRequestDTO
    {
        $this->installmentValue = $installmentValue;
        return $this;
    }

    /**
     * @return CreditCardDTO|null
     */
    public function getCreditCard(): ?CreditCardDTO
    {
        return $this->creditCard;
    }

    /**
     * @param CreditCardDTO|null $creditCard
     * @return CreatePaymentRequestDTO
     */
    public function setCreditCard(?CreditCardDTO $creditCard): CreatePaymentRequestDTO
    {
        $this->creditCard = $creditCard;
        return $this;
    }

    /**
     * @return CreditCardHolderInfoDTO|null
     */
    public function getCreditCardHolderInfo(): ?CreditCardHolderInfoDTO
    {
        return $this->creditCardHolderInfo;
    }

    /**
     * @param CreditCardHolderInfoDTO|null $creditCardHolderInfo
     * @return CreatePaymentRequestDTO
     */
    public function setCreditCardHolderInfo(?CreditCardHolderInfoDTO $creditCardHolderInfo): CreatePaymentRequestDTO
    {
        $this->creditCardHolderInfo = $creditCardHolderInfo;
        return $this;
    }
}
