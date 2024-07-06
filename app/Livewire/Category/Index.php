<?php

namespace App\Livewire\Category;

use App\Models\CategoryMenu;
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
        $categories =  CategoryMenu::query()
            ->search($this->search)
            ->latest()
            ->paginate(5);

        return view('livewire.category.index', [
            'categories' => $categories,
        ]);
    }
}
