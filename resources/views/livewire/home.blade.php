<div class="page-wrapper">
    <x-offline />
    <div class="flex flex-wrap mb-6 -mx-4">
        <div class="w-full px-4 mb-4 md:w-1/3">
            <div class="card card-compact">
                <div class="card-body">
                    <div class="flex items-center gap-x-3">
                        <div class="p-3 rounded-full bg-primary"><x-tabler-calendar-month /></div>
                        <div class="flex flex-col">
                            <div class="font-semibold opacity-50">Pendapatan Bulan Ini</div>
                            <div class="text-xl font-semibold">Rp. {{ Number::format($monthly, locale: 'id') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full px-4 mb-4 md:w-1/3">
            <div class="card card-compact">
                <div class="card-body">
                    <div class="flex items-center gap-x-3">
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
        <div class="w-full px-4 mb-4 md:w-1/3">
            <div class="card card-compact">
                <div class="card-body">
                    <div class="flex items-center gap-x-3">
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
        <div class="w-full px-4 mb-4 md:w-3/5">
            <div class="m-4">
                <h3 class="font-semibold">Transaksi Belum Selesai</h3>
            </div>
            <div class="table-wrapper">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Waktu Order</th>
                            <th>Nama Pelanggan</th>
                            <th>Total Bayar </th>
                            <th>Keterangan</th>
                            <th>Status</th>
                            <th>Cetak</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($transactions as $item)
                            <tr wire:key="transaksiItem-{{ $item->id }}">
                                <td>{{ $loop->iteration }}</td>
                                <td class="flex flex-col">
                                    <span class="text-xs font-medium">{{ $item->created_at->format('d M Y') }}</span>
                                    <span class="text-xs opacity-70">{{ $item->created_at->diffForHumans() }}</span>
                                </td>
                                <td>{{ $item->customer?->name }}</td>
                                <td>Rp. {{ Number::format($item->total, locale: 'id') }}</td>
                                <td>{{ Str::limit($item->desc, 10) }}</td>
                                <td>
                                    @can('index transactions')
                                        <input type="checkbox" wire:offline.remove class="toggle toggle-xs"
                                            @checked($item->is_done) wire:change="toogleDone({{ $item->id }})" />
                                    @endcan
                                </td>
                                <td>
                                    @can('print receipt')
                                        <button class="btn btn-sm btn-circle"
                                            onclick="return receiptPrint('{{ route('transaction.receipt', $item) }}')">
                                            <x-tabler-printer class="size-4" />
                                        </button>
                                    @endcan
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-lg font-semibold text-center opacity-50">Belum
                                    ada
                                    transaksi
                                    disini
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
        <div class="w-full px-4 mb-4 md:w-2/5">
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
</div>
