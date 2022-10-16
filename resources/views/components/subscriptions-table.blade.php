@props(['status', 'subscriptions'])

@if ($status === 'active')
<div>
    <x-active-subscriptions-table :subscriptions="$subscriptions" />
</div>
@elseif ($status === 'cancelled')
<div>
    <x-cancelled-subscriptions-table :subscriptions="$subscriptions" />
</div>
@else
    <div class="px-6">
        <span class="bg-red-200 rounded-lg py-1 px-3 inline-block capitalize text-slate-700">
            Invalid status filter
        </span>
    </div>
@endif
