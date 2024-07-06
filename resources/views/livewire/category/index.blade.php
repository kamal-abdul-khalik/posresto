<div class="page-wrapper">
    <div class="flex flex-col justify-between gap-2 md:flex-row">
        <label class="flex items-center gap-2 input input-bordered">
            <input type="search" class="grow" placeholder="Search" wire:model.live.debounce.600ms="search" />
            <x-tabler-search class="size-4 text-base-300" />
        </label>
        <button for="modalAddCategory" class="btn btn-primary" wire:click="$dispatch('createCategory')">
            <x-tabler-plus class="size-4" />
            <span>Kategori Menu</span>
        </button>
    </div>
    <div class="table-wrapper">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $category)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->slug }}</td>
                        <td>
                            <div class="flex gap-2">
                                <button class="btn btn-xs text-info btn-square"
                                    wire:click="$dispatch('editCategory', {category: {{ $category->id }}})">
                                    <x-tabler-edit class="size-4" />
                                </button>
                                <button class="btn btn-xs text-error btn-square"
                                    wire:click="$dispatch('deleteCategory', {category: {{ $category->id }}})">
                                    <x-tabler-trash class="size-4" />
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan='6' class="font-semibold text-center text-slate-500/70">Belum ada category disini
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div>{{ $categories->links() }}</div>
    @livewire('category.actions')
</div>
