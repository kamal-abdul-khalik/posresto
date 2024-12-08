<?php

namespace App\Livewire\Transaction;

use App\Models\Transaction;
use Livewire\Component;

class Receipt extends Component
{
    public Transaction $transaction;
    public $paymentAmount = 0;

    public function mount(Transaction $transaction)
    {
        $this->transaction = $transaction;
        $this->paymentAmount = $transaction->payment_amount ?? 0;
    }
    public function render()
    {
        return view('livewire.transaction.receipt');
    }
}
