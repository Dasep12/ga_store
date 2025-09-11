<?php

namespace App\Livewire\Frontend;

use Livewire\Component;

class CheckoutController extends Component
{
    public function render()
    {
        return view('livewire.front-end.checkout-controller')
            ->extends('components.layouts.frontend.app');
    }
}
