<?php

namespace App\Livewire;

use App\Models\Transaction;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Masmerise\Toaster\Toastable;

#[Title('Home')]
class Home extends Component
{
    use WithPagination, WithoutUrlPagination;
    use Toastable;

    public function toogleDone(Transaction $transaction)
    {
        $transaction->is_done = !$transaction->is_done;
        $transaction->save();
        $this->success('Trasaksi Selesai');
    }

    public function render()
    {
        $today = date('Y-m-d');
        [$year, $month] = explode("-", date('Y-m'));

        $income = Transaction::query()
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year);

        $transactions = Transaction::query()
            ->where('is_done', false)
            ->with('customer')
            ->paginate(10);

        return view('livewire.home', [
            'monthly' => $income->get()->sum('total'),
            'today' => $income->whereDate('created_at', $today)->get(),
            'transactions' => $transactions,
        ]);
    }
}
