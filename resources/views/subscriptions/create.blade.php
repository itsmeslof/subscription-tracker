<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New Subscription') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

			<div class="bg-white border-b border-gray-200 overflow-x-auto relative shadow-sm sm:rounded-lg">
				<div class="bg-gray-600 text-white py-4 px-4">
					Subscription Details
				</div>
				<div class="py-4 px-4">
					<form action="{{ route('subscriptions.store') }}" method="POST">
						@csrf
						
						<div class="max-w-lg flex flex-col space-y-4">
							<div>
								<x-label for="color" value="Color" />
			
								<x-input style="border-radius: 200px;" id="color" class="block mt-1 w-full" type="color" name="color" value="#4A5571" required />
							</div>
							<div>
								<x-label for="name" value="Name" />
		
								<x-input id="name" class="block mt-1 w-full" type="text" name="name" required autofocus />
							</div>
							<div>
								<x-label for="amount" value="Amount" />
		
								<div class="relative">
									<div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
										<span class="text-gray-500 sm:text-sm">$</span>
									</div>
									<x-input id="amount" class="block mt-1 w-full pl-7" type="number" min="0.01" step="0.01" name="amount" required />
								</div>
							</div>
							<div>
								<x-label for="billing_cycle_id" value="Billing Cycle" />
		
								<select name="billing_cycle_id" id="billing_cycle_id" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" required>
									@foreach ($availableBillingCycles as $billingCycle)
										<option value="{{ $billingCycle->id }}">
											{{ ucfirst($billingCycle->name) }}
										</option>
									@endforeach
								</select>
							</div>
							<div class="mt-6">
								<x-button>Create Subscription</x-button>
							</div>
						</div>
	
					</form>
				</div>
				
			</div>
			
        </div>
    </div>
</x-app-layout>
