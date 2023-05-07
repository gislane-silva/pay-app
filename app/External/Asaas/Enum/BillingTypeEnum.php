<?php

namespace App\External\Asaas\Enum;

class BillingTypeEnum
{
    const BILLING_TYPE_TICKET = "BOLETO";
    const BILLING_TYPE_CREDIT_CARD = "CREDIT_CARD";
    const BILLING_TYPE_PIX = "PIX";

    const ALL = [
        'ticket' => self::BILLING_TYPE_TICKET,
        'card' => self::BILLING_TYPE_CREDIT_CARD,
        'pix' => self::BILLING_TYPE_PIX
    ];

    public static function getBillingType(string $paymentMethod): string
    {
        return self::ALL[$paymentMethod];
    }
}
