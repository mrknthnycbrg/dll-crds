@props(['disabled' => false, 'default' => 'All', 'options' => []])

<select {{ $disabled ? 'disabled' : '' }}
    {{ $attributes->merge(['class' => 'rounded-md border-gray-300 shadow-sm focus:border-blue-900 focus:ring-blue-900']) }}>
    <option value="0" selected>
        {{ $default }}
    </option>

    @foreach ($options as $value => $label)
        <option value="{{ $value }}">{{ $label }}</option>
    @endforeach

    {{ $slot }}
</select>
