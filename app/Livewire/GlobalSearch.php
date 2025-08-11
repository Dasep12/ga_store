<?php

namespace App\Livewire;

use Livewire\Component;

class GlobalSearch extends Component
{
    public $search = '';

    public function updatedSearch()
    {
        // Kirim nilai search ke semua komponen yang mendengarkan
        // $this->emit('globalSearchUpdated', $this->search);
        $this->dispatch('globalSearchUpdated', $this->search);
    }

    public function render()
    {
        return view('livewire.global-search');
    }
}
