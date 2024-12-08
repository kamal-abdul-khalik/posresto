<div class="page-wrapper">
    <x-offline />
    <div class="flex flex-wrap -mx-4 mb-6">
        <div class="px-4 mb-4 w-full md:w-1/3">
            <div class="card card-compact">
                <div class="card-body">
                    <div class="flex gap-x-3 items-center">
                        <div class="p-3 rounded-full bg-primary"><x-tabler-calendar-month /></div>
                        <div class="flex flex-col">
                            <div class="font-semibold opacity-50">Pendapatan Bulan Ini</div>
                            <div class="text-xl font-semibold">Rp. {{ Number::format($monthly, locale: 'id') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="px-4 mb-4 w-full md:w-1/3">
            <div class="card card-compact">
                <div class="card-body">
                    <div class="flex gap-x-3 items-center">
                        <div class="p-3 rounded-full bg-primary"><x-tabler-hours-24 /></div>
                        <div class="flex flex-col">
                            <div class="font-semibold opacity-50">Pendapatan Hari Ini</div>
                            <div class="text-xl font-semibold">
                                Rp. {{ Number::format($today->sum('total'), locale: 'id') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="px-4 mb-4 w-full md:w-1/3">
            <div class="card card-compact">
                <div class="card-body">
                    <div class="flex gap-x-3 items-center">
                        <div class="p-3 rounded-full bg-primary"><x-tabler-shopping-cart-copy /></div>
                        <div class="flex flex-col">
                            <div class="font-semibold opacity-50">Transaksi Hari ini</div>
                            <div class="text-xl font-semibold">{{ $today->count() }} Transaksi</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Content -->
    <div class="flex flex-wrap -mx-4">
        <!-- Left Content -->
        <div class="px-4 mb-4 w-full md:w-3/5">
            <div class="m-4">
                <div class="flex justify-between items-center">
                    <h3 class="font-semibold">Transaksi Belum Selesai</h3>
                    @can('export transactions')
                        <a type="button" href="{{ route('transaction.export') }}" class="btn btn-primary btn-sm"
                            wire:navigate>
                            <x-tabler-table-export class="size-4" />
                            <span>Export Transaksi</span>
                        </a>
                    @endcan
                </div>
            </div>
            <div class="table-wrapper">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Waktu Order</th>
                            <th>Nama Pelanggan</th>
                            <th>Total Bayar </th>
                            <th>Act</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($transactions as $item)
                            <tr wire:key="transaksiItem-{{ $item->id }}">
                                <td>{{ $loop->iteration }}</td>
                                <td class="flex flex-col space-y-1">
                                    <span class="text-xs font-medium">{{ $item->created_at->format('d M Y') }}</span>
                                    <span class="text-xs opacity-70">{{ $item->created_at->diffForHumans() }}</span>
                                    <span class="text-xs font-semibold opacity-70">{{ $item->invoice }}</span>
                                </td>
                                <td>{{ $item->customer?->name }}</td>
                                <td>Rp. {{ Number::format($item->total, locale: 'id') }}</td>
                                <td>
                                    @can('show transactions')
                                        <button class="btn btn-xs btn-info"
                                            wire:click="$dispatch('showTransaction',{transaction:{{ $item->id }}})">
                                            Bayar
                                        </button>
                                    @endcan
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-lg font-semibold text-center">
                                    <a href="{{ route('transaction.create') }}" wire:navigate type="button"
                                        class="btn btn-info">
                                        <x-tabler-cash-register class="size-6" />Tambah Transaksi
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
            <div>
                {{ $transactions->links() }}
            </div>
        </div>
        <!-- Right Content -->
        <div class="px-4 mb-4 w-full md:w-2/5">
            <div class="m-4">
                <h3 class="font-semibold">Menu Terlaris</h3>
            </div>
            <div class="table-wrapper">
                <table class="table font-semibold">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Menu</th>
                            <th class="text-center">Total Terjual</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($totalSales as $row)
                            <tr wire:key="totalSales-{{ $row['name'] }}">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $row['name'] }}</td>
                                <td class="text-center">{{ $row['total_penjualan'] }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-lg font-semibold text-center opacity-50">Belum ada
                                    menu terbaik
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div>
        @livewire('transaction.show')
    </div>
</div>
