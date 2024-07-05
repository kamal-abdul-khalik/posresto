<?php

namespace App\Livewire\Transaction;

use App\Models\Transaction;
use Livewire\Component;

class Receipt extends Component
{
    public Transaction $transaction;
    public function mount(Transaction $transaction)
    {
        $this->transaction = $transaction;
    }
    public function render()
    {
        return view('livewire.transaction.receipt');
    }
}
