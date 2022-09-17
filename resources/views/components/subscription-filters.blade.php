<div class="flex justify-between items-end" x-data="{
	currentFilters: {
		status: '{{ $status }}',
		cycle: '{{ $cycle }}'
	},
	newFilters: {
		status: '{{ $status }}',
		cycle: '{{ $cycle }}'
	}
}">
	<div class="flex space-x-4 items-end">
		<div>
			<p class="text-slate-600 text-sm mb-2">Status Filter</p>
			<x-dropdown align="left" width="48">
				<x-slot name="trigger">
					<button class="flex items-center justify-between space-x-2 text-sm font-medium border border-slate-300 bg-white text-slate-500 hover:text-slate-700 hover:border-slate-400 focus:outline-none focus:text-slate-700 focus:border-slate-400 transition duration-150 ease-in-out px-5 py-2 rounded-lg min-w-[120px]">
						<p x-text="newFilters.status" class="capitalize"></p>
			
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
						@click="$event.preventDefault(); newFilters.status = 'active';">
						Active
					</a>
					<a href="#" 
						class="block px-4 py-2 text-sm leading-5 text-slate-700 hover:bg-slate-200 focus:outline-none focus:bg-slate-200 transition duration-150 ease-in-out"
						@click="$event.preventDefault(); newFilters.status = 'cancelled';">
						Cancelled
					</a>
				</x-slot>
			</x-dropdown>
		</div>
		<div>
			<p class="text-slate-600 text-sm mb-2">Billing Cycle Filter</p>
			<x-dropdown align="left" width="48">
				<x-slot name="trigger">
					<button class="flex items-center justify-between space-x-2 text-sm font-medium border border-slate-300 bg-white text-slate-500 hover:text-slate-700 hover:border-slate-400 focus:outline-none focus:text-slate-700 focus:border-slate-400 transition duration-150 ease-in-out px-5 py-2 rounded-lg min-w-[120px]">
						<p x-text="newFilters.cycle" class="capitalize"></p>
			
						<div>
							<svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
								<path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
							</svg>
						</div>
					</button>
				</x-slot>

				<x-slot name="content">
					<a href="#" 
						class="block px-4 py-2 text-sm leading-5 text-slate-700 hover:bg-slate-200 focus:outline-none focus:bg-slate-200 transition duration-150 ease-in-out"
						@click="$event.preventDefault(); newFilters.cycle = 'all';">
						All
					</a>
					<a href="#" 
						class="block px-4 py-2 text-sm leading-5 text-slate-700 hover:bg-slate-200 focus:outline-none focus:bg-slate-200 transition duration-150 ease-in-out"
						@click="$event.preventDefault(); newFilters.cycle = 'monthly';">
						Monthly
					</a>
					<a href="#" 
						class="block px-4 py-2 text-sm leading-5 text-slate-700 hover:bg-slate-200 focus:outline-none focus:bg-slate-200 transition duration-150 ease-in-out"
						@click="$event.preventDefault(); newFilters.cycle = 'semiannually';">
						Semiannually
					</a>
					<a href="#" 
						class="block px-4 py-2 text-sm leading-5 text-slate-700 hover:bg-slate-200 focus:outline-none focus:bg-slate-200 transition duration-150 ease-in-out"
						@click="$event.preventDefault(); newFilters.cycle = 'annually';">
						Annually
					</a>
				</x-slot>
			</x-dropdown>
		</div>
		<form action="{{ route('subscriptions.index') }}" method="GET" x-show="(currentFilters.status != newFilters.status) || (currentFilters.cycle != newFilters.cycle)">
			<input type="hidden" name="status" x-model="newFilters.status">
			<input type="hidden" name="cycle" x-model="newFilters.cycle">

			<button class="inline-block text-sm underline text-gray-600 hover:text-gray-900 transition ease-in-out duration-150">Apply Filters</button>
		</form>
		<form action="{{ route('subscriptions.index') }}" method="GET" x-show="currentFilters.status != 'active' || currentFilters.cycle != 'all'">
			<button class="inline-block text-sm underline text-gray-600 hover:text-gray-900 transition ease-in-out duration-150">Reset Filters</button>
		</form>
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
	<h2 class="font-semibold text-2xl font-bold text-slate-600 leading-tight"><span class="capitalize">{{ $status }}</span> Subscriptions</h2>
</div>
