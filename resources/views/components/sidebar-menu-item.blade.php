<li class="mb-2">
    <a href="{{ $href }}" class="block px-4 py-2 text-gray-800 rounded 
              {{ $active ? 'bg-green-500 text-white' : 'hover:bg-green-500 hover:text-white' }}">
        @if($icon)
        <i class="{{ $icon }} mr-2"></i>
        @endif
        {{ $label }}
    </a>
</li>