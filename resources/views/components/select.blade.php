@props([
    'label' => '',
    'wireModel' => '',
    'error' => '',
    'options' => [],
    'placeholder' => 'Pilih!',
])

<label class="form-control">
    <div class="label">
        <span class="label-text">{{ $label }}</span>
    </div>
    <select 
        wire:model="{{ $wireModel }}" 
        @class(['select select-bordered', 'input-error' => $error])
        data-customer-select
        placeholder="{{ $placeholder }}"
    >
        <option value="">{{ $placeholder }}</option>
        @foreach ($options as $option)
            <option value="{{ $option->id }}">{{ $option->name }}</option>
        @endforeach
    </select>
    @if ($error)
        <span class="mt-2 text-xs text-error">{{ $error }}</span>
    @endif
</label>
