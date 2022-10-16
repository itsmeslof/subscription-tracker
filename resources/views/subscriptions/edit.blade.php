<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8">
        <div class="bg-white border border-slate-300 rounded-lg overflow-hidden divide-y divide-slate-300 dark:bg-slate-800 dark:border-slate-600 dark:border-slate-600 dark:divide-slate-600">
            <div class="p-6 flex space-x-2">
                <h2 class="font-semibold text-2xl font-bold text-slate-600 leading-tight dark:text-slate-100">Manage Subscription</h2>
                @if ($subscription->cancelled)
                    <span class="bg-orange-100 text-orange-900 font-bold text-xs flex justify-center items-center px-4 rounded-full">Cancelled</span>
                @else
                    <span class="bg-teal-100 text-teal-900 font-bold text-xs flex justify-center items-center px-4 rounded-full">Active</span>
                @endif
            </div>
            <div class="p-6">
                <x-status-errors :errors="$errors"></x-status-errors>
                <x-status-info-alert :status="session('status')"></x-status-alert>
                <form action="{{ route('subscriptions.update', $subscription) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="max-w-lg flex flex-col space-y-4">
                        <div>
                            <x-label for="color" value="Color" />

                            <x-input id="color" class="block mt-1 w-full" type="color" name="color" :value="old('color', $subscription->color)" required />
                        </div>
                        <div>
                            <x-label for="name" value="Name" />

                            <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $subscription->name)" required />
                        </div>
                        <div>
                            <x-label for="amount" value="Amount" />

                            <div class="relative">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                    <span class="text-gray-500 sm:text-sm">$</span>
                                </div>
                                <x-input id="amount" class="block mt-1 w-full pl-7" type="number" min="0.01" step="0.01" name="amount" :value="old('amount', $subscription->getFullAmountAsDecimal())" required />
                            </div>
                        </div>
                        <div>
                            <x-label for="billing_cycle_id" value="Billing Cycle" />

                            <select name="billing_cycle_id" id="billing_cycle_id" class="rounded-md shadow-sm border-gray-300 focus:border-blue-300 focus:ring focus:ring-blue-300 focus:ring-opacity-50 block mt-1 w-full dark:bg-slate-800 dark:border-slate-600 dark:focus:ring-blue-300 dark:text-slate-100" required>
                                @foreach ($availableBillingCycles as $billingCycle)
                                    <option
                                        value="{{ $billingCycle->id }}"
                                        @if ($subscription->billingCycle->id === $billingCycle->id)
                                            selected
                                        @endif()
                                    >
                                        {{ ucfirst($billingCycle->name) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <x-label for="renewal_note" value="Renewal" />

                            <x-input id="renewal_note" class="block mt-1 w-full" type="text" name="renewal_note" :value="$subscription->renewal_note" />
                        </div>
                        <div class="mt-6">
                            <button type="submit" class="flex items-center text-sm font-medium border border-slate-600 bg-slate-600 text-white hover:text-white hover:bg-slate-700 hover:border-slate-700 focus:outline-none focus:outline-none focus:ring ring-blue-300 focus:text-white focus:bg-slate-700 focus:border-slate-700 transition duration-150 ease-in-out px-5 py-2 rounded-lg">Update Subscription</button>
                        </div>
                    </div>

                </form>
            </div>
            <div class="bg-slate-100 text-slate-600 px-6 py-2 dark:bg-slate-900">
                <p class="text-sm text-slate-700 dark:text-slate-300">More Actions</p>
            </div>
            <div class="p-6">
                <div class="flex space-x-2">
                    @if ($subscription->cancelled)
                    <form action="{{ route('subscriptions.activate', $subscription) }}" method="POST">
                        @csrf
                        <button type="submit" class="flex items-center text-sm font-medium border border-slate-600 bg-slate-600 text-white hover:text-white hover:bg-slate-700 hover:border-slate-700 focus:outline-none focus:ring ring-blue-300 focus:text-white focus:bg-slate-700 focus:border-slate-700 transition duration-150 ease-in-out px-5 py-2 rounded-lg">Activate Subscription</button>
                    </form>
                    @else
                    <form action="{{ route('subscriptions.cancel', $subscription) }}" method="POST">
                        @csrf
                        <button type="submit" class="flex items-center text-sm font-medium border border-slate-600 bg-slate-600 text-white hover:text-white hover:bg-slate-700 hover:border-slate-700 focus:outline-none focus:ring ring-blue-300 focus:text-white focus:bg-slate-700 focus:border-slate-700 transition duration-150 ease-in-out px-5 py-2 rounded-lg">Cancel Subscription</button>
                    </form>
                    @endif
                    <form action="{{ route('subscriptions.destroy', $subscription) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="flex items-center text-sm font-medium border border-red-600 text-red-600 hover:text-white hover:bg-red-700 hover:border-red-700 focus:outline-none focus:ring ring-blue-300 focus:text-white focus:bg-red-700 focus:border-red-700 transition duration-150 ease-in-out px-5 py-2 rounded-lg">Delete Subscription</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
