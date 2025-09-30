<?php

namespace App\Livewire\Home;

use Livewire\Component;

class HomeController extends Component
{
    protected string $layout = 'layouts.app';
    public function render()
    {
        return view('livewire.admin.home.index', [
            'title' => 'GA Store | Home'
        ])->extends('components.layouts.admin.app');
    }
}
