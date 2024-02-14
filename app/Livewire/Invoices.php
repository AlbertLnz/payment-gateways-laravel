<?php

namespace App\Livewire;

use Livewire\Component;

class Invoices extends Component
{

    protected $listeners = ['newSubscription' => 'render'];

    public function render()
    {
        return view('livewire.invoices', [
            'invoices' => auth()->user()->invoices()
        ]);
    }
}
