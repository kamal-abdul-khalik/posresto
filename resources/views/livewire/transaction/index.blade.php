<div class="page-wrapper">
    <div class="flex justify-between">
        <label class="flex items-center gap-2 input input-bordered">
            <input type="date" class="grow" wire:model.live="date" />
        </label>
        <a type="button" href="{{ route('transaction.create') }}" class="btn btn-primary" wire:navigate>
            <x-tabler-plus class="size-4" />
            <span>Transaksi</span>
        </a>
    </div>
    <div class="table-wrapper">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Waktu</th>
                    <th>Keterangan</th>
                    <th>Pelanggan</th>
                    <th>Total</th>
                    <th>Selesai?</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($transactions as $transaction)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $transaction->created_at->diffForHumans() }}</td>
                        <td>{{ Str::limit($transaction->desc, 20) }}</td>
                        <td>{{ $transaction->customer->name ?? '-' }}</td>
                        <td>Rp. {{ Number::format($transaction->total, locale: 'id') }}</td>
                        <td>
                            <input type="checkbox" class="toggle toggle-xs" @checked($transaction->is_done)
                                wire:change="toogleDone({{ $transaction->id }})" />
                        </td>
                        <td>
                            <div class="flex justify-center gap-1">
                                <button class="btn btn-xs btn-square"
                                    wire:click="$dispatch('showTransaction',{transaction:{{ $transaction->id }}})">
                                    <x-tabler-eye class="size-4 text-info" />
                                </button>
                                <a href="{{ route('transaction.edit', $transaction) }}" class="btn btn-xs btn-square"
                                    wire:navigate>
                                    <x-tabler-edit class="size-4" />
                                </a>
                                <button class="btn btn-xs btn-square"
                                    wire:click="deleteTransaction({{ $transaction->id }})">
                                    <x-tabler-trash class="size-4 text-error" />
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan='7' class="font-semibold text-center text-slate-500/70">Belum ada transaksi
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

    @livewire('transaction.show')
</div>
