<?php

namespace App\DTOs;

class PaymentDTO
{
    private float $value;
    private string $identifierPayment;
    private string $identifierCustomer;
    private string $paymentMethod;

    /**
     * @return float
     */
    public function getValue(): float
    {
        return $this->value;
    }

    /**
     * @param float $value
     * @return PaymentDTO
     */
    public function setValue(float $value): PaymentDTO
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @return string
     */
    public function getIdentifierPayment(): string
    {
        return $this->identifierPayment;
    }

    /**
     * @param string $identifierPayment
     * @return PaymentDTO
     */
    public function setIdentifierPayment(string $identifierPayment): PaymentDTO
    {
        $this->identifierPayment = $identifierPayment;
        return $this;
    }

    /**
     * @return string
     */
    public function getIdentifierCustomer(): string
    {
        return $this->identifierCustomer;
    }

    /**
     * @param string $identifierCustomer
     * @return PaymentDTO
     */
    public function setIdentifierCustomer(string $identifierCustomer): PaymentDTO
    {
        $this->identifierCustomer = $identifierCustomer;
        return $this;
    }

    /**
     * @return string
     */
    public function getPaymentMethod(): string
    {
        return $this->paymentMethod;
    }

    /**
     * @param string $paymentMethod
     * @return PaymentDTO
     */
    public function setPaymentMethod(string $paymentMethod): PaymentDTO
    {
        $this->paymentMethod = $paymentMethod;
        return $this;
    }
}
