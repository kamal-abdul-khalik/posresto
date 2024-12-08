<div class="page-wrapper">
    <x-offline />
    <div class="flex flex-wrap -mx-4">
        <!-- Left Card - Menu Selection -->
        <div class="px-4 mb-6 w-full lg:w-1/2">
            <div class="shadow-lg card bg-base-100">
                <!-- Search Bar -->
                <div class="sticky top-0 z-20 rounded-t-2xl border-b card-body bg-base-100 border-base-200">
                    <div class="relative">
                        <input type="search" wire:offline.attr="disabled" class="pr-10 pl-4 w-full input input-bordered"
                            placeholder="Cari menu..." wire:model.live.debounce.600ms="search">
                        <x-tabler-search class="absolute right-3 top-1/2 opacity-40 -translate-y-1/2 size-5" />
                    </div>
                </div>

                <!-- Menu Categories -->
                <div class="overflow-y-auto max-h-[calc(100vh-20rem)]  scrollbar-hide">
                    @forelse ($menus as $category_menu => $menu)
                        <div class="pt-2 pb-4 card-body" wire:key="menu-{{ $category_menu }}">
                            <h3 class="mb-3 text-lg font-semibold capitalize">{{ $category_menu }}</h3>
                            <div class="grid grid-cols-2 gap-3 sm:grid-cols-3 md:grid-cols-2 lg:grid-cols-3">
                                @foreach ($menu as $item)
                                    <div wire:key="{{ $item->id }}"
                                        class="overflow-hidden relative rounded-lg shadow-sm transition-all duration-300 cursor-pointer group hover:shadow-md"
                                        wire:click="addItem({{ $item->id }})">
                                        <div class="relative aspect-[4/3]">
                                            <img src="{{ $item->img }}" alt="{{ $item->name }}"
                                                class="object-cover w-full h-full">
                                            <div
                                                class="absolute inset-0 bg-gradient-to-t to-transparent opacity-0 transition-opacity from-black/60 group-hover:opacity-100">
                                                <div class="absolute right-0 bottom-0 left-0 p-2 text-white">
                                                    <p class="text-sm font-medium line-clamp-2">{{ $item->name }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @empty
                        <div class="flex justify-center items-center p-8">
                            <div class="text-center">
                                <x-tabler-search class="mx-auto opacity-40 size-12" />
                                <p class="mt-2 font-medium text-base-content/60">Menu tidak ditemukan</p>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Right Card - Transaction Details -->
        <div class="px-4 w-full lg:w-1/2">
            <div class="sticky top-6">
                <div class="shadow-lg card bg-base-100">
                    <div class="card-body">
                        <h3 class="flex gap-2 items-center card-title">
                            <x-tabler-receipt class="size-5" />
                            Detail Transaksi
                        </h3>

                        <!-- Items Table -->
                        <div class="overflow-x-auto -mx-6">
                            <table class="table table-zebra">
                                <thead>
                                    <tr>
                                        <th class="w-12">#</th>
                                        <th>Menu</th>
                                        <th class="w-20">Qty</th>
                                        <th class="w-32">Harga</th>
                                        <th class="w-12"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($items ?? [] as $key => $value)
                                        <tr wire:key="{{ $key }}" class="group">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $key }}</td>
                                            <td>{{ $value['qty'] }}</td>
                                            <td>{{ 'Rp. ' . Number::format($value['price'], locale: 'id') }}</td>
                                            <td>
                                                <button
                                                    class="opacity-0 btn btn-ghost btn-xs text-error group-hover:opacity-100"
                                                    wire:click="removeItem('{{ $key }}')">
                                                    <x-tabler-trash class="size-4" />
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="py-8">
                                                <div class="text-center">
                                                    <x-tabler-shopping-cart class="mx-auto opacity-40 size-12" />
                                                    @if ($errors->first('items'))
                                                        <p class="mt-2 text-sm font-medium text-error">
                                                            Transaksi kosong tidak dapat disimpan
                                                        </p>
                                                    @else
                                                        <p class="mt-2 text-sm font-medium text-base-content/60">
                                                            Belum ada item dalam transaksi
                                                        </p>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Transaction Form -->
                        <form class="mt-6 space-y-4" wire:submit="save">
                            <x-select-join :label="'Pelanggan'" :wire-model="'form.customer_id'" :error="$errors->first('form.customer_id')" :options="$customers"
                                :placeholder="'Pilih Pelanggan'" :button-label="'+'" />

                            <x-textarea :label="'Keterangan'" :wire-model="'form.desc'" :placeholder="'Nomor meja atau keterangan lainnya'" :error="$errors->first('form.desc')" />

                            <!-- Total and Submit -->
                            <div class="flex justify-between items-center pt-4 border-t">
                                <div>
                                    <p class="text-sm text-base-content/70">Total Pembayaran</p>
                                    <p @class([
                                        'text-2xl font-bold',
                                        'text-error' => $errors->first('items'),
                                    ])>
                                        Rp. {{ Number::format($this->getTotalPrice(), locale: 'id') }}
                                    </p>
                                </div>
                                <button class="btn btn-primary" wire:offline.attr="disabled">
                                    <x-tabler-check class="size-5" />
                                    <span>Proses Transaksi</span>
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
</div>
