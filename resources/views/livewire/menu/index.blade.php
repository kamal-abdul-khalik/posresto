<div class="page-wrapper">
    <div class="flex flex-col justify-between gap-2 md:flex-row">
        <label class="flex items-center gap-2 input input-bordered">
            <input type="search" class="grow" placeholder="Search" wire:model.live.debounce.600ms="search" />
            <x-tabler-search class="size-4 text-base-300" />
        </label>
        <button for="modalAddMenu" class="btn btn-primary" wire:click="$dispatch('createMenu')">
            <x-tabler-plus class="size-4" />
            <span>Menu</span>
        </button>
    </div>
    <div class="table-wrapper">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Gambar</th>
                    <th>Harga</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($menus as $menu)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <div class="flex items-center gap-3">
                                <div class="avatar">
                                    <div class="w-10 rounded-lg">
                                        <img src="{{ $menu->img }}" alt="{{ $menu->name }}">
                                    </div>
                                </div>
                                <div class="flex flex-col">
                                    <div class="text-xs font-semibold">{{ $menu->name }}</div>
                                    <div class="text-xs">{{ $menu->categoryMenu->name }}</div>
                                </div>
                            </div>
                        </td>
                        <td>{{ $menu->harga }}</td>
                        <td>{{ $menu->desclimit }}</td>
                        <td>
                            <div class="flex gap-2">
                                <button class="btn btn-xs text-info btn-square"
                                    wire:click="$dispatch('editMenu', {menu: {{ $menu->id }}})">
                                    <x-tabler-edit class="size-4" />
                                </button>
                                <button class="btn btn-xs text-error btn-square"
                                    wire:click="$dispatch('deleteMenu', {menu: {{ $menu->id }}})">
                                    <x-tabler-trash class="size-4" />
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan='6' class="font-semibold text-center text-slate-500/70">Belum ada menu disini
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div>{{ $menus->links() }}</div>
    @livewire('menu.actions')
</div>
