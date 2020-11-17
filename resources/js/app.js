/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');



/**
 * Importing and integrating vue-flash-message in vue app
 */

import FlashMessage from '@smartweb/vue-flash-message';
Vue.use(FlashMessage);


/**
 * Importing and integrating vue-router in vue app *
 */

import VueRouter from 'vue-router'
Vue.use(VueRouter)


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/Projects.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

const projects =  require('./components/projects/Projects.vue').default

Vue.component('projects', projects);
Vue.component('add-project-form', require('./components/projects/AddProjectForm.vue').default);
Vue.component('projects-list', require('./components/projects/ProjectsList').default);


const tasks = require('./components/tasks/Tasks.vue').default

Vue.component('tasks', tasks);
Vue.component('add-task-form', require('./components/tasks/AddTaskForm.vue').default);
Vue.component('tasks-list', require('./components/tasks/TasksList').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const routes = [
    { path: '/', component: projects },
    { path: '/projects/:projectId', component: tasks }
]

const router = new VueRouter({
    routes // short for `routes: routes`
})

const app = new Vue({
    router,
}).$mount('#app')
