<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8">
        <div class="bg-white border border-slate-300 divide-y divide-slate-300 rounded-lg overflow-hidden mt-6">
            <div class="p-6 flex space-x-2">
                <h2 class="font-semibold text-2xl font-bold text-slate-600 leading-tight">Edit Global Site Settings</h2>
            </div>
            {{-- <div class="bg-slate-100 text-slate-600 px-6 py-2">
                <p class="text-sm text-slate-700">General</p>
            </div> --}}
            <div class="p-6">
                <x-status-errors :errors="$errors->siteSettings" />
                <x-status-info-alert :status="session('status:settings:global')" />

                <form action="{{ route('admin.site_settings.update') }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="max-w-lg flex flex-col space-y-4">
                        <div>
                            <x-label for="registration_enabled" value="Enable User Registration" />

                            <select name="registration_enabled" id="registration_enabled" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" required>
                                <option value="0" {{ !$settings?->registration_enabled ? 'selected' : '' }}>No</option>
                                <option value="1" {{ $settings->registration_enabled ? 'selected' : '' }}>Yes</option>
                            </select>
                        </div>
                        <div>
                            <x-label for="show_home_page" value="Show Home Page" />

                            <select name="show_home_page" id="show_home_page" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" required>
                                <option value="0" {{ !$settings->show_home_page ? 'selected' : '' }}>No</option>
                                <option value="1" {{ $settings->show_home_page ? 'selected' : '' }}>Yes</option>
                            </select>
                        </div>
                        <div class="mt-6">
                            <button type="submit" class="flex items-center text-sm font-medium border border-slate-600 bg-slate-600 text-white hover:text-white hover:bg-slate-700 hover:border-slate-700 focus:outline-none focus:outline-none focus:ring ring-blue-300 focus:text-white focus:bg-slate-700 focus:border-slate-700 transition duration-150 ease-in-out px-5 py-2 rounded-lg">Update Site Settings</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
