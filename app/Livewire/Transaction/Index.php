<?php

namespace App\Livewire\Transaction;

use App\Models\Transaction;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Masmerise\Toaster\Toastable;

class Index extends Component
{
    use WithPagination;
    use WithoutUrlPagination;
    use Toastable;

    public $date;

    public function toogleDone(Transaction $transaction)
    {
        $transaction->is_done = !$transaction->is_done;
        $transaction->save();
    }

    public function mount()
    {
        $this->date = now()->format('Y-m-d');
    }

    public function deleteTransaction(Transaction $transaction): void
    {
        $transaction->delete();
        $this->success('Transaction deleted successfully');
    }

    public function render()
    {
        $transactions = Transaction::query()
            ->when($this->date, function ($query) {
                $query->whereDate('created_at', $this->date);
            })
            ->with('customer')
            ->latest()
            ->paginate(10);

        return view('livewire.transaction.index', ['transactions' => $transactions]);
    }
}
