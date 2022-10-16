<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8">
        <x-status-info-alert :status="session('status')"></x-status-alert>
        <div class="grid gap-8 grid-cols-2 mb-8">
            <x-monthly-expenses-card :amount="$user->formatted_monthly_cost" />
            <x-annual-expenses-card :amount="$user->formatted_annual_cost" />
        </div>

        <div class="bg-white border border-slate-300 rounded-lg overflow-hidden dark:bg-slate-800 dark:border-slate-600 divide-y divide-slate-300 dark:divide-slate-600">
            <x-subscription-filters :status="$filterData->get('status')" :cycle="$filterData->get('cycle')" />
            <x-subscriptions-table :subscriptions="$subscriptions" :status="$filterData->get('status')" />
            @if ($subscriptions->hasPages())
                <div class="px-6 py-6 bg-slate-100 dark:bg-slate-900">
                    {{ $subscriptions->links() }}
                </div>
            @else
                <div class="px-6 py-6 bg-slate-100 dark:bg-slate-900">
                    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                        <p class="text-sm text-gray-700 leading-5 dark:text-slate-300">Showing {{ $subscriptions->count() }} {{ $subscriptions->count() === 1 ? 'result' : 'results' }}</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
