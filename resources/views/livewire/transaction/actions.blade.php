<div class="page-wrapper">
    <div class="grid grid-cols-2 gap-6">
        <div class="card card-divider">
            <div class="card-body">
                <label class="flex items-center gap-2 input input-bordered">
                    <input type="searchMenu" class="grow" placeholder="Cari menu"
                        wire:model.live.debounce.600ms="search" />
                    <x-tabler-search class="size-4 text-base-300" />
                </label>
            </div>
            @forelse ($menus as $category_menu => $menu)
                <div class="card-body">
                    <div class="flex items-center gap-1">
                        <h3 class="text-lg font-semibold text-gray-700 capitalize">{{ $category_menu }} :</h3>
                    </div>
                    <div class="grid grid-cols-6 gap-2">
                        @foreach ($menu as $item)
                            <button class="avatar" wire:click="addItem({{ $item->id }})">
                                <div class="rounded-lg w-28">
                                    <img src="{{ $item->img }}" alt="{{ $item->name }}">
                                    <pre>{{ $item->categoryMenu->name }}</pre>
                                </div>
                            </button>
                        @endforeach
                    </div>
                </div>
            @empty
                <div class="card-body">
                    <pre>Menu tidak ditemukan</pre>
                </div>
            @endforelse
        </div>
        <div class="card h-fit">
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
                                <tr class="font-semibold" wire:key="{{ $key }}">
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
                    <x-textarea :label="'Keterangan'" :wire-model="'form.desc'" :placeholder="'Anda dapat mengetikkan nomor meja atau keterangan lainnya'" :error="$errors->first('form.desc')"></x-textarea>
                    <div class="justify-between card-actions">
                        <div class="flex flex-col">
                            <div class="text-xs">Total Harga: </div>
                            <div @class(['card-title', 'text-error' => $errors->first('items')])>Rp.
                                {{ Number::format($this->getTotalPrice(), locale: 'id') }}</div>
                        </div>
                        <button class="btn btn-primary btn-sm">
                            <x-tabler-check class="size-4" />
                            <span>Simpan</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
