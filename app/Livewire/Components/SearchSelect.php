<?php

namespace App\Livewire\Components;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\Attributes\On;

class SearchSelect extends Component
{
    public $search = '';
    public $selected = null;
    public $results = [];
    public $modelId;
    public $model;
    public $label;
    public $wireModel;
    public $error;
    public $showAddButton = false;
    
    public function mount($modelId = null, $model = null, $label = '', $wireModel = '', $error = '', $showAddButton = false)
    {
        $this->modelId = $modelId;
        $this->model = $model;
        $this->label = $label;
        $this->wireModel = $wireModel;
        $this->error = $error;
        $this->showAddButton = $showAddButton;

        if ($modelId && $model) {
            $modelClass = "App\\Models\\{$model}";
            $this->selected = $modelClass::find($modelId);
            $this->search = $this->selected?->name;
        }
    }

    #[On('item-saved')]
    public function handleItemSaved($data)
    {
        if (isset($data['id'])) {
            $modelClass = "App\\Models\\{$this->model}";
            $item = $modelClass::find($data['id']);
            if ($item) {
                $this->selected = $item;
                $this->search = $item->name;
                $this->modelId = $item->id;
                $this->results = [];
                $this->dispatch('item-selected', [
                    'model' => $this->model,
                    'id' => $item->id,
                    'wireModel' => $this->wireModel
                ]);
            }
        }
    }

    #[On('transaction-processed')]
    public function resetSelection()
    {
        $this->search = '';
        $this->selected = null;
        $this->modelId = null;
        $this->results = [];
    }

    public function updatedSearch()
    {
        if (empty($this->search)) {
            $this->results = [];
            $this->modelId = null;
            $this->selected = null;
            $this->dispatch('item-selected', [
                'model' => $this->model,
                'id' => null,
                'wireModel' => $this->wireModel
            ]);
            return;
        }

        $modelClass = "App\\Models\\{$this->model}";
        $this->results = $modelClass::where('name', 'like', "%{$this->search}%")
            ->limit(10)
            ->get();
    }

    public function selectItem($itemId)
    {
        $modelClass = "App\\Models\\{$this->model}";
        $this->selected = $modelClass::find($itemId);
        $this->search = $this->selected->name;
        $this->modelId = $itemId;
        $this->results = [];
        
        $this->dispatch('item-selected', [
            'model' => $this->model,
            'id' => $itemId,
            'wireModel' => $this->wireModel
        ]);
    }

    public function render()
    {
        return view('livewire.components.search-select');
    }
}
