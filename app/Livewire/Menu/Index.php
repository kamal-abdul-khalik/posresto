<?php

namespace App\Livewire\Menu;

use App\Models\Menu;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Masmerise\Toaster\Toastable;

class Index extends Component
{
    use WithPagination;
    use WithoutUrlPagination;
    use Toastable;

    protected $listeners = [
        'reload' => '$refresh'
    ];

    public $search;

    public function toogleDone(Menu $menu)
    {
        $menu->enabled = !$menu->enabled;
        $menu->save();
        if ($menu->enabled) {
            $this->info('Menu diaktifkan');
        } else {
            $this->info('Menu tidak aktif');
        }
    }

    public function render()
    {
        $menus =  Menu::query()
            ->search($this->search)
            ->with('categoryMenu')
            ->latest()
            ->paginate(5);
        return view('livewire.menu.index', [
            'menus' => $menus,
        ]);
    }
}
