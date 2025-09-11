<?php

namespace App\Livewire\Frontend;

use Livewire\Component;

class CartBadge extends Component
{
    public $total = 0;

    public function getListeners()
    {
        return [
            'cartUpdated' => 'updateTotal'
        ];
    }

    public function mount()
    {
        $this->cart = session()->get('cart', []);
    }

    public function updateTotal()
    {
        $cart = session()->get('cart', []);
        $this->total = $this->total =  count($cart);
    }

    public function render()
    {
        $this->total = $this->total = count(session()->get('cart', []));
        return view('livewire.front-end.cart-badge');
    }
}
