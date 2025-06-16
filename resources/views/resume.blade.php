@php /** @var \App\DataObjects\Resume $resume */ @endphp
<x-layout :title="$resume->basics->name . ' Résumé'">
    <x-slot:header>
        <!-- Hero Section with Full-Width Dark Gradient Background -->
        <div class="relative w-full bg-gradient-to-br from-slate-900 via-blue-900 to-indigo-900 overflow-hidden">
            <!-- Content container -->
            <div class="relative z-10 max-w-5xl mx-auto px-6 py-20">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-12">
                    <!-- Left side - Text content -->
                    <div class="flex-1">
                        <!-- Name with Gradient Text -->
                        <h1 class="text-5xl md:text-6xl lg:text-7xl font-black bg-gradient-to-r from-white via-blue-100 to-indigo-200 bg-clip-text text-transparent mb-4 leading-tight">
                            {{ $resume->basics->name }}
                        </h1>

                        <!-- Job Title -->
                        <div class="flex items-center gap-3 mb-8">
                            <div class="w-12 h-0.5 bg-gradient-to-r from-blue-400 to-indigo-400"></div>
                            <h2 class="text-xl md:text-2xl font-semibold text-blue-100">
                                {{ $resume->basics->label }}
                            </h2>
                            <div class="w-12 h-0.5 bg-gradient-to-r from-indigo-400 to-blue-400"></div>
                        </div>

                        <!-- Contact Information with Icons -->
                        <div class="flex flex-wrap gap-6 text-slate-200 mb-8">
                            @if($resume->basics->email)
                                <x-contact-item
                                    :href="'mailto:' . $resume->basics->email"
                                    :text="$resume->basics->email">
                                    <x-slot:icon>
                                        <svg class="w-4 h-4 stroke-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                                        </svg>
                                    </x-slot:icon>
                                </x-contact-item>
                            @endif

                            @if($resume->basics->location->city && $resume->basics->location->region)
                                <x-contact-item
                                    :text="$resume->basics->location->city . ', ' . $resume->basics->location->region">
                                    <x-slot:icon>
                                        <svg class="w-4 h-4 stroke-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                        </svg>
                                    </x-slot:icon>
                                </x-contact-item>
                            @endif
                        </div>

                        <!-- Social Profiles -->
                        @if($resume->basics->profiles)
                            <div class="flex flex-wrap gap-3">
                                @foreach($resume->basics->profiles as $profile)
                                    <a href="{{ $profile->url }}" target="_blank"
                                       class="group px-4 py-2 bg-white/10 backdrop-blur-sm rounded-full border border-white/20 hover:bg-white/20 hover:scale-105 transition-all duration-300 text-white font-medium text-sm">
                                        <span
                                            class="group-hover:text-blue-100 transition-colors duration-200">{{ $profile->network }}</span>
                                    </a>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <!-- Right side - Profile Image -->
                    <x-profile-image :src="$resume->basics->image" :alt="$resume->basics->name" />
                </div>
            </div>
        </div>
    </x-slot:header>

    <!-- Download Resume Button -->
    @if($allowDownload)
        <x-download-resume-button />
    @endif

    <!-- Main Content -->
    <div class="pt-16 grid gap-y-16">
        <!-- Summary Section -->
        @if($resume->basics->summary)
            <section>
                <x-section-header title="About Me" icon-color="from-blue-500 to-indigo-600">
                    <x-slot:icon>
                        <svg class="w-6 h-6 text-white stroke-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                        </svg>
                    </x-slot:icon>
                </x-section-header>

                <x-section-card>
                    <p class="text-lg text-slate-700 leading-relaxed">{{ $resume->basics->summary }}</p>
                </x-section-card>
            </section>
        @endif

        <!-- Work Experience Section -->
        @if(!empty($resume->work))
            <section>
                <x-section-header
                    title="Work Experience"
                    icon-color="from-emerald-500 to-teal-600">
                    <x-slot:icon>
                        <svg class="w-6 h-6 text-white stroke-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 0 0 .75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 0 0-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0 1 12 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 0 1-.673-.38m0 0A2.18 2.18 0 0 1 3 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 0 1 3.413-.387m7.5 0V5.25A2.25 2.25 0 0 0 13.5 3h-3a2.25 2.25 0 0 0-2.25 2.25v.894m7.5 0a48.667 48.667 0 0 0-7.5 0M12 12.75h.008v.008H12v-.008Z" />
                        </svg>
                    </x-slot:icon>
                </x-section-header>

                <div class="space-y-6">
                    @foreach($resume->work as $work)
                        <x-section-card>
                            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-start mb-4">
                                <div class="flex-1">
                                    <h3 class="text-2xl font-bold text-slate-800 mb-2">{{ $work->position }}</h3>
                                    <div class="flex items-center gap-2 mb-3">
                                        <div
                                            class="w-2 h-2 bg-gradient-to-r from-blue-500 to-indigo-500 rounded-full"></div>
                                        <span class="text-lg font-semibold text-slate-600">{{ $work->name }}</span>
                                    </div>
                                </div>

                                <x-date-badge :start-date="$work->startDate" :end-date="$work->endDate" />
                            </div>

                            <x-external-link :href="$work->url" />

                            @if($work->summary)
                                <p class="text-slate-700 mb-4 leading-relaxed">{{ $work->summary }}</p>
                            @endif

                            <x-highlight-list :highlights="$work->highlights" />
                        </x-section-card>
                    @endforeach
                </div>
            </section>
        @endif

        <!-- Skills Section -->
        @if(!empty($resume->skills))
            <section>
                <x-section-header
                    title="Skills & Expertise"
                    icon-color="from-purple-500 to-pink-600">
                    <x-slot:icon>
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                        </svg>
                    </x-slot:icon>
                </x-section-header>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($resume->skills as $skill)
                        <x-section-card>
                            <div class="flex justify-between items-start mb-4">
                                <h3 class="text-xl font-bold text-slate-800">{{ $skill->name }}</h3>
                                @if($skill->level)
                                    <span
                                        class="px-3 py-1 {{ $skill->level->color() }} text-white text-sm font-medium rounded-full shadow-sm">
                                        {{ $skill->level->title() }}
                                    </span>
                                @endif
                            </div>

                            @if(!empty($skill->keywords))
                                <div class="flex flex-wrap gap-2">
                                    @foreach($skill->keywords as $keyword)
                                        <span
                                            class="px-3 py-1 bg-gradient-to-r from-slate-100 to-slate-200 text-slate-700 text-sm font-medium rounded-full shadow-sm hover:shadow-md transition-shadow duration-200">
                                            {{ $keyword }}
                                        </span>
                                    @endforeach
                                </div>
                            @endif
                        </x-section-card>
                    @endforeach
                </div>
            </section>
        @endif

        <!-- Projects Section -->
        @if(!empty($resume->projects))
            <section>
                <x-section-header
                    title="Featured Projects"
                    icon-color="from-orange-500 to-red-600">
                    <x-slot:icon>
                        <svg class="w-6 h-6 text-white stroke-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.25 9.75 16.5 12l-2.25 2.25m-4.5 0L7.5 12l2.25-2.25M6 20.25h12A2.25 2.25 0 0 0 20.25 18V6A2.25 2.25 0 0 0 18 3.75H6A2.25 2.25 0 0 0 3.75 6v12A2.25 2.25 0 0 0 6 20.25Z" />
                        </svg>
                    </x-slot:icon>
                </x-section-header>

                <div class="space-y-6">
                    @foreach($resume->projects as $project)
                        <x-section-card>
                            <div class="flex flex-col lg:flex-row lg:justify-between lg:items-start mb-4">
                                <div class="flex-1">
                                    <h3 class="text-2xl font-bold text-slate-800 mb-2">{{ $project->name }}</h3>
                                </div>

                                <x-date-badge :start-date="$project->startDate" :end-date="$project->endDate" />
                            </div>

                            <x-external-link :href="$project->url" />

                            @if($project->description)
                                <p class="text-slate-700 mb-4 leading-relaxed">{{ $project->description }}</p>
                            @endif

                            <x-highlight-list :highlights="$project->highlights"
                                              bullet-color="from-orange-500 to-red-500" />
                        </x-section-card>
                    @endforeach
                </div>
            </section>
        @endif
    </div>
</x-layout>
