<template>
    <tr>
        <td class="px-6 py-3 max-w-0 w-full whitespace-no-wrap text-sm leading-5 font-medium text-gray-900">
            <div class="flex items-center space-x-3 lg:pl-2">
                <div class="flex-shrink-0 w-2.5 h-2.5 rounded-full bg-green-600"></div>
                <a :href="'/accounts/' + account.id" class="truncate hover:text-gray-600">
                                            <span>{{ account.name }} <span
                                                class="text-gray-500 font-normal" v-text="account.purpose"></span> </span>
                </a>
            </div>
        </td>
        <td class="hidden md:table-cell px-6 py-3 whitespace-no-wrap text-sm leading-5 text-gray-500 text-right" v-text="account.last_accessed">
        </td>
        <td class="pr-6">
            <div class="relative flex justify-end items-center">
                <button @click="toggleDropdown" id="project-options-menu-0" aria-has-popup="true" type="button"
                        class="w-8 h-8 inline-flex items-center justify-center text-gray-400 rounded-full bg-transparent hover:text-gray-500 focus:outline-none focus:text-gray-500 focus:bg-gray-100 transition ease-in-out duration-150">
                    <svg class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                        <path
                            d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"/>
                    </svg>
                </button>
                <div @click="dropdownOpen = false" v-show="dropdownOpen" class="fixed inset-0 bg-black opacity-25 z-10"></div>

                <transition
                    enter-active-class="transition ease-out duration-100"
                    enter-class="transform opacity-0 scale-95"
                    enter-to-class="transform opacity-100 scale-100"
                    leave-active-class="transition ease-in duration-75"
                    leave-class="transform opacity-100 scale-100"
                    leave-to-class="transform opacity-0 scale-95"
                >
                    <div v-show="dropdownOpen"
                         class="mx-3 origin-top-right absolute right-7 top-0 w-48 mt-1 rounded-md shadow-lg">
                        <div class="relative z-20 rounded-md bg-white shadow-xs" role="menu"
                             aria-orientation="vertical" aria-labelledby="project-options-menu-0">
                            <div class="py-1">
                                <a :href="'/accounts/' + account.id + '/edit'"
                                   class="group flex items-center px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900"
                                   role="menuitem">
                                    <svg
                                        class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500 group-focus:text-gray-500"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path
                                            d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"/>
                                        <path fill-rule="evenodd"
                                              d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                    Edit
                                </a>
                            </div>
                            <div class="border-t border-gray-100"></div>
                            <div class="py-1">
                                <a href="#" @click="confirmDelete"
                                   class="group flex items-center px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900"
                                   role="menuitem">
                                    <svg
                                        class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500 group-focus:text-gray-500"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                              d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                    Delete
                                </a>
                            </div>
                        </div>
                    </div>
                </transition>
            </div>
        </td>
    </tr>
</template>

<script>
import Swal from 'sweetalert2';

export default {
    props: ['account'],
    data() {
        return {
            dropdownOpen: false
        }
    },
    methods: {
        toggleDropdown() {
            this.dropdownOpen = !this.dropdownOpen;
        },
        confirmDelete() {
            this.dropdownOpen = !this.dropdownOpen;
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete('/accounts/' + this.account.id).then(()=> {
                        Swal.fire(
                            'Deleted!',
                            'Account has been deleted.',
                            'success'
                        );
                        this.$emit('deleted')
                    }).catch(()=> {
                        Swal.fire(
                            'Not Deleted!',
                            'Account could not be deleted.',
                            'error'
                        );
                    });
                }
            })
        }
    }
}
</script>

<style scoped>

</style>
