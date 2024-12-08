<div>
    <input type="checkbox" class="modal-toggle" @checked($modalShow) />
    <div class="modal" role="dialog">
        <div class="max-w-2xl modal-box">
            <!-- Header -->
            <div class="flex justify-between items-center pb-4 border-b">
                <div class="flex gap-3 items-center">
                    <x-tabler-receipt class="size-6 text-primary" />
                    <h3 class="text-xl font-bold">Detail Transaksi</h3>
                </div>
                <div class="px-3 py-1 text-xs font-medium rounded-full" @class([
                    'bg-success/10 text-success' => $transaction?->is_done,
                    'bg-warning/10 text-warning' => !$transaction?->is_done,
                ])>
                    {{ $transaction?->is_done ? 'Lunas' : 'Belum Lunas' }}
                </div>
            </div>

            <div class="py-6 space-y-6">
                <!-- Transaction Info -->
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div class="p-4 rounded-lg bg-base-200/50">
                        <div class="text-sm text-base-content/70">Tanggal Transaksi</div>
                        <div class="text-base font-semibold">
                            {{ $transaction?->created_at->format('d M Y H:i:s') }}
                        </div>
                    </div>
                    <div class="p-4 rounded-lg bg-base-200/50">
                        <div class="text-sm text-base-content/70">Invoice</div>
                        <div class="text-base font-semibold">{{ $transaction?->invoice }}</div>
                    </div>
                </div>

                <!-- Customer Info -->
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div class="space-y-1">
                        <div class="flex gap-2 items-center">
                            <x-tabler-user class="size-5 text-base-content/70" />
                            <div class="text-sm text-base-content/70">Nama Pelanggan</div>
                        </div>
                        <div class="font-semibold">{{ $transaction?->customer?->name ?? '-' }}</div>
                    </div>
                    <div class="space-y-1">
                        <div class="flex gap-2 items-center">
                            <x-tabler-notes class="size-5 text-base-content/70" />
                            <div class="text-sm text-base-content/70">Keterangan</div>
                        </div>
                        <div class="text-sm">{{ $transaction?->desc ?: '-' }}</div>
                    </div>
                </div>

                <!-- Items Table -->
                <div class="table-wrapper">
                    <div class="overflow-x-auto -mx-6">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="w-12">#</th>
                                    <th>Menu</th>
                                    <th class="w-20">Qty</th>
                                    <th class="w-32">Harga</th>
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
                </div>

                <!-- Payment Section -->
                <div class="p-4 space-y-4 rounded-lg bg-base-200/50">
                    <div class="flex justify-between items-center">
                        <div class="text-base-content/70">Total Bayar</div>
                        <div class="text-xl font-bold">
                            Rp. {{ Number::format($transaction?->total ?? 0, locale: 'id') }}
                        </div>
                    </div>

                    @if (!($transaction?->is_done ?? false))
                        <div class="space-y-2">
                            <label class="text-sm text-base-content/70">Jumlah Uang</label>
                            <input 
                                type="number" 
                                wire:model.live="paymentAmount"
                                x-data
                                x-init="$el.value = ''"
                                @focus-payment.window="$nextTick(() => $el.focus())"
                                class="w-full input input-bordered"
                                placeholder="Masukkan jumlah uang"
                                min="0"
                            >
                        </div>

                        <div class="flex justify-between items-center pt-2">
                            <div class="text-base-content/70">
                                {{ $this->changeAmount < 0 ? 'Sisa Pembayaran' : 'Kembalian' }}
                            </div>
                            <div @class([
                                'text-xl font-bold',
                                'text-success' => $this->changeAmount >= 0,
                                'text-error' => $this->changeAmount < 0,
                            ])>
                                Rp. {{ Number::format(abs($this->changeAmount), locale: 'id') }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Actions -->
            <div class="flex gap-2 justify-end pt-4 mt-4 border-t">
                <button type="button" wire:click="closeModal" class="btn btn-ghost">
                    <x-tabler-x class="size-4" />
                    <span>Tutup</span>
                </button>

                @if (!($transaction?->is_done ?? false))
                    <button type="button" wire:click="savePayment" class="btn btn-success"
                        @disabled($paymentAmount < ($transaction?->total ?? 0))>
                        <x-tabler-cash class="size-4" />
                        <span>Bayar</span>
                    </button>
                @endif

                @if (isset($transaction) && $transaction->payment_amount)
                    <a onclick="return receiptPrint('{{ route('transaction.receipt', $transaction) }}')"
                        class="btn btn-primary">
                        <x-tabler-printer class="size-4" />
                        <span>Print</span>
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>
