<div class="form-control">
    <div class="label">
        <span class="label-text">Pelanggan</span>
    </div>
    <div class="relative">
        <div class="w-full join">
            <input type="text" wire:model.live.debounce.300ms="search" placeholder="Cari pelanggan"
                class="w-full input input-bordered join-item">
            <button type="button" class="rounded-r-full btn join-item"
                wire:click.prevent.stop="$dispatch('show-customer-form')">
                <x-tabler-plus class="size-4" />
            </button>
        </div>

        @if (!empty($customers))
            <div class="overflow-y-auto absolute z-50 mt-1 w-full max-h-60 bg-white rounded-lg border shadow-lg">
                @forelse($customers as $customer)
                    <div wire:key="{{ $customer->id }}" class="px-4 py-2 cursor-pointer hover:bg-base-200"
                        wire:click="selectCustomer({{ $customer->id }})">
                        <div class="font-medium">{{ $customer->name }}</div>
                        @if ($customer->contact)
                            <div class="text-xs text-gray-600">{{ $customer->contact }}</div>
                        @endif
                    </div>
                @empty
                    <div class="px-4 py-2 text-center">Pelanggan tidak ditemukan</div>
                @endforelse
            </div>
        @endif
    </div>
    @error('form.customer_id')
        <span class="mt-2 text-xs text-error">{{ $message }}</span>
    @enderror
</div>
