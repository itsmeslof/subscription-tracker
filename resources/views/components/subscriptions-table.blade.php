<div class="bg-white border-b border-gray-200 overflow-x-auto relative shadow-sm sm:rounded-lg">
	<table class="w-full text-left text-sm">
		<thead class="bg-gray-600 text-white">
			<tr>
				<th scope="col" class="py-4 px-4">Name</th>
				<th scope="col" class="py-4 px-4">Price</th>
				<th scope="col" class="py-4 px-4">Billing Cycle</th>
				<th scope="col" class="py-4 px-4"></th>
			</tr>
		</thead>
	
		<tbody>
			@forelse ($subscriptions as $subscription)
				<tr>
					<td scope="row" class="py-4 px-4">
						<div class="flex justify-start space-x-2 items-center">
							<span style="width: 20px; height: 20px; border-radius: 100px; background-color: {{ $subscription->color }};"></span> <p>{{ $subscription->name }}</p>
						</div>
					</td>
					<td scope="row" class="py-4 px-4">{{ $subscription->getFormattedPrice() }}</td>
					<td scope="row" class="py-4 px-4">{{ ucfirst($subscription->billingCycle->name) }}</td>
					<td scope="row" class="py-4 px-4 w-auto"><a href="#">Manage</a></td>
				</tr>
			@empty
				<tr>
					<td scope="row">No subscriptions</td>
				</tr>
			@endforelse
		</tbody>
	</table>
</div>
