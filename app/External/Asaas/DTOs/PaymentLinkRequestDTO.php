<?php

namespace App\External\Asaas\DTOs;

class PaymentLinkRequestDTO
{
    private string $name;
    private string $billingType;
    private string $chargeType;
    private string $dueDateLimitDays;
    private string $value;

    public function toArray(): array
    {
        return [
            'name' => $this->getName(),
            'billingType' => $this->getBillingType(),
            'chargeType' => $this->getChargeType(),
            'dueDateLimitDays' => $this->getDueDateLimitDays(),
            'value' => $this->getValue()
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
     * @return PaymentLinkRequestDTO
     */
    public function setName(string $name): PaymentLinkRequestDTO
    {
        $this->name = $name;
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
     * @return PaymentLinkRequestDTO
     */
    public function setBillingType(string $billingType): PaymentLinkRequestDTO
    {
        $this->billingType = $billingType;
        return $this;
    }

    /**
     * @return string
     */
    public function getChargeType(): string
    {
        return $this->chargeType;
    }

    /**
     * @param string $chargeType
     * @return PaymentLinkRequestDTO
     */
    public function setChargeType(string $chargeType): PaymentLinkRequestDTO
    {
        $this->chargeType = $chargeType;
        return $this;
    }

    /**
     * @return string
     */
    public function getDueDateLimitDays(): string
    {
        return $this->dueDateLimitDays;
    }

    /**
     * @param string $dueDateLimitDays
     * @return PaymentLinkRequestDTO
     */
    public function setDueDateLimitDays(string $dueDateLimitDays): PaymentLinkRequestDTO
    {
        $this->dueDateLimitDays = $dueDateLimitDays;
        return $this;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param string $value
     * @return PaymentLinkRequestDTO
     */
    public function setValue(string $value): PaymentLinkRequestDTO
    {
        $this->value = $value;
        return $this;
    }
}
