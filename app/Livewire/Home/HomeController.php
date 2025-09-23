<?php

namespace App\Livewire\Home;

use Livewire\Component;

class HomeController extends Component
{
    protected string $layout = 'layouts.app';
    public function render()
    {
        return view('livewire.front-end.home', [
            'title' => 'GA Store | Home'
        ])->extends('components.layouts.frontend.app');
    }
}
