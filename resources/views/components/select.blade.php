@props(['disabled' => false])

<select {{ $disabled ? 'disabled' : '' }}
    {{ $attributes->merge(['class' => 'rounded-md border-gray-300 shadow-sm focus:border-blue-900 focus:ring-blue-900']) }}>
    {{ $slot }}
</select>
