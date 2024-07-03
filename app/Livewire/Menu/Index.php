<?php

namespace App\Livewire\Menu;

use App\Models\Menu;
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
        $menus =  Menu::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', "%{$this->search}%")
                    ->orWhereHas('categoryMenu', function ($query) {
                        $query->where('name', 'like', "%{$this->search}%");
                    });
            })
            ->with('categoryMenu')
            ->latest()
            ->paginate(5);
        return view('livewire.menu.index', [
            'menus' => $menus,
        ]);
    }
}
