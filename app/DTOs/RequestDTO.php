<?php

namespace App\DTOs;

use App\External\Asaas\Enum\PaymentMethodEnum;
use App\Helpers\UtilsHelper;
use Illuminate\Http\Request;

class RequestDTO
{
    private string $name;
    private string $cpf;
    private string $email;
    private string $phone;
    private string $paymentMethod;
    private float $value;

    private string $holderName;
    private string $number;
    private string $expiryMonth;
    private string $expiryYear;
    private string $cvv;
    private int $installmentCount;

    private string $postalCode;
    private string $addressNumber;
    private string $addressComplement;

    public function fromRequest(Request $request): RequestDTO
    {
        $this->setName(UtilsHelper::onlyLetters($request->input('name')))
            ->setCpf(UtilsHelper::onlyDigits($request->input('cpf')))
            ->setEmail(filter_var($request->input('email'), FILTER_SANITIZE_EMAIL))
            ->setPhone(UtilsHelper::onlyDigits($request->input('phone')))
            ->setPaymentMethod(UtilsHelper::onlyLetters($request->input('paymentMethod')))
            ->setValue((float)$request->input('value'));

        if ($this->getPaymentMethod() == PaymentMethodEnum::CARD) {
            $this->setHolderName(UtilsHelper::onlyLetters($request->input('name')))
                ->setNumber(UtilsHelper::onlyDigits($request->input('number')))
                ->setExpiryMonth(UtilsHelper::onlyDigits($request->input('expiryMonth')))
                ->setExpiryYear(UtilsHelper::onlyDigits($request->input('expiryYear')))
                ->setCvv(UtilsHelper::onlyDigits($request->input('cvv')))
                ->setPostalCode(UtilsHelper::onlyDigits($request->input('postalCode')))
                ->setAddressNumber(UtilsHelper::onlyDigits($request->input('addressNumber')))
                ->setAddressComplement(filter_var($request->input('addressComplement'), FILTER_SANITIZE_SPECIAL_CHARS))
                ->setInstallmentCount((int)$request->input('installmentCount'));
        }

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
     * @return RequestDTO
     */
    public function setName(string $name): RequestDTO
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getCpf(): string
    {
        return $this->cpf;
    }

    /**
     * @param string $cpf
     * @return RequestDTO
     */
    public function setCpf(string $cpf): RequestDTO
    {
        $this->cpf = $cpf;
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
     * @return RequestDTO
     */
    public function setEmail(string $email): RequestDTO
    {
        $this->email = $email;
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
     * @return RequestDTO
     */
    public function setPhone(string $phone): RequestDTO
    {
        $this->phone = $phone;
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
     * @return RequestDTO
     */
    public function setPaymentMethod(string $paymentMethod): RequestDTO
    {
        $this->paymentMethod = $paymentMethod;
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
     * @return RequestDTO
     */
    public function setValue(float $value): RequestDTO
    {
        $this->value = number_format($value, 2);
        return $this;
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
     * @return RequestDTO
     */
    public function setHolderName(string $holderName): RequestDTO
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
     * @return RequestDTO
     */
    public function setNumber(string $number): RequestDTO
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
     * @return RequestDTO
     */
    public function setExpiryMonth(string $expiryMonth): RequestDTO
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
     * @return RequestDTO
     */
    public function setExpiryYear(string $expiryYear): RequestDTO
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
     * @return RequestDTO
     */
    public function setCvv(string $cvv): RequestDTO
    {
        $this->cvv = $cvv;
        return $this;
    }

    /**
     * @return int
     */
    public function getInstallmentCount(): int
    {
        return $this->installmentCount;
    }

    /**
     * @param int $installmentCount
     * @return RequestDTO
     */
    public function setInstallmentCount(int $installmentCount): RequestDTO
    {
        $this->installmentCount = $installmentCount;
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
     * @return RequestDTO
     */
    public function setPostalCode(string $postalCode): RequestDTO
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
     * @return RequestDTO
     */
    public function setAddressNumber(string $addressNumber): RequestDTO
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
     * @return RequestDTO
     */
    public function setAddressComplement(string $addressComplement): RequestDTO
    {
        $this->addressComplement = $addressComplement;
        return $this;
    }
}
