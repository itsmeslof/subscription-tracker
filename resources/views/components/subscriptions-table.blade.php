@props(['status', 'subscriptions'])

@if ($status === 'active')
    <x-active-subscriptions-table :subscriptions="$subscriptions" />
@elseif ($status === 'cancelled')
    <x-cancelled-subscriptions-table :subscriptions="$subscriptions" />
@else
    <div class="px-6">
        <span class="bg-red-200 rounded-lg py-1 px-3 inline-block capitalize text-slate-700">
            Invalid status filter
        </span>
    </div>
@endif
