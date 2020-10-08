<template>
    <!-- Profile dropdown -->
    <div class="ml-3 relative">
        <div>
            <button @click="toggle"
                class="max-w-xs flex items-center text-sm rounded-full focus:outline-none focus:shadow-outline"
                id="user-menu" aria-label="User menu" aria-haspopup="true">
                <img class="h-8 w-8 rounded-full"
                     :src="avatar"
                     alt="">
            </button>
        </div>
        <div @click="isOpen = false" v-show="isOpen" class="fixed inset-0 bg-black opacity-25 z-10"></div>
        <transition
            enter-active-class="transition ease-out duration-100"
            enter-class="transform opacity-0 scale-95"
            enter-to-class="transform opacity-100 scale-100"
            leave-active-class="transition ease-in duration-75"
            leave-class="transform opacity-100 scale-100"
            leave-to-class="transform opacity-0 scale-95"
        >
            <div v-show="isOpen" class="origin-top-right absolute right-0 z-20 mt-2 w-48 rounded-md shadow-lg">
                <div class="rounded-md bg-white shadow-xs" role="menu" aria-orientation="vertical"
                     aria-labelledby="user-menu">
                    <div class="py-1">
                        <a v-for="menu in menus" :href="menu.url"
                           class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900"
                           role="menuitem" v-text="menu.title" />
                    </div>
                    <div class="border-t border-gray-100"></div>
                    <div class="py-1">
                        <a href="#" @click.prevent="logout"
                           class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900"
                           role="menuitem">Logout</a>
                    </div>
                </div>
            </div>
        </transition>
    </div>
</template>
<script>
export default {
    props: ['menus', 'user'],
    data() {
        return {
            isOpen: false,
        }
    },
    methods: {
        toggle() {
            this.isOpen = !this.isOpen;
        },
        logout() {
            axios.post('/logout').then(()=> {
                window.location.replace('/');
            });
        }
    },
    computed: {
        avatar() {
            return this.user.avatar_url ?? '/images/avatar.svg';
        }
    }
}
</script>
