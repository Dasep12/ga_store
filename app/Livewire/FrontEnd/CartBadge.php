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

    public function removeItem($id)
    {
        $cart = session()->get('cart', []);
        unset($cart[$id]);
        session()->put('cart', $cart);
        $this->dispatch('cartUpdated');
        $this->cart = $cart;
    }



    public function render()
    {
        $this->total = $this->total = count(session()->get('cart', []));
        return view('livewire.front-end.cart-badge');
    }
}
