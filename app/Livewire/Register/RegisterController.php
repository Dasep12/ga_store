<?php

namespace App\Livewire\Register;


use Livewire\Component;
use Livewire\WithPagination;

class RegisterController extends Component
{
    use WithPagination;


    public function render()
    {
        return view('livewire.auth.register', [
            'title' => 'Register',
        ])->extends('components.layouts.frontend.app');
    }
}
