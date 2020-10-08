@extends('layouts.main')
@section('main')
    <div
        class="border-b border-gray-200 px-4 py-4 sm:flex sm:items-center sm:justify-between sm:px-6 lg:px-8">
        <div class="flex-1 min-w-0">
            <h1 class="text-lg font-medium leading-6 text-gray-900 sm:truncate">
                Create new Task
            </h1>
        </div>
    </div>
    <div class="max-w-3xl mx-auto px-4 py-4 sm:px-6 lg:px-8">
        <form action="{{ route('tasks.store', $account->id) }}" method="POST">
            @csrf
            <div>
                <div>
                    <div>
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            Task Creation
                        </h3>
                        <p class="mt-1 text-sm leading-5 text-gray-500">
                            You can execute any valid artisan command
                        </p>
                    </div>

                    <div class="mt-6 grid grid-cols-1 row-gap-6 col-gap-4 sm:grid-cols-6">

                        <input type="hidden" value="{{$account->id}}" name="account_id">
                        <!-- Description -->
                        <div class="sm:col-span-6">
                            <label for="name" class="block text-sm font-medium leading-5 text-gray-700">
                                Description of task
                            </label>
                            <div class="mt-1 rounded-md shadow-sm">
                                <input id="name" name="name"
                                       class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('name') border border-red-500 @enderror">

                            </div>
                            @error('name')
                            <p class="pt-1 text-red-500 text-xs italic">{{ $errors->first('name') }}</p>
                            @enderror
                        </div>

                        <!-- Command -->
                        <div class="sm:col-span-6">
                            <label for="purpose" class="block text-sm font-medium leading-5 text-gray-700">
                                Command
                            </label>
                            <div class="mt-1 rounded-md shadow-sm">
                                <input id="command" name="command"
                                       class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('command') border border-red-500 @enderror">
                            </div>
                            @error('command')
                            <p class="pt-1 text-red-500 text-xs italic">{{ $errors->first('command') }}</p>
                            @enderror
                        </div>

                        <!-- Arguments -->
                        <div class="sm:col-span-6">
                            <label for="arguments" class="block text-sm font-medium leading-5 text-gray-700">
                                Arguments
                            </label>
                            <div class="mt-1 rounded-md shadow-sm">
                                <input id="arguments" name="arguments"
                                       class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('arguments') border border-red-500 @enderror">
                            </div>
                            @error('arguments')
                            <p class="pt-1 text-red-500 text-xs italic">{{ $errors->first('arguments') }}</p>
                            @enderror
                        </div>

                        <!-- Frequency -->
                        <div class="sm:col-span-6">
                            <label for="frequency" class="block text-sm font-medium leading-5 text-gray-700">
                                Frequency
                            </label>
                            <div class="mt-1 rounded-md shadow-sm">
                                <select id="frequency" name="frequency"
                                        class="form-select block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                                    @foreach(frequencies() as $frequency)
                                        <option value="{{$frequency}}">{{parseCamelCase($frequency)}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('frequency')
                            <p class="pt-1 text-red-500 text-xs italic">{{ $errors->first('frequency') }}</p>
                            @enderror
                        </div>

                        <!-- Limit -->
                        <div class="sm:col-span-6">
                            <label for="limit" class="block text-sm font-medium leading-5 text-gray-700">
                                Limit to
                            </label>
                            <div class="mt-1 rounded-md shadow-sm">
                                <select id="limit" name="limit"
                                        class="form-select block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                                    <option value="">-- No Limit --</option>
                                    @foreach(limits() as $limit)
                                        <option value="{{$limit}}">{{parseCamelCase($limit)}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('limit')
                            <p class="pt-1 text-red-500 text-xs italic">{{ $errors->first('limit') }}</p>
                            @enderror
                        </div>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    {{ $error }}<br>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="mt-8 border-t border-gray-200 pt-5">
                <div class="flex justify-end">
                    <span class="inline-flex rounded-md shadow-sm">
                        <a href="{{ route('accounts.show', $account->id) }}" type="button"
                            class="py-2 px-4 border border-gray-300 rounded-md text-sm leading-5 font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out">
                            Cancel
                        </a>
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
