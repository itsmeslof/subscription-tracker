<div class="overflow-x-auto relative">
    <table class="table-auto w-full text-left text-sm divide-y divide-slate-300 dark:divide-slate-600">
        <thead class="bg-slate-100 text-slate-600 dark:text-slate-400 dark:bg-slate-900">
            <tr>
                <th scope="col" class="py-4 px-4 whitespace-nowrap">Name</th>
                <th scope="col" class="py-4 px-4 whitespace-nowrap">Price</th>
                <th scope="col" class="py-4 px-4 whitespace-nowrap">Billing Cycle</th>
                <th scope="col" class="py-4 px-4 whitespace-nowrap">Renewal</th>
                <th scope="col" class="py-4 px-4 whitespace-nowrap"></th>
            </tr>
        </thead>

        <tbody class="divide-y divide-slate-300 dark:divide-slate-600 overflow-scroll">
            @forelse ($subscriptions as $subscription)
                <tr class="bg-white hover:bg-slate-100 dark:bg-slate-800 dark:hover:bg-slate-700">
                    <td scope="row" class="py-4 px-4 whitespace-nowrap">
                        <div class="flex justify-start space-x-2 items-center">
                            <span style="width: 20px; height: 20px; border-radius: 100px; background-color: {{ $subscription->color }};" class="border border-slate-700 dark:border-slate-400"></span> <p class="text-slate-600 dark:text-slate-300">{{ $subscription->name }}</p>
                        </div>
                    </td>
                    <td scope="row" class="py-4 px-4 text-slate-600 dark:text-slate-300 whitespace-nowrap">{{ $subscription->getFormattedPrice() }}</td>
                    <td scope="row" class="py-4 px-4 text-slate-600 dark:text-slate-300 whitespace-nowrap"><span class="bg-slate-200 dark:bg-slate-600 rounded-lg py-1 px-3 inline-block capitalize">{{ $subscription->billingCycle->name }}</span></td>
                    <td scope="row" class="py-4 px-4 text-slate-600 dark:text-slate-300 whitespace-nowrap">
                        @if ($subscription->renewal_note)
                            <span class="bg-slate-200 dark:bg-slate-600 rounded-lg py-1 px-3 inline-block">{{ $subscription->renewal_note }}</span>
                        @endif
                    </td>
                    <td scope="row" class="py-4 px-4 w-auto text-right whitespace-nowrap"><a href="{{ route('subscriptions.edit', $subscription) }}" class="inline-block text-sm underline text-gray-600 hover:text-gray-900 transition ease-in-out duration-150 dark:text-slate-300 dark:hover:text-slate-100">Manage</a></td>
                </tr>
            @empty
                <tr>
                    <td scope="row" class="py-4 px-4 dark:text-slate-300">No subscriptions found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
