<?php

namespace App\Repositories;

use App\DTOs\PaymentDTO;
use App\Models\Payment;

class PaymentRepository
{
    public function savePayment(PaymentDTO $paymentDTO): Payment
    {
        $payment = new Payment();
        $payment->value = $paymentDTO->getValue();
        $payment->identifier_payment = $paymentDTO->getIdentifierPayment();
        $payment->identifier_customer = $paymentDTO->getIdentifierCustomer();
        $payment->payment_method = $paymentDTO->getPaymentMethod();
        $payment->save();

        return $payment;
    }
}
