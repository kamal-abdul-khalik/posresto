<div class="font-mono page-wrapper">
    <div class="mx-auto max-w-72">
        <div class="divide-y divide-black divide-dashed">
            <div class="mb-4">
                <h3 class="font-semibold text-center uppercase">{{ config('app.name') }}</h3>
                <p class="text-sm text-center">Alamat Toko</p>
            </div>
            <div class="text-sm">
                <table class="w-full">
                    <tr>
                        <td>Invoice</td>
                        <td>:</td>
                        <td>{{ $transaction->invoice }}</td>
                    </tr>
                    <tr>
                        <td>Tanggal</td>
                        <td>:</td>
                        <td>{{ $transaction->created_at->format('d F Y') }}</td>
                    </tr>
                    <tr>
                        <td>Pukul</td>
                        <td>:</td>
                        <td>{{ $transaction->created_at->format('H:i') }}</td>
                    </tr>
                    <tr>
                        <td>Pelanggan</td>
                        <td>:</td>
                        <td>{{ $transaction->customer?->name ?? '-' }}</td>
                    </tr>
                </table>
            </div>
            <div class="space-y-2 text-sm">
                @foreach ($transaction->items as $name => $item)
                    <div class="flex flex-col" wire:key="items-{{ $name }}">
                        <div>{{ $name }}</div>
                        <div class="flex justify-between">
                            <div>{{ $item['price'] / $item['qty'] }} x {{ $item['qty'] }}</div>
                            <div>Rp. {{ Number::format($item['price'], locale: 'id') }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="flex flex-col">
                <div class="flex justify-between">
                    <div><small>Total Harga: </small></div>
                    <div class="text-lg font-semibold">Rp. {{ Number::format($transaction['total'], locale: 'id') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
