<?php

namespace App\Livewire\Components;

use App\Models\Customer;
use Livewire\Component;
use Livewire\Attributes\On;

class CustomerSelect extends Component
{
    public $search = '';
    public $selectedCustomer = null;
    public $customers = [];
    public $customerId;
    
    public function mount($customerId = null)
    {
        $this->customerId = $customerId;
        if ($customerId) {
            $this->selectedCustomer = Customer::find($customerId);
            $this->search = $this->selectedCustomer?->name;
        }
    }

    #[On('customer-saved')]
    public function handleCustomerSaved($data)
    {
        $customer = Customer::find($data['customerId']);
        if ($customer) {
            $this->selectedCustomer = $customer;
            $this->search = $customer->name;
            $this->customerId = $customer->id;
            $this->customers = [];
            $this->dispatch('customer-selected', customerId: $customer->id);
        }
    }

    #[On('transaction-processed')]
    public function resetSelection()
    {
        $this->search = '';
        $this->selectedCustomer = null;
        $this->customerId = null;
        $this->customers = [];
    }

    public function updatedSearch()
    {
        if (empty($this->search)) {
            $this->customers = [];
            $this->customerId = null;
            $this->selectedCustomer = null;
            $this->dispatch('customer-selected', customerId: null);
            return;
        }

        $this->customers = Customer::where('name', 'like', "%{$this->search}%")
            ->orWhere('contact', 'like', "%{$this->search}%")
            ->limit(10)
            ->get();
    }

    public function selectCustomer($customerId)
    {
        $this->selectedCustomer = Customer::find($customerId);
        $this->search = $this->selectedCustomer->name;
        $this->customerId = $customerId;
        $this->customers = [];
        
        $this->dispatch('customer-selected', customerId: $customerId);
    }

    public function render()
    {
        return view('livewire.components.customer-select');
    }
}
