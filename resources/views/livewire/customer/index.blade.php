<div class="page-wrapper">
    <div class="flex flex-col justify-between gap-2 md:flex-row">
        <label class="flex items-center gap-2 input input-bordered">
            <input type="search" class="grow" placeholder="Search" wire:model.live.debounce.600ms="search" />
            <x-tabler-search class="size-4 text-base-300" />
        </label>
        <button for="modalAddCustomer" class="btn btn-primary" wire:click="$dispatch('createCustomer')">
            <x-tabler-plus class="size-4" />
            <span>Pelanggan</span>
        </button>
    </div>
    <div class="table-wrapper">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Pelanggan</th>
                    <th>Kontak</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($customers as $customer)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $customer->name }}</td>
                        <td>{{ $customer->contact }}</td>
                        <td>{{ $customer->desc }}</td>
                        <td>
                            <div class="flex gap-2">
                                <button class="btn btn-xs text-info btn-square"
                                    wire:click="$dispatch('editCustomer', {customer: {{ $customer->id }}})">
                                    <x-tabler-edit class="size-4" />
                                </button>
                                <button class="btn btn-xs text-error btn-square"
                                    wire:click="$dispatch('deleteCustomer', {customer: {{ $customer->id }}})">
                                    <x-tabler-trash class="size-4" />
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan='6' class="font-semibold text-center text-slate-500/70">Belum ada customer disini
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div>{{ $customers->links() }}</div>
    @livewire('customer.actions')
</div>
