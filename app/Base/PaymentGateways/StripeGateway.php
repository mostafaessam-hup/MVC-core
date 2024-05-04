<?php

namespace App\Base\PaymentGateways;

/**
 * Class StripeGateway
 * @package App\Base\PaymentGateways
 */
class StripeGateway implements IPaymentGateway
{
    /**
     * Process payment
     *
     * @param float $amount
     * @param string $currency
     * @param array $customerInfo
     * @return void
     */
    public function processPayment(float $amount, string $currency, array $customerInfo): void
    {
        // Stripe payment process
    }
}
