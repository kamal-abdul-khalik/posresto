<label class="form-control">
    <div class="label">
        <span class="label-text">{{ $label }}</span>
    </div>
    <select wire:model="{{ $wireModel }}" @class(['select select-bordered', 'input-error' => $error])>
        <option selected value="">Pilih!</option>
        @foreach ($options as $option)
            <option value="{{ $option->id }}">{{ $option->name }}</option>
        @endforeach
    </select>
    @if ($error)
        <span class="text-xs text-error">{{ $error }}</span>
    @endif
</label>
