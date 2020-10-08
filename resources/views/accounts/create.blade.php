@extends('layouts.main')
@section('main')
    <div
        class="border-b border-gray-200 px-4 py-4 sm:flex sm:items-center sm:justify-between sm:px-6 lg:px-8">
        <div class="flex-1 min-w-0">
            <h1 class="text-lg font-medium leading-6 text-gray-900 sm:truncate">
                Create new AWS Account
            </h1>
        </div>
    </div>
    <div class="max-w-3xl mx-auto px-4 py-4 sm:px-6 lg:px-8">
        <form action="{{ route('accounts.store') }}" method="POST">
            @csrf
            <div>
                <div>
                    <div>
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            AWS Account Setup
                        </h3>
                        <p class="mt-1 text-sm leading-5 text-gray-500">
                            This information will be used to access your AWS account, please set the permissions of the
                            keys used here appropriately.
                        </p>
                    </div>
                    <div class="mt-6 grid grid-cols-1 row-gap-6 col-gap-4 sm:grid-cols-6">
                        <div class="sm:col-span-6">
                            <label for="name" class="block text-sm font-medium leading-5 text-gray-700">
                                Account Name
                            </label>
                            <div class="mt-1 rounded-md shadow-sm">
                                <input id="name" name="name"
                                       class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('name') border border-red-500 @enderror">

                            </div>
                            @error('name')
                            <p class="pt-1 text-red-500 text-xs italic">{{ $errors->first('name') }}</p>
                            @enderror
                        </div>

                        <div class="sm:col-span-6">
                            <label for="purpose" class="block text-sm font-medium leading-5 text-gray-700">
                                Purpose
                            </label>
                            <div class="mt-1 rounded-md shadow-sm">
                                <input id="purpose" name="purpose"
                                       class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('purpose') border border-red-500 @enderror">
                            </div>
                            @error('purpose')
                            <p class="pt-1 text-red-500 text-xs italic">{{ $errors->first('purpose') }}</p>
                            @enderror
                        </div>

                        <div class="sm:col-span-6">
                            <label for="access_key_id" class="block text-sm font-medium leading-5 text-gray-700">
                                Access Key ID
                            </label>
                            <div class="mt-1 rounded-md shadow-sm">
                                <input id="access_key_id" name="access_key_id"
                                       class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('access_key_id') border border-red-500 @enderror">
                            </div>
                            @error('access_key_id')
                            <p class="pt-1 text-red-500 text-xs italic">{{ $errors->first('access_key_id') }}</p>
                            @enderror
                        </div>

                        <div class="sm:col-span-6">
                            <label for="secret_key_id" class="block text-sm font-medium leading-5 text-gray-700">
                                Secret Key ID
                            </label>
                            <div class="mt-1 rounded-md shadow-sm">
                                <input id="secret_key_id" name="secret_key_id"
                                       class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('secret_key_id') border border-red-500 @enderror">
                            </div>
                            @error('secret_key_id')
                            <p class="pt-1 text-red-500 text-xs italic">{{ $errors->first('secret_key_id') }}</p>
                            @enderror
                        </div>

                        <div class="sm:col-span-6">
                            <label for="owner_id" class="block text-sm font-medium leading-5 text-gray-700">
                                Owner ID
                            </label>
                            <div class="mt-1 rounded-md shadow-sm">
                                <input id="owner_id" name="owner_id"
                                       class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('owner_id') border border-red-500 @enderror">
                            </div>
                            @error('owner_id')
                            <p class="pt-1 text-red-500 text-xs italic">{{ $errors->first('owner_id') }}</p>
                            @enderror
                        </div>

                        <div class="sm:col-span-3">
                            <label for="default_region" class="block text-sm font-medium leading-5 text-gray-700">
                                Default Region
                            </label>
                            <div class="mt-1 rounded-md shadow-sm">
                                <select id="default_region" name="default_region" class="form-select block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                                    @foreach ($regions as $region)
                                        <option value="{{$region->id}}">{{$region->description}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="mt-8 border-t border-gray-200 pt-5">
                <div class="flex justify-end">
      <span class="inline-flex rounded-md shadow-sm">
        <a href="/" type="button"
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
