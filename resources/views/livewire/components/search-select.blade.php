<div class="form-control">
    <div class="label">
        <span class="label-text">{{ $label }}</span>
    </div>
    <div class="relative">
        <div class="w-full join">
            <input 
                type="text" 
                wire:model.live.debounce.300ms="search" 
                placeholder="Cari {{ strtolower($label) }}"
                class="w-full input input-bordered join-item"
            >
            @if($showAddButton)
                <button 
                    type="button" 
                    class="rounded-r-full btn join-item"
                    @php
                        $eventName = 'show-' . strtolower($model) . '-form';
                    @endphp
                    wire:click.prevent.stop="$dispatch('{{ $eventName }}')"
                >
                    <x-tabler-plus class="size-4" />
                </button>
            @endif
        </div>

        @if (!empty($results))
            <div class="overflow-y-auto absolute z-50 mt-1 w-full max-h-60 bg-white rounded-lg border shadow-lg">
                @forelse($results as $item)
                    <div 
                        wire:key="{{ $item->id }}" 
                        class="px-4 py-2 cursor-pointer hover:bg-base-200"
                        wire:click="selectItem({{ $item->id }})"
                    >
                        <div class="font-medium">{{ $item->name }}</div>
                        @if(isset($item->contact))
                            <div class="text-xs text-gray-600">{{ $item->contact }}</div>
                        @endif
                    </div>
                @empty
                    <div class="px-4 py-2 text-center">Data tidak ditemukan</div>
                @endforelse
            </div>
        @endif
    </div>
    @if ($error)
        <span class="mt-2 text-xs text-error">{{ $error }}</span>
    @endif
</div>
