<template>
    <div class="px-3 mt-6 relative inline-block text-left">
        <!-- Dropdown menu toggle, controlling the show/hide state of dropdown menu. -->
        <div>
            <button type="button" @click="toggle"
                    class="group w-full rounded-md px-3.5 py-2 text-sm leading-5 font-medium text-gray-700 hover:bg-gray-50 hover:text-gray-500 focus:outline-none focus:bg-gray-200 focus:border-blue-300 active:bg-gray-50 active:text-gray-800 transition ease-in-out duration-150"
                    id="options-menu" aria-haspopup="true" aria-expanded="true">
                <div class="flex w-full justify-between items-center">
                    <div class="flex items-center justify-between space-x-3">
                        <img class="w-10 h-10 bg-gray-300 rounded-full flex-shrink-0"
                             :src="avatar"
                             alt="">
                        <div class="flex-1">
                            <h2 class="text-gray-900 text-sm leading-5 font-medium" v-text="name"></h2>
                            <p class="text-gray-500 text-sm leading-5 truncate">@{{ username }}</p>
                        </div>
                    </div>
                    <svg class="h-5 w-5 text-gray-400 group-hover:text-gray-500" viewBox="0 0 20 20"
                         fill="currentColor">
                        <path fill-rule="evenodd"
                              d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                              clip-rule="evenodd"/>
                    </svg>
                </div>
            </button>
        </div>
        <div @click="isOpen = false" v-show="isOpen" class="fixed inset-0 bg-black opacity-25 z-10"></div>
        <transition
            enter-active-class="transition ease-out duration-100"
            enter-class="opacity-0 scale-95"
            enter-to-class="transform opacity-100 scale-100"
            leave-active-class="transition ease-in duration-75"
            leave-class="transform opacity-100 scale-100"
            leave-to-class="transform opacity-0 scale-95"
        >

            <div v-show="isOpen" class="z-20 mx-3 origin-top absolute right-0 left-0 mt-1 rounded-md shadow-lg">
                <div class="rounded-md bg-white shadow-xs" role="menu" aria-orientation="vertical"
                     aria-labelledby="options-menu">
                    <div class="py-1">
                        <a v-for="menu in menus" :href="menu.url"
                           class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900"
                           role="menuitem" v-text="menu.title"/>
                    </div>
                    <div class="border-t border-gray-100"></div>
                    <div class="py-1">
                        <a href="#"
                           class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900"
                           role="menuitem" @click.prevent="logout">Logout</a>
                    </div>
                </div>
            </div>
        </transition>
    </div>
</template>
<script>
export default {
    props: ['avatarUrl', 'name', 'username', 'menus'],
    data() {
        return {
            isOpen: false,
        }
    },
    methods: {
        toggle() {
            this.isOpen = !this.isOpen
        },
        logout() {
            axios.post('/logout').then(() => {
                window.location.replace('/');
            });
        }
    },
    computed: {
        avatar() {
            return this.avatarUrl ?? '/images/avatar.svg';
        }
    }
}
</script>
