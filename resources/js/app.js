/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;
import router from "./router";
import store from './store/index'

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('test-component', require('./components/TestComponent').default);
Vue.component('users', require('./components/Users').default);
Vue.component('loading', require('./components/LoadingComponent').default);
Vue.component('todo', require('./components/Todo').default);
Vue.component('todo-list', require('./components/TodoList').default);
Vue.component('todo-item', require('./components/TodoItem').default);
Vue.component('add-todo', require('./components/AddTodo').default);
Vue.component('loader', require('./components/Loader').default);
Vue.component('vuex-page', require('./views/Vuex-Page').default);
Vue.component('post-form', require('./components/PostForm').default);
Vue.component('fast-registration', require('./auth/FastRegistration').default);
Vue.component('fast-login', require('./auth/FastLogin').default);
Vue.component('own-touch-register', require('./auth/OwnTouchRegister').default);
Vue.component('own-touch-login', require('./auth/OwnTouchLogin').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router,
    store
});
