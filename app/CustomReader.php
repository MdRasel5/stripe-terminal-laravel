<?php

namespace App;

use Stripe\PaymentIntent;
use Stripe\Stripe;
use Stripe\Terminal\Reader as BaseReader;

class CustomReader extends BaseReader
{
    public function simulatePayment($amount, $paymentMethod)
    {
        try {
            // Set the Stripe API key
            Stripe::setApiKey(config('services.stripe.secret'));

            // Create a test payment intent with a return_url
            $paymentIntent = PaymentIntent::create([
                'amount' => $amount,
                'currency' => 'usd',
                'payment_method' => $paymentMethod,
                'confirmation_method' => 'manual',
                'confirm' => true,
                'return_url' => 'https://example.com/success', // Set your desired return URL
            ]);

            // You might want to handle the $paymentIntent as needed
            // For example, log the simulated payment or update a database record

            return $paymentIntent;
        } catch (\Exception $e) {
            // Handle any exceptions that may occur during the simulation
            throw new \Exception('Error simulating payment: ' . $e->getMessage());
        }
    }
}
