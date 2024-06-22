@props([
    'name',
    'label',
    'type' => 'text',
    'value' => null,
    'autofocus' => false,
])

<div class="form-group">
    <label for="{{ $name }}">{{ $label }}</label>
    <input
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $name }}"
        class="form-control"
        value="{{ $value }}"
        {{ $autofocus ? 'autofocus' : '' }}
    >
</div>