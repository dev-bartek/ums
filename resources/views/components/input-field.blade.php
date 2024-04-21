<div class="mb-3">
    <label
        for="{{ $id }}"
        class="block text-xs text-gray-600 mb-2">
        {{ $label }}
        @if($required)
            <span class="text-red-600"> *</span>
        @endif
    </label>
    <input
        id="{{ $id }}"
        type="{{ $type }}"
        wire:model.blur="{{ $model }}"
        class="w-full text-gray-800 text-sm rounded-md border border-gray-800 focus:outline-none focus:shadow-outline px-2 py-1.5"
    >
    <div>
        @error($field)
            <span class="error text-xs text-red-600">
                {{ $message }}
            </span>
        @enderror
    </div>
</div>
