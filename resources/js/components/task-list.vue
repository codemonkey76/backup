<template>
    <div class="flex flex-col">
        <!-- Projects list (only on smallest breakpoint) -->
        <div class="mt-10 sm:hidden">
            <div class="px-4 sm:px-6">
                <h2 class="text-gray-500 text-xs font-medium uppercase tracking-wide">Name</h2>
            </div>
            <ul class="mt-3 border-t border-gray-200 divide-y divide-gray-100">
                <small-task-item v-for="task in tasks" :key="task.id" :task="task"></small-task-item>
            </ul>
        </div>
        <!-- Projects table (small breakpoint and up) -->
        <div class="hidden mt-8 sm:block">
            <div class="align-middle inline-block min-w-full border-b border-gray-200">

                <table class="min-w-full">
                    <thead>
                    <tr class="border-t border-gray-200">
                        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            <span class="lg:pl-2">Name</span>
                        </th>
                        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Command
                        </th>
                        <th class="hidden md:table-cell px-6 py-3 border-b border-gray-200 bg-gray-50 text-right text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Arguments
                        </th>
                        <th class="pr-6 py-3 border-b border-gray-200 bg-gray-50 text-right text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"></th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        <task-item @deleted="fetch" v-for="task in tasks" :key="task.id" :task="task"></task-item>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
<script>
import TaskItem from './task-item';
import SmallTaskItem from './small-task-item'
export default {
    components: {TaskItem, SmallTaskItem},
    props: ['accountId'],
    data() {
        return {
            tasks: []
        }
    },
    mounted() {
        this.fetch();
    },
    methods: {
        fetch() {
            axios.get('/accounts/' + this.accountId + '/tasks').then(response => {
                this.tasks = response.data;
            })
        }
    }
}
</script>
