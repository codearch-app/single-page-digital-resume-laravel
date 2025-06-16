<div class="fixed top-4 sm:top-6 right-4 sm:right-6 z-50">
    <form action="/download" method="POST">
        @csrf
        <button type="submit"
            class="group inline-flex items-center gap-2 px-3 sm:px-4 py-2 sm:py-3 bg-white hover:bg-gray-50 text-slate-700 font-semibold rounded-lg shadow-lg hover:shadow-xl border border-slate-200 transform hover:scale-105 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
            <svg class="w-4 sm:w-5 h-4 sm:h-5 text-slate-600 group-hover:text-blue-600 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            <span class="hidden sm:inline text-sm sm:text-base">Download PDF</span>
            <span class="sm:hidden text-xs">PDF</span>
        </button>
    </form>
</div>
