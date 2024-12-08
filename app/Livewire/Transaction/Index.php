<?php

namespace App\Livewire\Transaction;

use App\Models\Transaction;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Masmerise\Toaster\Toastable;

class Index extends Component
{
    use WithPagination;
    use WithoutUrlPagination;
    use Toastable;

    #[On('payment-saved')]
    public function handlePaymentSaved($transactionId)
    {
        // The transaction is already updated in the database
        // We just need to refresh the component
        $this->render();
    }

    public $search = '';
    public $startDate;
    public $endDate;
    public $date;

    public function mount()
    {
        $this->date = now()->format('Y-m-d');
        $this->startDate = now()->format('Y-m-d');
        $this->endDate = now()->format('Y-m-d');
    }

    public function toogleDone(Transaction $transaction)
    {
        $transaction->is_done = !$transaction->is_done;
        $transaction->save();
    }

    public function deleteTransaction(Transaction $transaction): void
    {
        $transaction->delete();
        $this->success('Transaction deleted successfully');
    }

    public function render()
    {
        $query = Transaction::query()
            ->when($this->search, function ($query) {
                $query->where('invoice', 'like', "%{$this->search}%");
            })
            ->when($this->date, function ($query) {
                $query->whereDate('created_at', $this->date);
            })
            ->with('customer')
            ->latest();

        return view('livewire.transaction.index', [
            'transactions' => $query->paginate(10)
        ]);
    }
}
