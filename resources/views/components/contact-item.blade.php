@props(['href' => null, 'icon', 'text'])

@if($href)
    <a href="{{ $href }}"
       class="group flex items-center gap-2 hover:text-white transition-colors duration-200">
        <div class="p-2 bg-white/10 rounded-lg group-hover:bg-white/20 transition-colors duration-200">
            {{ $icon }}
        </div>
        <span class="font-medium">{{ $text }}</span>
    </a>
@else
    <div class="flex items-center gap-2">
        <div class="p-2 bg-white/10 rounded-lg">
            {{ $icon }}
        </div>
        <span class="font-medium">{{ $text }}</span>
    </div>
@endif
