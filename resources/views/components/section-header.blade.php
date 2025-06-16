@props(['icon', 'title', 'iconColor' => 'from-blue-500 to-indigo-600'])

<div class="flex items-center gap-3 mb-8">
    <div class="p-3 bg-gradient-to-br {{ $iconColor }} rounded-xl shadow-lg">
        {{ $icon }}
    </div>
    <h2 class="text-3xl font-bold bg-gradient-to-r from-slate-800 to-slate-600 bg-clip-text text-transparent">
        {{ $title }}
    </h2>
</div>
