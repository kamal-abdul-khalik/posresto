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
        $this->transaction = $transaction->load('customer');
        $this->modalShow = true;
        $this->paymentAmount = 0;
    }

    public function getChangeAmountProperty()
    {
        $total = $this->transaction?->total ?? 0;
        return (float)$this->paymentAmount - $total;
    }

    public function savePayment(): void
    {
        if ($this->transaction && $this->paymentAmount > 0) {
            $this->transaction->payment_amount = $this->paymentAmount;
            $this->transaction->is_done = true;
            $this->transaction->save();
            $this->dispatch('payment-saved', transactionId: $this->transaction->id);
        }
    }

    public function closeModal(): void
    {
        $this->savePayment();
        $this->modalShow = false;
        $this->reset();
    }

    public function render()
    {
        return view('livewire.transaction.show');
    }
}
