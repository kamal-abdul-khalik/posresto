<?php

namespace App\Livewire\Customer;

use App\Models\Customer;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    use WithoutUrlPagination;

    protected $listeners = [
        'reload' => '$refresh'
    ];

    public $search;

    public function render()
    {
        $customers =  Customer::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', "%{$this->search}%")
                    ->orWhere('contact', 'like', "%{$this->search}%");
            })
            ->latest()
            ->paginate(5);
        return view('livewire.customer.index', [
            'customers' => $customers,
        ]);
    }
}
