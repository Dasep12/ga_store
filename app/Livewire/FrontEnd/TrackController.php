<?php

namespace App\Livewire\FrontEnd;

use Livewire\Component;

class TrackController extends Component
{
    public function render()
    {
        return view('livewire.front-end.track-controller')
            ->extends('components.layouts.frontend.app');
    }
}
