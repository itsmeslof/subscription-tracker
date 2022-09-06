<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Account Settings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

			<div class="bg-white border-b border-gray-200 overflow-x-auto relative shadow-sm sm:rounded-lg">
				<div class="bg-gray-600 text-white py-4 px-4">
					Update Account Details
				</div>
				<div class="py-4 px-4">
					<x-status-errors :errors="$errors->details"></x-status-errors>
					<x-status-info-alert :status="session('status.account_settings')"></x-status-alert>
					
					<form action="{{ route('user.update') }}" method="POST">
						@csrf
						@method('PATCH')
						
						<div class="max-w-lg flex flex-col space-y-4">
							<div>
								<x-label for="username" value="Username" />
			
								<x-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username', $user->username)" required />
							</div>
							<div>
								<x-label for="email" value="Email" />
		
								<x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $user->email)" required autofocus />
							</div>
							<div class="mt-6">
								<x-button>Update Account</x-button>
							</div>
						</div>
	
					</form>
				</div>
				
			</div>

			<div class="bg-white border-2 border-yellow-500 overflow-x-auto relative shadow-sm sm:rounded-lg mt-6">
				<div class="bg-yellow-500 border-b-2 border-yellow-500 text-white py-4 px-4">
					Change Password
				</div>

				
				<div class="py-4 px-4">
					<x-status-errors :errors="$errors->password"></x-status-errors>
					<x-status-info-alert :status="session('status.user_password')"></x-status-alert>

					<form action="{{ route('user.password.update') }}" method="POST">
						@csrf
						@method('PATCH')
						
						<div class="max-w-lg flex flex-col space-y-4">
							<div>
								<x-label for="current_password" value="Current Password" />
			
								<x-input id="current_password" class="block mt-1 w-full" type="password" name="current_password" :value="old('current_password', '')" required />
							</div>
							<div>
								<x-label for="new_password" value="New Password" />
		
								<x-input id="new_password" class="block mt-1 w-full" type="password" name="new_password" :value="old('new_password', '')" required autofocus />
							</div>
							<div class="mt-6">
								<x-button>Update Password</x-button>
							</div>
						</div>
	
					</form>
				</div>
				
			</div>
			
        </div>
    </div>
</x-app-layout>
