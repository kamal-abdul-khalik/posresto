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

    public $search = '';
    public $startDate;
    public $endDate;

    public function mount()
    {
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
            ->when($this->startDate && $this->endDate, function ($query) {
                $query->whereDate('created_at', '>=', $this->startDate)
                    ->whereDate('created_at', '<=', $this->endDate);
            })
            ->latest();

        return view('livewire.transaction.index', [
            'transactions' => $query->paginate(10)
        ]);
    }
}
