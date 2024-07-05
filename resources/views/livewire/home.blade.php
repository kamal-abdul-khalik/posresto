<div class="page-wrapper">
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
            <div class="table-wrapper">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tanggal Order</th>
                            <th>Nama Pelanggan</th>
                            <th>Total Bayar </th>
                            <th>Keterangan</th>
                            <th>Status</th>
                            <th>Cetak</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($transactions as $item)
                            <tr wire:key="{{ $item->id }}">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->created_at->format('d M Y') }}</td>
                                <td>{{ $item->customer?->name }}</td>
                                <td>Rp. {{ Number::format($item->total, locale: 'id') }}</td>
                                <td>{{ Str::limit($item->desc, 10) }}</td>
                                <td>
                                    <input type="checkbox" class="toggle toggle-xs" @checked($item->is_done)
                                        wire:change="toogleDone({{ $item->id }})" />
                                </td>
                                <td>
                                    <button class="btn btn-xs"
                                        onclick="return receiptPrint('{{ route('transaction.receipt', $item) }}')">
                                        <x-tabler-printer class="size-4" />
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-lg font-semibold text-center opacity-50">Belum ada
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
            <div class="overflow-hidden bg-white rounded-lg shadow-md">
                {{-- <div class="p-6">
                    <h2 class="mb-2 text-2xl font-bold">Right Content</h2>
                    <p class="text-gray-700">This is the content on the right side, taking 40% of the width.</p>
                </div> --}}
            </div>
        </div>
    </div>
</div>
