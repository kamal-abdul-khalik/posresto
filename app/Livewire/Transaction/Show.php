<?php

namespace App\Livewire\Transaction;

use App\Models\Transaction;
use Livewire\Attributes\On;
use Livewire\Component;

class Show extends Component
{

    public $modalShow = false;
    public ?Transaction $transaction = null;
    public $paymentAmount = 0;

    #[On('showTransaction')]
    public function showTransaction(Transaction $transaction)
    {
        $this->transaction = $transaction;
        $this->modalShow = true;
        $this->paymentAmount = 0;
    }

    public function getChangeAmountProperty()
    {
        $total = $this->transaction?->total ?? 0;
        return max(0, (float)$this->paymentAmount - $total);
    }

    public function closeModal(): void
    {
        if ($this->transaction && $this->paymentAmount > 0) {
            $this->transaction->payment_amount = $this->paymentAmount;
            $this->transaction->save();
        }
        $this->modalShow = false;
        $this->reset();
    }

    public function render()
    {
        return view('livewire.transaction.show');
    }
}
