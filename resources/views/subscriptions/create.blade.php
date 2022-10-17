<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8">
        <div class='mb-4 bg-red-100 border-t-4 border-red-500 rounded-b text-red-900 px-4 py-3 shadow-md'>
            <div class="flex">
                <svg class="fill-current h-6 w-6 text-red-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg>
                <p class="font-bold">Creating subscriptions is disabled in the demo</p>
            </div>
        </div>
        <div class="bg-white border border-slate-300 rounded-lg overflow-hidden divide-y divide-slate-300 dark:bg-slate-800 dark:border-slate-600 dark:border-slate-600 dark:divide-slate-600">
            <div class="p-6 flex space-x-2">
                <h2 class="font-semibold text-2xl font-bold text-slate-600 leading-tight dark:text-slate-100">Add New Subscription</h2>
            </div>
            <div class="p-6">
                <form action="{{ route('subscriptions.store') }}" method="POST">
                    @csrf

                    <div class="max-w-lg flex flex-col space-y-4">
                        <div>
                            <x-label for="color" value="Color" />

                            <x-input id="color" class="block mt-1 w-full" type="color" name="color" :value="old('color', '#475569')" required />
                        </div>
                        <div>
                            <x-label for="name" value="Name" />

                            <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required />
                        </div>
                        <div>
                            <x-label for="amount" value="Amount" />

                            <div class="relative">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                    <span class="text-gray-500 sm:text-sm">$</span>
                                </div>
                                <x-input id="amount" class="block mt-1 w-full pl-7" type="number" min="0.01" step="0.01" name="amount" :value="old('amount')" required />
                            </div>
                        </div>
                        <div>
                            <x-label for="billing_cycle_id" value="Billing Cycle" />

                            <select name="billing_cycle_id" id="billing_cycle_id" class="rounded-md shadow-sm border-gray-300 focus:border-blue-300 focus:ring focus:ring-blue-300 focus:ring-opacity-50 block mt-1 w-full dark:bg-slate-800 dark:border-slate-600 dark:focus:ring-blue-300 dark:text-slate-100" required>
                                @foreach ($availableBillingCycles as $billingCycle)
                                    <option value="{{ $billingCycle->id }}">
                                        {{ ucfirst($billingCycle->name) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <x-label for="renewal_note" value="Renewal" />

                            <x-input id="renewal_note" class="block mt-1 w-full" type="text" name="renewal_note" :value="old('renewal_note')" />
                        </div>
                        <div class="mt-6">
                            <button type="submit" class="flex items-center text-sm font-medium border border-slate-600 bg-slate-600 text-white hover:text-white hover:bg-slate-700 hover:border-slate-700 focus:outline-none focus:outline-none focus:ring ring-blue-300 focus:text-white focus:bg-slate-700 focus:border-slate-700 transition duration-150 ease-in-out px-5 py-2 rounded-lg">Add Subscription</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
