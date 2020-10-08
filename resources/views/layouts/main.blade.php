@extends('layouts.app')

@section('content')
    <div class="h-screen flex overflow-hidden bg-white">
        <alert :message="{{ json_encode(session('flash_message')) }}"></alert>
        <nav-menu :sidebar-open="sidebarOpen"
                  :user-menus="userMenu"
        :accounts="{{json_encode($accounts)}}"
        :user="{{json_encode(Auth::user())}}"></nav-menu>
        <!-- Main column -->
        <div class="flex flex-col w-0 flex-1 overflow-hidden">
            <!-- Search header -->
            <div class="relative z-10 flex-shrink-0 flex h-16 bg-white border-b border-gray-200 lg:hidden">
                <!-- Sidebar toggle, controls the 'sidebarOpen' sidebar state. -->
                <button @click="openSidebar"
                        class="px-4 border-r border-gray-200 text-gray-500 focus:outline-none focus:bg-gray-100 focus:text-gray-600 lg:hidden"
                        aria-label="Open sidebar">
                    <svg class="h-6 w-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M4 6h16M4 12h8m-8 6h16"/>
                    </svg>
                </button>
                <div class="ml-4 flex flex-1 items-center">
                    <svg class="h-4 w-auto" viewBox="0 0 640 512">
                        <path fill="currentColor"
                              d="M537.6 226.6c4.1-10.7 6.4-22.4 6.4-34.6 0-53-43-96-96-96-19.7 0-38.1 6-53.3 16.2C367 64.2 315.3 32 256 32c-88.4 0-160 71.6-160 160 0 2.7.1 5.4.2 8.1C40.2 219.8 0 273.2 0 336c0 79.5 64.5 144 144 144h368c70.7 0 128-57.3 128-128 0-61.9-44-113.6-102.4-125.4zm-132.9 88.7L299.3 420.7c-6.2 6.2-16.4 6.2-22.6 0L171.3 315.3c-10.1-10.1-2.9-27.3 11.3-27.3H248V176c0-8.8 7.2-16 16-16h48c8.8 0 16 7.2 16 16v112h65.4c14.2 0 21.4 17.2 11.3 27.3z"/>
                    </svg>
                    <div class="ml-2 text-lg font-medium leading-6 text-gray-900">AWS Snapshots</div>
                </div>
                <div class="flex justify-between px-4 sm:px-6 lg:px-8">
                    <div class="flex items-center">
                        <profile-dropdown :menus="userMenu" :user="{{json_encode(Auth::user())}}"></profile-dropdown>
                    </div>
                </div>
            </div>
            <main class="flex-1 relative z-0 overflow-y-auto focus:outline-none" tabindex="0">
                @yield('main')
            </main>
        </div>
    </div>
@endsection

