<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8">
        <h2 class="font-semibold text-2xl font-bold text-slate-600 leading-tight mb-8">Subscriptions</h2>
        <div class="grid gap-8 grid-cols-2 mb-8">
            <x-monthly-expenses-card :amount="$user->getFormattedMonthlySubscriptionCost()"></x-monthly-expenses-card>
            <x-annual-expenses-card :amount="$user->getFormattedAnnualSubscriptionCost()"></x-annual-expenses-card>
        </div>

        <div class="bg-white border border-slate-300 rounded-lg pb-8" x-data="{ filter: 'Active' }">
            <div class="py-6 px-6">
                <div class="flex justify-between items-end">
                    <div>
                        <p class="text-slate-600 text-sm mb-2">Filter</p>
                        <x-dropdown align="left" width="48">
                            <x-slot name="trigger">
                                <button class="flex items-center text-sm font-medium border border-slate-300 bg-white text-slate-500 hover:text-slate-700 hover:border-slate-400 focus:outline-none focus:text-slate-700 focus:border-slate-400 transition duration-150 ease-in-out px-5 py-2 rounded-lg">
                                    <p x-text="filter"></p>
                        
                                    <div class="ml-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>
        
                            <x-slot name="content">
                                <a href="#" 
                                    class="block px-4 py-2 text-sm leading-5 text-slate-700 hover:bg-slate-200 focus:outline-none focus:bg-slate-200 transition duration-150 ease-in-out"
                                    @click="$event.preventDefault(); filter = 'Active';">
                                    Active
                                </a>
                                <a href="#" 
                                    class="block px-4 py-2 text-sm leading-5 text-slate-700 hover:bg-slate-200 focus:outline-none focus:bg-slate-200 transition duration-150 ease-in-out"
                                    @click="$event.preventDefault(); filter = 'Cancelled';">
                                    Cancelled
                                </a>
                            </x-slot>
                        </x-dropdown>
                    </div>
                    <div>
                        <a href="{{ route('subscriptions.create') }}" class="flex items-center text-sm font-medium border border-slate-600 bg-slate-600 text-white hover:text-white hover:bg-slate-700 hover:border-slate-700 focus:outline-none focus:text-white focus:bg-slate-700 focus:border-slate-700 transition duration-150 ease-in-out px-5 py-2 rounded-lg">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" class="mr-2">
                                <path d="M10 7.5V12.5M12.5 10H7.5M17.5 10C17.5 10.9849 17.306 11.9602 16.9291 12.8701C16.5522 13.7801 15.9997 14.6069 15.3033 15.3033C14.6069 15.9997 13.7801 16.5522 12.8701 16.9291C11.9602 17.306 10.9849 17.5 10 17.5C9.01509 17.5 8.03982 17.306 7.12987 16.9291C6.21993 16.5522 5.39314 15.9997 4.6967 15.3033C4.00026 14.6069 3.44781 13.7801 3.0709 12.8701C2.69399 11.9602 2.5 10.9849 2.5 10C2.5 8.01088 3.29018 6.10322 4.6967 4.6967C6.10322 3.29018 8.01088 2.5 10 2.5C11.9891 2.5 13.8968 3.29018 15.3033 4.6967C16.7098 6.10322 17.5 8.01088 17.5 10Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            Add New Subscription
                        </a>
                    </div>
                </div>
                <div class="mt-6">
                    <h2 class="font-semibold text-2xl font-bold text-slate-600 leading-tight"><span x-text="filter"></span> Subscriptions</h2>
                </div>
            </div>
            <div>
                <x-active-subscriptions-table :subscriptions="$activeSubscriptions" />
                <x-cancelled-subscriptions-table :subscriptions="$cancelledSubscriptions" />
            </div>
        </div>
    </div>
</x-app-layout>
