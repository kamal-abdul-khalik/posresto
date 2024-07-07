<?php

namespace App\Livewire\Restore\Menu;

use App\Models\Menu;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Masmerise\Toaster\Toastable;

class Index extends Component
{
    use WithPagination;
    use WithoutUrlPagination;
    use Toastable;

    public function menuRestore($menuId)
    {
        $menu = Menu::onlyTrashed()->find($menuId);
        if ($menu) {
            $menu->restore();
            $this->success('Menu berhasil dikembalikan.');
        }
    }

    public function forceDelete($menuId)
    {
        $menu = Menu::onlyTrashed()->find($menuId);
        if ($menu) {
            Storage::disk('public')->delete($menu->image);
            $menu->forceDelete();
            $this->success('Menu dihapus permanen.');
        }
    }

    public function render()
    {
        $menus = Menu::query()->with('categoryMenu')->onlyTrashed()->paginate(10);
        return view('livewire.restore.menu.index', [
            'menus' => $menus,
        ]);
    }
}
