<div class="page-wrapper">
    <x-offline />
    <div class="flex flex-wrap -mx-4">
        <!-- Left Card -->
        <div class="w-full px-4 mb-4 md:w-1/2">
            <div class="card card-divider">
                <div class="card-body">
                    <label class="flex items-center gap-2 input input-bordered">
                        <input type="searchMenu" class="grow" placeholder="Cari menu"
                            wire:model.live.debounce.600ms="search" />
                        <x-tabler-search class="size-5 opacity-40" />
                    </label>
                </div>
                @forelse ($menus as $category_menu => $menu)
                    <div class="card-body" wire:key="menu-{{ $category_menu }}">
                        <div class="flex items-center gap-1">
                            <h3 class="capitalize card-title">{{ $category_menu }} :</h3>
                        </div>
                        <div class="flex flex-wrap w-full gap-2">
                            @foreach ($menu as $item)
                                <div wire:key="{{ $item->id }}" class="tooltip" data-tip="{{ $item->name }}">
                                    <button class="avatar" wire:click="addItem({{ $item->id }})">
                                        <div class="w-20 rounded-lg md:w-24">
                                            <img src="{{ $item->img }}" alt="{{ $item->name }}">
                                            <pre>{{ $item->categoryMenu->name }}</pre>
                                        </div>
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @empty
                    <div class="card-body">
                        <pre>Menu tidak ditemukan</pre>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Right Cards -->
        <div class="flex flex-col w-full px-4 mb-4 space-y-4 md:w-1/2">
            <div class="sticky z-10 card top-10">
                <div class="card-body">
                    <h3 class="card-title">Detail Transaksi</h3>
                    <div class="table-wrapper">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Menu</th>
                                    <th>Qty</th>
                                    <th>Harga</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($items ?? [] as $key => $value)
                                    <tr wire:key="{{ $key }}">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $key }}</td>
                                        <td>{{ $value['qty'] }}</td>
                                        <td>{{ 'Rp. ' . Number::format($value['price'], locale: 'id') }}</td>
                                        <td>
                                            <button class="btn btn-xs btn-square"
                                                wire:click="removeItem('{{ $key }}')">
                                                <x-tabler-minus class="size-3" />
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">
                                            @if ($errors->first('items'))
                                                <span class="font-medium text-error">
                                                    Transaksi kosong tidak dapat disimpan
                                                </span>
                                            @else
                                                <span class="font-medium text-gray-400">
                                                    Belum ada transaksi
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <form class="space-y-4 " wire:submit="save">
                        <x-select :label="'Pelanggan'" :wire-model="'form.customer_id'" :error="$errors->first('form.customer_id')" :options="$customers" />
                        <x-textarea :label="'Keterangan'" :wire-model="'form.desc'" :placeholder="'Anda dapat mengetikkan nomor meja atau keterangan lainnya'"
                            :error="$errors->first('form.desc')"></x-textarea>
                        <div class="items-center justify-between card-actions">
                            <div class="flex flex-col">
                                <div class="text-xs">Total Harga: </div>
                                <div @class(['card-title', 'text-error' => $errors->first('items')])>Rp.
                                    {{ Number::format($this->getTotalPrice(), locale: 'id') }}</div>
                            </div>
                            <button class="btn btn-primary btn-sm" wire:offline.remove>
                                <x-tabler-check class="size-4" />
                                <span>Simpan</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
