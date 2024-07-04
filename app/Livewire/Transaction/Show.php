<?php

namespace App\Livewire\Transaction;

use App\Models\Transaction;
use Livewire\Attributes\On;
use Livewire\Component;

class Show extends Component
{

    public $modalShow = false;
    public ?Transaction $transaction;

    #[On('showTransaction')]
    public function showTransaction(Transaction $transaction)
    {
        $this->transaction = $transaction;
        $this->modalShow = true;
    }

    public function closeModal(): void
    {
        $this->modalShow = false;
        $this->reset();
    }

    public function render()
    {
        return view('livewire.transaction.show');
    }
}
