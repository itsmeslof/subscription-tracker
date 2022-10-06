<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8">
        <x-status-info-alert :status="session('status')"></x-status-alert>
        <div class="grid gap-8 grid-cols-2 mb-8">
            <x-monthly-expenses-card :amount="$user->getFormattedMonthlySubscriptionCost()" />
            <x-annual-expenses-card :amount="$user->getFormattedAnnualSubscriptionCost()" />
        </div>

        <div class="bg-white border border-slate-300 rounded-lg overflow-hidden">
            <x-subscription-filters :status="$filterData->get('status')" :cycle="$filterData->get('cycle')" />
            <x-subscriptions-table :subscriptions="$subscriptions" :status="$filterData->get('status')" />
            @if ($subscriptions->hasPages())
                <div class="px-6 py-6 bg-slate-100 border-t border-slate-300">
                    {{ $subscriptions->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
