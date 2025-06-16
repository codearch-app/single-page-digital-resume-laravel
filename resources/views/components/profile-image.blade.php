@props(['src', 'alt', 'size' => 'w-48 h-48 lg:w-56 lg:h-56'])

@if($src)
    <div class="hidden lg:block">
        <div class="relative group">
            <!-- Gradient border effect -->
            <div class="absolute -inset-1 bg-gradient-to-r from-blue-400 via-indigo-400 to-purple-400 rounded-2xl blur opacity-75 group-hover:opacity-100 transition duration-300"></div>

            <!-- Image container -->
            <div class="relative {{ $size }} bg-white/10 backdrop-blur-sm rounded-2xl border border-white/20 overflow-hidden">
                <img
                    src="{{ $src }}"
                    alt="{{ $alt }}"
                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                >
            </div>
        </div>
    </div>
@endif
