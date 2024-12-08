<div>
    <input type="checkbox" class="modal-toggle" @checked($modalShow) />
    <div class="modal" role="dialog">
        <div class="modal-box">
            <h3 class="text-lg font-bold">Detail Transaksi</h3>
            <div class="py-4 space-y-4">
                <div class="flex justify-between">
                    <div class="flex flex-col">
                        <div class="text-sm opacity-70">Tanggal Transaksi</div>
                        <div class="text-sm font-semibold opacity-70">
                            {{ $transaction?->created_at->format('d M Y H:i:s') }}</div>
                    </div>
                    <div class="flex flex-col">
                        <div class="text-sm opacity-70">Invoice</div>
                        <div class="text-sm font-semibold opacity-70">{{ $transaction?->invoice }}</div>
                    </div>
                </div>
                <div class="flex flex-col">
                    <div class="text-sm opacity-70">Nama Pelanggan</div>
                    <div class="font-semibold">{{ $transaction?->customer?->name ?? '-' }}</div>
                </div>
                <div class="flex flex-col">
                    <div class="text-sm opacity-70">Keterangan</div>
                    <div class="text-sm opacity-80">{{ $transaction?->desc }}</div>
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
                                <tr wire:key="{{ $key }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $key }}</td>
                                    <td>{{ $value['qty'] }}</td>
                                    <td>Rp. {{ Number::format($value['price'], locale: 'id') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="flex flex-col items-end mr-6">
                    <div class="text-sm opacity-70">Total Bayar</div>
                    <div class="font-bold">Rp. {{ Number::format($transaction?->total ?? 0, locale: 'id') }}</div>
                </div>
                <div class="flex flex-col items-end mr-6">
                    <div class="text-sm opacity-70">Jumlah Uang</div>
                    <div>
                        <input type="number" 
                               wire:model.live="paymentAmount" 
                               class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500"
                               placeholder="Masukkan jumlah uang">
                    </div>
                </div>
                <div class="flex flex-col items-end mr-6">
                    <div class="text-sm opacity-70">Kembalian</div>
                    <div class="font-bold">Rp. {{ Number::format($this->changeAmount, locale: 'id') }}</div>
                </div>
            </div>
            <div class="modal-action">
                <button type="button" wire:click="closeModal" class="btn btn-ghost">Close!</button>
                @isset($transaction)
                    <a onclick="return receiptPrint('{{ route('transaction.receipt', $transaction) }}')" type="button"
                        class="btn btn-primary">
                        <x-tabler-printer class="size-4" />
                        <span>Print</span>
                    </a>
                @endisset
            </div>
        </div>
    </div>
</div>
