<div class="page-wrapper">
    <x-offline />
    <div class="flex flex-wrap -mx-4">
        <!-- Left Card -->
        <div class="px-4 mb-4 w-full md:w-1/2">
            <div class="card card-divider">
                <div class="card-body">
                    <label class="flex gap-2 items-center input input-bordered">
                        <input type="searchMenu" wire:offline.attr="disabled" class="grow" placeholder="Cari menu"
                            wire:model.live.debounce.600ms="search" />
                        <x-tabler-search class="opacity-40 size-5" />
                    </label>
                </div>
                @forelse ($menus as $category_menu => $menu)
                    <div class="card-body" wire:key="menu-{{ $category_menu }}">
                        <div class="flex gap-1 items-center">
                            <h3 class="capitalize card-title">{{ $category_menu }} :</h3>
                        </div>
                        <div class="flex flex-wrap gap-4 w-full lg:gap-2">
                            @foreach ($menu as $item)
                                <div wire:key="{{ $item->id }}" class="tooltip" data-tip="{{ $item->name }}">
                                    <button class="avatar" wire:click="addItem({{ $item->id }})">
                                        <div class="rounded-lg w-[65px] md:w-[125px] lg:w-[120px]">
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
                        <span class="font-medium text-center opacity-60">
                            Menu tidak ditemukan
                        </span>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Right Cards -->
        <div class="flex flex-col px-4 mb-4 space-y-4 w-full md:w-1/2">
            <div class="sticky top-10 z-10 card">
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
                                                <span class="font-medium opacity-60">
                                                    Belum ada transaksi disini
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <form class="space-y-4" wire:submit="save">
                        <x-select-join :label="'Pelanggan'" :wire-model="'form.customer_id'" :error="$errors->first('form.customer_id')" :options="$customers"
                            :placeholder="'Pilih Pelanggan'" :button-label="'+'" />
                        <x-textarea :label="'Keterangan'" :wire-model="'form.desc'" :placeholder="'Anda dapat mengetikkan nomor meja atau keterangan lainnya'"
                            :error="$errors->first('form.desc')"></x-textarea>
                        <div class="justify-between items-center card-actions">
                            <div class="flex flex-col">
                                <div class="text-xs">Total Harga: </div>
                                <div @class(['card-title', 'text-error' => $errors->first('items')])>Rp.
                                    {{ Number::format($this->getTotalPrice(), locale: 'id') }}</div>
                            </div>
                            <button class="btn btn-primary btn-sm" wire:offline.attr="disabled">
                                <x-tabler-check class="size-4" />
                                <span>Proses</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div>
        @livewire('transaction.show')
    </div>
    <div>
        @livewire('customer.actions')
    </div>
</div>
