@props([
    'label' => '',
    'wireModel' => '',
    'error' => '',
    'options' => [],
    'placeholder' => 'Pilih!',
    'buttonLabel' => 'Search',
])

<div class="form-control">
    @if ($label)
        <div class="label">
            <span class="label-text">{{ $label }}</span>
        </div>
    @endif
    <div class="join">
        <select wire:model="{{ $wireModel }}" @class([
            'select select-bordered join-item w-full',
            'input-error' => $error,
        ])>
            <option selected value="">{{ $placeholder }}</option>
            @foreach ($options as $option)
                <option value="{{ $option->id }}">{{ $option->name }}</option>
            @endforeach
        </select>
        <div class="indicator">
            @if ($buttonLabel === '+')
                <button type="button" class="btn join-item"
                    wire:click="$dispatch('show-customer-form')">{{ $buttonLabel }}</button>
            @else
                <button class="btn join-item">{{ $buttonLabel }}</button>
            @endif
        </div>
    </div>
    @if ($error)
        <span class="mt-2 text-xs text-error">{{ $error }}</span>
    @endif
</div>
