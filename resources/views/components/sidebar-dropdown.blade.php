<li class="mb-2" x-data="{ dropdownOpen: false }">
    <div @click="dropdownOpen = !dropdownOpen"
        class="block px-4 py-2 text-gray-800 rounded hover:bg-violet-100 cursor-pointer flex justify-between items-center">
        <div class="flex items-center gap-2">
            @if ($icon)
            <i class="{{ $icon }}"></i>
            @endif
            <span>{{ $title }}</span>
        </div>
        <svg class="w-4 h-4 transition-transform" :class="{'rotate-180': dropdownOpen}" fill="none"
            stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
        </svg>
    </div>
    <ul x-show="dropdownOpen" class="pl-6">
        @foreach ($links as $link)
        <li>
            <a href="{{ $link['url'] }}" class="block px-4 py-2 text-gray-800 rounded hover:bg-violet-100">{{
                $link['label'] }}</a>
        </li>
        @endforeach
    </ul>
</li>
