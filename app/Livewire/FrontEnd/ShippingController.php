<?php

namespace App\Livewire\FrontEnd;

use Livewire\Component;

class ShippingController extends Component
{
    public function render()
    {
        return view('livewire.front-end.shipping-controller')->extends('components.layouts.frontend.app');
    }
}
