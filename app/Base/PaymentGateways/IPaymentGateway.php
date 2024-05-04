<?php

namespace App\Base\PaymentGateways;

/**
 * Interface IPaymentGateway
 * @package App\Base\PaymentGateways
 */
interface IPaymentGateway
{
    /**
     * Process payment
     *
     * @param float $amount
     * @param string $currency
     * @param array $customerInfo
     * @return void
     */
    public function processPayment(float $amount, string $currency, array $customerInfo): void;
}
