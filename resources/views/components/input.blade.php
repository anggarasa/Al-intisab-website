<div class="mb-4">
    @if($label)
    <label for="{{ $name }}" class="block text-gray-700 text-sm font-bold mb-2">
        {{ $label }}
    </label>
    @endif

    <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}" placeholder="{{ $placeholder }}"
        value="{{ old($name, $value) }}" {{ $required ? 'required' : '' }} {{ $disabled ? 'disabled' : '' }} {{ $wire
        ? 'wire:model=' . $wire : '' }} class="
            w-full px-4 py-3 border-2 rounded-xl focus:ring-2 focus:ring-green-300 focus:border-green-400 outline-none transition bg-white/50
            {{ $class ?? '' }}
            {{ $errors->has($name) ? 'border-red-500' : '' }}
        ">

    @error($name)
    <p class="text-red-500 text-xs italic mt-1">
        {{ $message }}
    </p>
    @enderror
</div>