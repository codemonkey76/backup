require('./bootstrap');
import Vue from 'vue';

import UserAccountDropdown from './components/user-account-dropdown';
Vue.component('user-account-dropdown', UserAccountDropdown);

import SidebarSearch from './components/sidebar-search';
Vue.component('sidebar-search', SidebarSearch);

import NavMenu from './components/nav-menu';
Vue.component('nav-menu', NavMenu);

import ProfileDropdown from './components/profile-dropdown';
Vue.component('profile-dropdown', ProfileDropdown);

import TaskList from './components/task-list';
Vue.component('task-list', TaskList);

import AccountList from './components/account-list';
Vue.component('account-list', AccountList);

import Alert from './components/alert';
Vue.component('alert', Alert);

const app = new Vue({
    el: '#app',
    data: {
        sidebarOpen: false,
        userMenu: [{
            url: '/users/edit',
            title: 'View profile',
        }, {
            url: '/settings',
            title: 'Settings',
        }, {
            url: '/notifications',
            title: 'Notifications'
        }]
    },
    methods: {
        openSidebar() {
            this.sidebarOpen = true;
        }
    }
});
