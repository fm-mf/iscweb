<?php

namespace App\View\Components;

use App\Enums\PaymentMethod;
use Illuminate\View\Component;

class InputPaymentMethods extends Component
{
    public array $paymentMethods;

    public function __construct()
    {
        $this->paymentMethods = PaymentMethod::cases();
    }

    public function render()
    {
        return view('components.input-payment-methods');
    }
}
