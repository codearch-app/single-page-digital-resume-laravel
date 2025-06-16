@props(['highlights', 'bulletColor' => 'from-blue-500 to-indigo-500'])

@if($highlights)
    <ul class="space-y-2">
        @foreach($highlights as $highlight)
            <li class="flex items-start gap-3">
                <div class="w-1.5 h-1.5 bg-gradient-to-r {{ $bulletColor }} rounded-full mt-2 flex-shrink-0"></div>
                <span class="text-slate-700 leading-relaxed">{{ $highlight }}</span>
            </li>
        @endforeach
    </ul>
@endif
