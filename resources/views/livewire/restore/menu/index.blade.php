<div class="page-wrapper">
    <div class="table-wrapper">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Gambar</th>
                    <th>Harga</th>
                    <th>Deskripsi</th>
                    <th>Waktu Hapus</th>
                    <th>Restore</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($menus as $menu)
                    <tr wire:key="rest-menu-{{ $menu->id }}">
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
                            <div class="flex flex-col">
                                <div class="text-xs font-semibold">{{ $menu->deleted_at->format('d F Y') }}</div>
                                <div class="text-xs">{{ $menu->deleted_at->diffForHumans() }}</div>
                            </div>
                        </td>
                        <td>
                            <div class="flex gap-2">
                                @can('restore menus')
                                    <button class="btn btn-xs btn-circle" wire:click="menuRestore({{ $menu->id }})">
                                        <x-tabler-restore class="size-4 text-info" />
                                    </button>
                                @endcan
                                @can('force delete menus')
                                    <button class="btn btn-xs btn-circle" wire:click="forceDelete({{ $menu->id }})">
                                        <x-tabler-trash-x class="size-4 text-error" />
                                    </button>
                                @endcan
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan='6' class="font-semibold text-center text-slate-500/70">Tempat sampah kosong
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
