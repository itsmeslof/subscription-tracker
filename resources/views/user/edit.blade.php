<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8">
        <div class="bg-white border border-slate-300 rounded-lg overflow-hidden divide-y divide-slate-300 dark:bg-slate-800 dark:border-slate-600 dark:border-slate-600 dark:divide-slate-600">
            <div class="p-6 flex space-x-2">
                <h2 class="font-semibold text-2xl font-bold text-slate-600 leading-tight dark:text-slate-100">Edit Account Details</h2>
            </div>
            <div class="p-6">
                <x-status-errors :errors="$errors->details" />
                <x-status-info-alert :status="session('status:account_settings')" />

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

                            <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $user->email)" required />
                        </div>
                        <div class="mt-6">
                            <button type="submit" class="flex items-center text-sm font-medium border border-slate-600 bg-slate-600 text-white hover:text-white hover:bg-slate-700 hover:border-slate-700 focus:outline-none focus:outline-none focus:ring ring-blue-300 focus:text-white focus:bg-slate-700 focus:border-slate-700 transition duration-150 ease-in-out px-5 py-2 rounded-lg">Update Account</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="bg-white border border-slate-300 rounded-lg overflow-hidden mt-6 divide-y divide-slate-300 dark:bg-slate-800 dark:border-slate-600 dark:border-slate-600 dark:divide-slate-600">
            <div class="p-6 flex space-x-2">
                <h2 class="font-semibold text-2xl font-bold text-slate-600 leading-tight dark:text-slate-100">Change Password</h2>
            </div>
            <div class="p-6">
                <x-status-errors :errors="$errors->password" />
                <x-status-info-alert :status="session('status:user_password')" />

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

                            <x-input id="new_password" class="block mt-1 w-full" type="password" name="new_password" :value="old('new_password', '')" required />
                        </div>
                        <div class="mt-6">
                            <button type="submit" class="flex items-center text-sm font-medium border border-slate-600 bg-slate-600 text-white hover:text-white hover:bg-slate-700 hover:border-slate-700 focus:outline-none focus:outline-none focus:ring ring-blue-300 focus:text-white focus:bg-slate-700 focus:border-slate-700 transition duration-150 ease-in-out px-5 py-2 rounded-lg">Change Password</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="bg-white border border-slate-300 divide-y divide-slate-300 rounded-lg overflow-hidden mt-6 dark:bg-slate-800 dark:border-slate-600 dark:border-slate-600 dark:divide-slate-600">
            <div class="p-6 flex space-x-2">
                <h2 class="font-semibold text-2xl font-bold text-slate-600 leading-tight dark:text-slate-100">Settings</h2>
            </div>
            <div class="bg-slate-100 text-slate-600 px-6 py-2 dark:bg-slate-900">
                <p class="text-sm text-slate-700 dark:text-slate-300">General</p>
            </div>
            <div class="p-6">
                <x-status-errors :errors="$errors->userSettings" />
                <x-status-info-alert :status="session('status:settings:general')" />

                <form action="{{ route('user.settings.update') }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="max-w-lg flex flex-col space-y-4">
                        <div>
                            <x-label for="theme" value="Theme" />

                            <select name="theme" id="theme" class="rounded-md shadow-sm border-gray-300 focus:border-blue-300 focus:ring focus:ring-blue-300 focus:ring-opacity-50 block mt-1 w-full dark:bg-slate-800 dark:border-slate-600 dark:focus:ring-blue-300 dark:text-slate-100" required>
                                <option value="light" {{ !$user->theme === 'light' ? 'selected' : '' }} class="dark:text-slate-300">Light</option>
                                <option value="dark" {{ $user->theme === 'dark' ? 'selected' : '' }} class="dark:text-slate-300">Dark</option>
                                <option value="system" {{ $user->theme === 'system' ? 'selected' : '' }} class="dark:text-slate-300">System Preference</option>
                            </select>
                        </div>
                        <div class="mt-6">
                            <button type="submit" class="flex items-center text-sm font-medium border border-slate-600 bg-slate-600 text-white hover:text-white hover:bg-slate-700 hover:border-slate-700 focus:outline-none focus:outline-none focus:ring ring-blue-300 focus:text-white focus:bg-slate-700 focus:border-slate-700 transition duration-150 ease-in-out px-5 py-2 rounded-lg">Update General Settings</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
