@extends('layouts.main')
@section('main')
    <div
        class="border-b border-gray-200 px-4 py-4 sm:flex sm:items-center sm:justify-between sm:px-6 lg:px-8">
        <div class="flex-1 min-w-0">
            <h1 class="text-lg font-medium leading-6 text-gray-900 sm:truncate">
                <span>{{$account->name}} <span
                        class="text-gray-500 font-normal">{{$account->purpose}}</span></span>
            </h1>
        </div>
        <div class="mt-4 flex sm:mt-0 sm:ml-4">
                        <span class="order-0 sm:order-1 sm:ml-3 shadow-sm rounded-md">
            <a href="{{ route('tasks.create', $account->id) }}" type="button"
               class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-purple-600 hover:bg-purple-500 focus:outline-none focus:shadow-outline-purple focus:border-purple-700 active:bg-indigo-700 transition duration-150 ease-in-out">
              Create Task
            </a>
          </span>
        </div>
    </div>
    <task-list :account-id="{{$account->id}}"></task-list>
@endsection
