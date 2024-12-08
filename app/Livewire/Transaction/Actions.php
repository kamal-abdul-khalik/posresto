<?php

namespace App\Livewire\Transaction;

use App\Livewire\Forms\TransactionForm;
use App\Models\Customer;
use App\Models\Menu;
use App\Models\Transaction;
use Livewire\Component;
use Livewire\WithPagination;
use Masmerise\Toaster\Toastable;

class Actions extends Component
{
    use WithPagination;
    use Toastable;

    public $items = [];
    public $search;

    public TransactionForm $form;
    public ?Transaction $transaction;

    public function mount()
    {
        if (isset($this->transaction)) {
            $this->form->setTransaction($this->transaction);
            $this->items = $this->form->items;
        }
    }

    public function addItem(Menu $menu): void
    {
        if (isset($this->items[$menu->name])) {
            $item = $this->items[$menu->name];
            $this->items[$menu->name] = [
                'qty' => $item['qty'] + 1,
                'price' => $item['price'] + $menu->price
            ];
        } else {
            $this->items[$menu->name] = [
                'qty' => 1,
                'price' => $menu->price
            ];
        }
        $this->success('Item ditambahkan');
    }

    public function removeItem($key): void
    {
        $item = $this->items[$key];
        if ($item['qty'] > 1) {
            $unitPrice = $item['price'] / $item['qty'];
            $newQty = $item['qty'] - 1;
            $this->items[$key]['qty'] = $newQty;
            $this->items[$key]['price'] = $unitPrice * $newQty;
        } else {
            unset($this->items[$key]);
        }
        $this->warning('Item dihapus');
    }

    public function getTotalPrice()
    {
        if (isset($this->items)) {
            $prices = array_column($this->items, 'price');
            return array_sum($prices);
        } else {
            return 0;
        }
    }

    public function save()
    {
        $this->validate([
            'items' => ['required', 'array', 'min:1'],
        ]);
        $this->form->items = $this->items;
        $this->form->total = $this->getTotalPrice();
        
        try {
            if (isset($this->form->transaction)) {
                $this->form->update();
                $transaction = $this->form->transaction;
                $this->success('Transaksi berhasil diedit');
            } else {
                $transaction = $this->form->store();
                $this->success('Transaksi berhasil disimpan');
            }
            
            // Show transaction modal instead of redirecting
            if ($transaction) {
                $this->dispatch('showTransaction', transaction: $transaction->id);
            }
            
            // Reset form
            $this->items = [];
            $this->form->reset();
        } catch (\Exception $e) {
            $this->error('Gagal menyimpan transaksi: ' . $e->getMessage());
        }
    }

    public function showTransaction()
    {
        $this->dispatch('showTransaction', transaction: $this->transaction);
    }

    public function printReceipt()
    {
        return redirect()->route('transaction.receipt', $this->transaction);
    }

    public function render()
    {
        $menus = Menu::query()
            ->search($this->search)
            ->with('categoryMenu')
            ->enable()
            ->latest()
            ->get()
            ->groupBy('categoryMenu.name');

        return view('livewire.transaction.actions', [
            'menus' => $menus,
            'customers' => Customer::all(),
        ]);
    }
}
