<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
            <a href="{{ route('subscriptions.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">Create Subscription <span class="ml-2 inline-block"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                <path fill-rule="evenodd" d="M5 10a.75.75 0 01.75-.75h6.638L10.23 7.29a.75.75 0 111.04-1.08l3.5 3.25a.75.75 0 010 1.08l-3.5 3.25a.75.75 0 11-1.04-1.08l2.158-1.96H5.75A.75.75 0 015 10z" clip-rule="evenodd" />
              </svg>
              
              </span></a>
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
