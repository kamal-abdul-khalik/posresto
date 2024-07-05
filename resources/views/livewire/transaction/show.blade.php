<div>
    <input type="checkbox" class="modal-toggle" @checked($modalShow) />
    <div class="modal" role="dialog">
        <div class="modal-box">
            <h3 class="text-lg font-bold">Detail Transaksi</h3>
            <div class="py-4 space-y-4">
                <div class="flex flex-col">
                    <div class="text-sm opacity-50">Tanggal Transaksi</div>
                    <div>{{ $transaction?->created_at->format('d M Y H:i:s') }}</div>
                </div>
                <div class="flex flex-col">
                    <div class="text-sm opacity-50">Nama Pelanggan</div>
                    <div class="font-semibold">{{ $transaction?->customer?->name ?? '-' }}</div>
                </div>
                <div class="flex flex-col">
                    <div class="text-sm opacity-50">Keterangan</div>
                    <div class="text-sm opacity-80">{{ $transaction?->desc }}</div>
                </div>
                <div class="flex flex-col">
                    <div class="text-sm opacity-50">Total Bayar</div>
                    <div class="font-bold">Rp. {{ Number::format($transaction?->total ?? 0, locale: 'id') }}</div>
                </div>

                <div class="table-wrapper">
                    <table class="table">
                        {{-- {{ $transaction }} --}}
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Menu</th>
                                <th>Qty</th>
                                <th>Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transaction->items ?? [] as $key => $value)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $key }}</td>
                                    <td>{{ $value['qty'] }}</td>
                                    <td>Rp. {{ Number::format($value['price'], locale: 'id') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-action">
                <button type="button" wire:click="closeModal" class="btn btn-ghost">Close!</button>
            </div>
        </div>
    </div>
</div>
