<div class="overflow-x-auto relative">
    <table class="w-full text-left text-sm">
        <thead class="bg-slate-100 text-slate-600 border-y border-slate-300">
            <tr>
                <th scope="col" class="py-4 px-4">Name</th>
                <th scope="col" class="py-4 px-4">Price</th>
                <th scope="col" class="py-4 px-4">Billing Cycle</th>
                <th scope="col" class="py-4 px-4">Renewal</th>
                <th scope="col" class="py-4 px-4"></th>
            </tr>
        </thead>

        <tbody class="divide-y">
            @forelse ($subscriptions as $subscription)
                <tr class="bg-white hover:bg-slate-100">
                    <td scope="row" class="py-4 px-4">
                        <div class="flex justify-start space-x-2 items-center">
                            <span style="width: 20px; height: 20px; border-radius: 100px; background-color: {{ $subscription->color }};"></span> <p>{{ $subscription->name }}</p>
                        </div>
                    </td>
                    <td scope="row" class="py-4 px-4">{{ $subscription->getFormattedPrice() }}</td>
                    <td scope="row" class="py-4 px-4"><span class="bg-slate-200 rounded-lg py-1 px-3 inline-block capitalize">{{ $subscription->billingCycle->name }}</span></td>
                    <td scope="row" class="py-4 px-4">
                        @if ($subscription->renewal_note)
                            <span class="bg-slate-200 rounded-lg py-1 px-3 inline-block">{{ $subscription->renewal_note }}</span>
                        @endif
                    </td>
                    <td scope="row" class="py-4 px-4 w-auto text-right"><a href="{{ route('subscriptions.edit', $subscription) }}" class="inline-block text-sm underline text-gray-600 hover:text-gray-900 transition ease-in-out duration-150">Manage</a></td>
                </tr>
            @empty
                <tr>
                    <td scope="row" class="py-4 px-4">No subscriptions found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
