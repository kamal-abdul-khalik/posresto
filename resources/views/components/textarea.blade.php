<label class="form-control">
    <div class="label">
        <span class="label-text">{{ $label }}</span>
    </div>
    <textarea wire:model="{{ $wireModel }}" placeholder="{{ $placeholder }}" @class(['h-24 textarea textarea-bordered', 'input-error' => $error])></textarea>
    @if ($error)
        <span class="text-xs text-error">{{ $error }}</span>
    @endif
</label>
