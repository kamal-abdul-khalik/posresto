<?php

namespace App\Livewire\MenuReady;

use Livewire\Component;
use App\Models\Transaction;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use Masmerise\Toaster\Toastable;

class Index extends Component
{
    use WithPagination;
    use Toastable;

    public function setReady(Transaction $transaction)
    {
        $transaction->update(['is_ready' => true]);
        $this->success('Done');
        $this->dispatch('$refresh');
    }

    public function playAnnouncement(Transaction $transaction)
    {
        $customerName = $transaction->customer->name ?? 'Pelanggan';
        $this->dispatch('play-announcement', customerName: $customerName);
    }

    public function render()
    {
        $transactions = Transaction::with('customer')
            ->where('is_ready', false)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.menu-ready.index', [
            'transactions' => $transactions
        ]);
    }
}
