<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
            <a href="{{ route('subscriptions.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">Create Subscription</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-6 flex space-x-4">
                <div class="w-2/3">
                    <h2>Monthly: <span class="font-bold text-blue-500">{{ $user->getFormattedMonthlySubscriptionCost() }}</span></h2>
                    <p class="text-xs text-gray-500">Monthly costs only factor subscriptions that are paid on a per-month basis, and does not include semiannual or annual subscriptions.</p>
                </div>
                <div class="w-1/3">
                    <h2>Annual: <span class="font-bold text-blue-500">{{ $user->getFormattedAnnualSubscriptionCost() }}</span></h2>
                    <p class="text-xs text-gray-500">Annual costs factor all subscriptions during a 12-month period.</p>
                </div>
            </div>

            <div class="">
                <x-subscriptions-table :subscriptions="$activeSubscriptions"></x-subscriptions-table>
            </div>

        </div>
    </div>
</x-app-layout>
