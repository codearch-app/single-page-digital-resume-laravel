@props(['href', 'text' => null])

@if($href)
    <a href="{{ $href }}" target="_blank"
       class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-700 font-medium mb-4 group/link">
        <svg class="w-4 h-4 group-hover/link:scale-110 transition-transform duration-200"
             fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
        </svg>
        <span class="group-hover/link:underline break-all">{{ $text ?? $href }}</span>
    </a>
@endif
