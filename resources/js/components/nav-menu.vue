<template>
    <div class="flex">
        <!-- Off-canvas menu for mobile -->
        <div v-show="sidebarOpen" class="lg:hidden">
            <div class="fixed inset-0 flex z-40">
                <transition
                    enter-active-class="transition-opacity ease-linear duration-300"
                    enter-class="opacity-0"
                    enter-to-class="opacity-100"
                    leave-active-class="transition-opacity ease-linear duration-300"
                    leave-class="opacity-100"
                    leave-to-class="opacity-0"
                >

                    <div v-show="sidebarOpen" class="fixed inset-0">
                        <div class="absolute inset-0 bg-gray-600 opacity-75"></div>
                    </div>
                </transition>

                <transition
                    enter-active-class="transition ease-in-out duration-300 transform"
                    enter-class="-translate-x-full"
                    enter-to-class="translate-x-0"
                    leave-active-class="transition ease-in-out duration-300 transform"
                    leave-class="translate-x-0"
                    leave-to-class="-translate-x-full"
                >

                    <div v-show="sidebarOpen" class="relative flex-1 flex flex-col max-w-xs w-full pt-5 pb-4 bg-white">
                        <div class="absolute top-0 right-0 -mr-14 p-1">
                            <button @click="closeSidebar"
                                class="flex items-center justify-center h-12 w-12 rounded-full focus:outline-none focus:bg-gray-600"
                                aria-label="Close sidebar">
                                <svg class="h-6 w-6 text-white" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                        <div class="flex-shrink-0 flex items-center px-4">
                            <svg class="h-4 w-auto" viewBox="0 0 640 512">
                                <path fill="currentColor"
                                      d="M537.6 226.6c4.1-10.7 6.4-22.4 6.4-34.6 0-53-43-96-96-96-19.7 0-38.1 6-53.3 16.2C367 64.2 315.3 32 256 32c-88.4 0-160 71.6-160 160 0 2.7.1 5.4.2 8.1C40.2 219.8 0 273.2 0 336c0 79.5 64.5 144 144 144h368c70.7 0 128-57.3 128-128 0-61.9-44-113.6-102.4-125.4zm-132.9 88.7L299.3 420.7c-6.2 6.2-16.4 6.2-22.6 0L171.3 315.3c-10.1-10.1-2.9-27.3 11.3-27.3H248V176c0-8.8 7.2-16 16-16h48c8.8 0 16 7.2 16 16v112h65.4c14.2 0 21.4 17.2 11.3 27.3z"/>
                            </svg>
                            <div class="ml-2 text-lg font-medium leading-6 text-gray-900">AWS Snapshots</div>
                        </div>
                        <user-account-dropdown
                        avatar-url="https://images.unsplash.com/photo-1502685104226-ee32379fefbe?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                        name="Shane Poppleton"
                        username="codemonkey76"
                        :menus="userMenus"></user-account-dropdown>
                        <div class="mt-5 flex-1 h-0 overflow-y-auto">
                            <nav class="px-2">
                                <div class="space-y-1">
                                    <a v-for="menu in menus" :href="menu.url"
                                       :class="offCanvasMenuClass(menu.url)"
                                       class="group flex items-center px-2 py-2 text-base leading-5 font-medium rounded-md hover:text-gray-900 focus:outline-none transition ease-in-out duration-150">
                                        <svg
                                            :class="svgClass(menu.url)"
                                            class="mr-3 h-6 w-6 group-hover:text-gray-500 group-focus:text-gray-600 transition ease-in-out duration-150"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor" v-html="menu.icon" />
                                        {{ menu.name }}
                                    </a>
                                </div>
                                <div class="mt-8">
                                    <h3 class="px-3 text-xs leading-4 font-semibold text-gray-500 uppercase tracking-wider" id="teams-headline">
                                        Accounts
                                    </h3>
                                    <div class="mt-1 space-y-1" role="group" aria-labelledby="teams-headline">
                                        <a v-for="account in accountMenus" :href="account.url" class="group flex items-center px-3 py-2 text-base leading-5 font-medium text-gray-600 rounded-md hover:text-gray-900 hover:bg-gray-50 focus:outline-none focus:bg-gray-50 transition ease-in-out duration-150">
                                            <span class="w-2.5 h-2.5 mr-4 bg-indigo-500 rounded-full"></span>
                                            <span class="truncate" v-text="account.name" />
                                        </a>
                                    </div>
                                </div>
                            </nav>
                        </div>
                    </div>
                </transition>
                <div class="flex-shrink-0 w-14">
                    <!-- Dummy element to force sidebar to shrink to fit close icon -->
                </div>
            </div>
        </div>
        <!-- Static sidebar for desktop -->
        <div class="hidden lg:flex lg:flex-shrink-0">
            <div class="flex flex-col w-64 border-r border-gray-200 pt-5 pb-4 bg-gray-100">
                <div class="flex items-center flex-shrink-0 px-6">
                    <svg class="h-4 w-auto" viewBox="0 0 640 512">
                        <path fill="currentColor"
                              d="M537.6 226.6c4.1-10.7 6.4-22.4 6.4-34.6 0-53-43-96-96-96-19.7 0-38.1 6-53.3 16.2C367 64.2 315.3 32 256 32c-88.4 0-160 71.6-160 160 0 2.7.1 5.4.2 8.1C40.2 219.8 0 273.2 0 336c0 79.5 64.5 144 144 144h368c70.7 0 128-57.3 128-128 0-61.9-44-113.6-102.4-125.4zm-132.9 88.7L299.3 420.7c-6.2 6.2-16.4 6.2-22.6 0L171.3 315.3c-10.1-10.1-2.9-27.3 11.3-27.3H248V176c0-8.8 7.2-16 16-16h48c8.8 0 16 7.2 16 16v112h65.4c14.2 0 21.4 17.2 11.3 27.3z"/>
                    </svg>
                    <div class="ml-2 text-lg font-medium leading-6 text-gray-900">AWS Snapshots</div>
                </div>
                <user-account-dropdown
                    :avatar-url="user.avatar_url"
                    :name="user.name"
                    :username="user.username"
                    :menus="userMenus"></user-account-dropdown>
                <!-- Sidebar component, swap this element with another sidebar if you like -->
                <div class="h-0 flex-1 flex flex-col overflow-y-auto">
                    <!-- Navigation -->
                    <nav class="px-3 mt-6">
                        <div class="space-y-1">
                            <a v-for="menu in menus" :href="menu.url" :class="mainMenuClass(menu.url)"
                               class="group flex items-center px-2 py-2 text-sm leading-5 font-medium rounded-md focus:outline-none focus:bg-gray-50 transition ease-in-out duration-150">
                                <svg
                                    :class="svgClass(menu.url)"
                                    class="mr-3 h-6 w-6 group-hover:text-gray-500 group-focus:text-gray-600 transition ease-in-out duration-150"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor" v-html="menu.icon">
                                </svg>
                                {{ menu.name }}
                            </a>
                        </div>
                        <div class="mt-8">
                            <h3 class="px-3 text-xs leading-4 font-semibold text-gray-500 uppercase tracking-wider" id="teams-headline">
                                Accounts
                            </h3>
                            <div class="mt-1 space-y-1" role="group" aria-labelledby="teams-headline">
                                <a v-for="account in accountMenus" :href="account.url" class="group flex items-center px-3 py-2 text-base leading-5 font-medium text-gray-600 rounded-md hover:text-gray-900 hover:bg-gray-50 focus:outline-none focus:bg-gray-50 transition ease-in-out duration-150">
                                    <span class="w-2.5 h-2.5 mr-4 bg-indigo-500 rounded-full"></span>
                                    <span class="truncate" v-text="account.name" />
                                </a>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ['sidebarOpen', 'userMenus', 'accounts', 'user'],
    data() {
        return {
            menus: [{
                name: 'AWS Accounts',
                url: '/',
                icon: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />',
            }, {
                name: 'My Tasks',
                url: '/tasks',
                icon: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />'
            }, {
                name: 'Recent',
                url: '/recent',
                icon: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />'
            }],
        }
    },
    computed: {
        accountMenus() {
            return this.accounts.map(item => {
               return {
                   name: item.name,
                   url: '/accounts/' + item.id,
                   icon: '<path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z"/></svg>'
               };
            });
        }
    },
    methods: {
        closeSidebar() {
            this.$root.sidebarOpen = false;
        },
        mainMenuClass(url) {
            return (url === window.location.pathname) ? 'text-gray-900 bg-gray-200' : 'text-gray-700 hover:text-gray-900 hover:bg-gray-50';
        },
        offCanvasMenuClass(url) {
            return (url === window.location.pathname) ? 'text-gray-900 bg-gray-100 hover:bg-gray-100 focus:bg-gray-200' : 'text-gray-600 hover:bg-gray-50 focus:bg-gray-50'
        },
        svgClass(url) {
            return (url === window.location.pathname) ? 'text-gray-500' : 'text-gray-400';
        }
    }
}
</script>
