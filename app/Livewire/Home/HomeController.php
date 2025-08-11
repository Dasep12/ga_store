<?php

namespace App\Livewire\Home;

use Livewire\Component;

class HomeController extends Component
{
    protected string $layout = 'layouts.app';
    public function render()
    {
        // return view('livewire.home.index');
        return view('livewire.home.index')->layout('components.layouts.app', [
            'title' => 'Home'
        ]);
    }
}
