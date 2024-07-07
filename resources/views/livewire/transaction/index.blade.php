<div class="page-wrapper">
    <x-offline />
    <div class="flex justify-between">
        <label class="flex items-center gap-2 input input-bordered">
            <input type="date" class="grow" wire:model.live="date" />
        </label>
        <a type="button" href="{{ route('transaction.export') }}" class="btn btn-primary" wire:navigate>
            <x-tabler-table-export class="size-4" />
            <span>Export</span>
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
                    <tr wire:key="{{ $transaction->id }}">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $transaction->created_at->diffForHumans() }}</td>
                        <td>{{ Str::limit($transaction->desc, 20) }}</td>
                        <td>{{ $transaction->customer->name ?? '-' }}</td>
                        <td>Rp. {{ Number::format($transaction->total, locale: 'id') }}</td>
                        <td>
                            @can('index transactions')
                                <input type="checkbox" wire:offline.attr="disabled" class="toggle toggle-xs"
                                    @checked($transaction->is_done) wire:change="toogleDone({{ $transaction->id }})" />
                            @endcan
                        </td>
                        <td>
                            <div class="flex justify-center gap-1">
                                <button class="btn btn-xs btn-square"
                                    wire:click="$dispatch('showTransaction',{transaction:{{ $transaction->id }}})">
                                    <x-tabler-eye class="size-4 text-info" />
                                </button>
                                @can('show transactions')
                                    <a href="{{ route('transaction.edit', $transaction) }}" class="btn btn-xs btn-square"
                                        wire:navigate>
                                        <x-tabler-edit class="size-4" />
                                    </a>
                                @endcan
                                @can('delete transactions')
                                    <button wire:offline.attr="disabled" class="btn btn-xs btn-square"
                                        wire:click="deleteTransaction({{ $transaction->id }})">
                                        <x-tabler-trash class="size-4 text-error" />
                                    </button>
                                @endcan
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
