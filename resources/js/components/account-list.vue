<template>
<div>
    <!-- Projects list (only on smallest breakpoint) -->
    <div class="mt-10 sm:hidden">
        <div class="px-4 sm:px-6">
            <h2 class="text-gray-500 text-xs font-medium uppercase tracking-wide">Account</h2>
        </div>
        <ul class="mt-3 border-t border-gray-200 divide-y divide-gray-100">
            <small-account-item></small-account-item>
        </ul>
    </div>
    <!-- Projects table (small breakpoint and up) -->
    <div class="hidden mt-8 sm:block">
        <div class="align-middle inline-block min-w-full border-b border-gray-200">
            <table class="min-w-full">
                <thead>
                <tr class="border-t border-gray-200">
                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                        <span class="lg:pl-2">Account</span>
                    </th>
                    <th class="hidden md:table-cell px-6 py-3 border-b border-gray-200 bg-gray-50 text-right text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                        Last Accessed
                    </th>
                    <th class="pr-6 py-3 border-b border-gray-200 bg-gray-50 text-right text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"></th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    <account-item @deleted="fetch" v-for="account in accounts" :key="account.id" :account="account"></account-item>
                </tbody>
            </table>
        </div>
    </div>
</div>
</template>

<script>
import AccountItem from './account-item';
import SmallAccountItem from './small-account-item';
export default {
    components: {AccountItem, SmallAccountItem},
    data() {
        return {
            accounts: []
        }
    },
    mounted() {
        this.fetch();
    },
    methods: {
        fetch() {
            axios.get('/accounts').then(response => {
                this.accounts = response.data;
            });
        }
    }
}
</script>

<style scoped>

</style>
