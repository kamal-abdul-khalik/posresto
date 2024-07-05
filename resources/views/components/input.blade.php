<label class="form-control">
    <div class="label">
        <span class="label-text">{{ $label }}</span>
    </div>
    <input type="{{ $type }}" wire:model="{{ $wireModel }}" placeholder="{{ $placeholder }}"
        @class(['input input-bordered', 'input-error' => $error]) />
    @if ($error)
        <span class="mt-2 text-xs text-error">{{ $error }}</span>
    @endif
</label>
