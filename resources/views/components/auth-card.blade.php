<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-slate-900">
    <div>
        {{ $logo }}
    </div>

    <div class="mt-6 bg-sky-100 border-t-4 border-sky-500 rounded-b text-sky-900 px-4 py-3 shadow-md w-full sm:max-w-md">
        <div class="flex">
            <svg class="fill-current h-6 w-6 text-sky-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg>
            <p class="font-bold">All actions that modify the database are disabled in this demo.</p>
        </div>
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-slate-800 border border-slate-600 shadow-md overflow-hidden sm:rounded-lg">
        {{ $slot }}
    </div>
</div>
