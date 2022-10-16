@props(['amount'])

<div class="bg-white border border-slate-300 py-6 px-6 flex flex-col justify-between rounded-lg dark:bg-slate-800 dark:border-slate-600">
    <div class="mb-8">
        <h4 class="text-slate-600 text-sm mb-2 dark:text-slate-300">Annual</h4>
        <h2 class="text-slate-700 text-2xl font-bold dark:text-slate-100">{{ $amount }}</h2>
    </div>

    <h3 class="text-slate-600 text-xs dark:text-slate-300">Annual costs factor all subscriptions during a 12-month period.</h3>
</div>
