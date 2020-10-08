@extends('layouts.main')
@section('main')
    <div
        class="border-b border-gray-200 px-4 py-4 sm:flex sm:items-center sm:justify-between sm:px-6 lg:px-8">
        <div class="flex-1 min-w-0">
            <h1 class="text-lg font-medium leading-6 text-gray-900 sm:truncate">
                Edit user profile
            </h1>
        </div>
    </div>
    <div class="max-w-3xl mx-auto px-4 py-4 sm:px-6 lg:px-8">
        <form action="{{ route('users.update') }}" method="POST">
            @csrf
            @method('PATCH')
            <div>
                <div>
                    <!-- Header Text -->
                    <div>
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            Profile
                        </h3>
                        <p class="mt-1 text-sm leading-5 text-gray-500">
                            Set your avatar and user details.
                        </p>
                    </div>

                    <div class="mt-6 grid grid-cols-1 row-gap-6 col-gap-4 sm:grid-cols-6">

                        <!-- Name -->
                        <div class="sm:col-span-3">
                            <label for="name" class="block text-sm font-medium leading-5 text-gray-700">
                                Name
                            </label>
                            <div class="mt-1 rounded-md shadow-sm">
                                <input id="name"
                                       name="name"
                                       class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('name') border border-red-500 @enderror"
                                       value="{{ old('name', $user->name) }}">
                            </div>
                            @error('name')
                            <p class="pt-1 text-red-500 text-xs italic">{{ $errors->first('name') }}</p>
                            @enderror
                        </div>

                        <!-- Username -->
                        <div class="sm:col-span-4">
                            <label for="username" class="block text-sm font-medium leading-5 text-gray-700">
                                Username
                            </label>
                            <div class="mt-1 flex rounded-md shadow-sm">
                                <span
                                    class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">
                                    @
                                </span>
                                <input id="username"
                                       name="username"
                                       class="flex-1 form-input block w-full min-w-0 rounded-none rounded-r-md transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('username') border border-red-500 @enderror"
                                       value="{{ old('username', $user->username) }}">
                            </div>
                            @error('username')
                            <p class="pt-1 text-red-500 text-xs italic">{{ $errors->first('username') }}</p>
                            @enderror
                        </div>

                        <!-- Email address -->
                        <div class="sm:col-span-4">
                            <label for="email" class="block text-sm font-medium leading-5 text-gray-700">
                                Email address
                            </label>
                            <div class="mt-1 rounded-md shadow-sm">
                                <input id="email"
                                       type="email"
                                       name="email"
                                       class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('email') border border-red-500 @enderror"
                                       value="{{ old('email', $user->email) }}">
                            </div>
                            @error('email')
                            <p class="pt-1 text-red-500 text-xs italic">{{ $errors->first('email') }}</p>
                            @enderror
                        </div>

                        <!-- Avatar -->
                        <div class="sm:col-span-6">
                            <label for="avatar_url" class="block text-sm leading-5 font-medium text-gray-700">
                                Avatar
                            </label>
                            <div class="mt-2 flex items-center">
                                <span class="h-12 w-12 rounded-full overflow-hidden bg-gray-100">
                                    <svg class="h-full w-full text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z"/>
                                    </svg>
                                </span>
                                <span class="ml-5 rounded-md shadow-sm">
                                    <input type="file" class="hidden" id="file" name="file"/>
                                    <button type="button" onclick="document.getElementById('file').click();"
                                            class="py-2 px-3 border border-gray-300 rounded-md text-sm leading-4 font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out">
                                        Change
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Password reset section -->
                    <div class="mt-8 border-t border-gray-200 pt-8">

                        <!-- Header text -->
                        <div>
                            <h3 class="text-lg leading-6 font-medium text-gray-900">
                                Password Reset
                            </h3>
                            <p class="mt-1 text-sm leading-5 text-gray-500">
                                Leave these blank if you don't want to reset your password.
                            </p>
                        </div>

                        <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                            <!-- Password -->
                            <div class="sm:col-span-4">
                                <label for="password" class="block text-sm font-medium leading-5 text-gray-700">
                                    Password
                                </label>
                                <div class="mt-1 rounded-md shadow-sm">
                                    <input id="password"
                                           type="password"
                                           name="password"
                                           class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('password') border border-red-500 @enderror">
                                </div>
                                @error('password')
                                <p class="pt-1 text-red-500 text-xs italic">{{ $errors->first('password') }}</p>
                                @enderror
                            </div>

                            <!-- Password confirmation -->
                            <div class="sm:col-span-4">
                                <label for="password_confirmation"
                                       class="block text-sm font-medium leading-5 text-gray-700">
                                    Confirm Password
                                </label>
                                <div class="mt-1 rounded-md shadow-sm">
                                    <input id="password_confirmation"
                                           type="password"
                                           name="password_confirmation"
                                           class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('password') border border-red-500 @enderror">
                                </div>
                                @error('password')
                                <p class="pt-1 text-red-500 text-xs italic">{{ $errors->first('password') }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Form footer -->
                <div class="mt-8 border-t border-gray-200 pt-5">
                    <div class="flex justify-end">
                    <span class="inline-flex rounded-md shadow-sm">
                        <button type="button"
                                class="py-2 px-4 border border-gray-300 rounded-md text-sm leading-5 font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out">
                                Cancel
                        </button>
                    </span>
                        <span class="ml-3 inline-flex rounded-md shadow-sm">
                        <button type="submit"
                                class="inline-flex justify-center py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out">
                            Save
                        </button>
                    </span>
                    </div>
                </div>
        </form>
    </div>
@endsection
