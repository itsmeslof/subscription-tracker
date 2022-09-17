<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8">
        <h2 class="font-semibold text-2xl font-bold text-slate-600 leading-tight mb-8">Subscriptions</h2>
        <div class="grid gap-8 grid-cols-2 mb-8">
            <x-monthly-expenses-card :amount="$user->getFormattedMonthlySubscriptionCost()"></x-monthly-expenses-card>
            <x-annual-expenses-card :amount="$user->getFormattedAnnualSubscriptionCost()"></x-annual-expenses-card>
        </div>

        <div class="bg-white border border-slate-300 rounded-lg overflow-hidden">
            <div class="py-6 px-6">
                <x-subscription-filters :status="$status" :cycle="$cycle" />
            </div>
            <div>
                <x-subscriptions-table :subscriptions="$subscriptions" :status="$status" />
            </div>
            @if ($subscriptions->hasPages())
            <div class="px-6 py-6 bg-slate-100 border-t border-slate-300">
                {{ $subscriptions->links() }}
            </div>
            @endif
        </div>
    </div>
</x-app-layout>
