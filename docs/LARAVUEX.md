# Laravuex

1. composer create-project laravel/laravel project-name
2. create models diagram
3. create repository on github
4. git init
5. git add .
6. git commit -m "Init"
7. git remote add origin https://github.com/dev4rweb/laravuex.git
8. git push -u origin master
9. fill migration fields
10. create faker data four User with role
11. php artisan migrate:refresh --seed
12. [https://github.com/laravel/ui](https://github.com/laravel/ui)
13. composer require laravel/ui
14. php artisan ui vue --auth
15. npm install && npm run dev
16. npm update vue-loader
17. npm ci && npm run dev
18. npm i vue-router vuex
19. /resources/js/pages/App.vu
```html
<template>
    <div>
        <div class="container">
            <h1>Main Page</h1>
        </div>
    </div>
</template>

<script>
export default {
    name: "App"
}
</script>

<style scoped>

</style>

```

20. change resources/js/app.js
```javascript
import Vue from "vue";
import App from "./pages/App";

require('./bootstrap');
window.Vue = require('vue').default;

const files = require.context('./', true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('app', require('./pages/App').default)

const app = new Vue({
    el: '#app',
    components: {App}
});
```
    
21. create resources/views/index.blade.php
```html
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{mix('css/app.css')}}">
    <title>Spa Trello</title>
</head>
<body>
<div id="app">
    <app></app>
</div>
<script src="{{mix('js/app.js')}}"></script>
</body>
</html>
```
22. create app/Http/Controllers/SpaController.php
```injectablephp
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SpaController extends Controller
{
    public function index()
    {
        return view('index');
    }
}
```
23. change /routes/web.php
```injectablephp
Route::get('/{any}', [SpaController::class, 'index'])->where('any', '.*');
```
24. create pages in /resources/js/pages/
25. create resources/js/router.js
```javascript
import Vue from "vue";
import VueRouter from 'vue-router'
import HomePage from "./pages/HomePage";
import AboutPage from "./pages/AboutPage";
import ContactsPage from "./pages/ContactsPage";

Vue.use(VueRouter)

const routes = [
    {
        path: '/',
        name: 'home',
        component: HomePage
    },
    {
        path: '/about',
        name: 'about',
        component: AboutPage
    },
    {
        path: '/contacts',
        name: 'contacts',
        component: ContactsPage
    },
]

export default new VueRouter({
    mode: 'history',
    routes
})
```
26. Add router in /resources/js/app.js
```javascript
import Vue from "vue";
import VueRouter from "vue-router";
import App from "./pages/App";
import router from "./router";
Vue.use(VueRouter)

require('./bootstrap');
window.Vue = require('vue').default;

const files = require.context('./', true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('app', require('./pages/App').default)

const app = new Vue({
    el: '#app',
    components: {App},
    router
});

```
27. create resources/js/components/UI/NavBar.vue
```vue
<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <router-link :to="{name: 'home'}" class="nav-link active" aria-current="page" href="#"
                        >Home
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link :to="{name: 'about'}" class="nav-link" href="#">About</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link :to="{name: 'contacts'}" class="nav-link" href="#">Contacts</router-link>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
export default {
    name: "NavBar"
}
</script>

<style scoped>

</style>

```
28. add navbar in /resources/js/pages/App.vue
```vue
<template>
    <div>
<!--        <nav-bar></nav-bar>-->
        <NavBar/>
        <div class="container">
            <h1>Main Page</h1>
            <router-view/>
        </div>
    </div>
</template>

<script>
import NavBar from "../components/UI/NavBar";
export default {
    name: "App",
    components: {NavBar}
}
</script>

<style scoped>

</style>
```
29. php artisan make:controller Api/UserController --api

30. add to routes/api.php
```injectablephp
Route::apiResources([
    'users' => UserController::class,
]);
```
    
31. create /resources/js/store/usersModule.js
```javascript
export default  {
    state: {
        users: [],
    },
    mutations: {
        setUsers(state, payload) {
            state.users = payload
        }
    },
    getters: {
        getAllUsers(state) {
            return state.users
        }
    },
    actions: {
        fetchUsers(context) {
            axios.get(`/api/users`)
                .then(res => {
                    console.log('fetchUsers res', res)
                    if (res.data.success) {
                        context.commit('setUsers', res.data.models)
                    }
                })
                .catch(err => {
                    console.log('fetchUsers err', err.response.data)
                })
                .finally(() => {
                    console.log('fetchUsers finally')
                });
        }
    }
}

```

32. create /resources/js/store/index.js
```javascript
import Vue from "vue";
import Vuex from 'vuex'
import usersModule from "./usersModule";

Vue.use(Vuex)

export default new Vuex.Store({
    modules: {
        usersModule
    }
})
```
33. change /resources/js/app.js
```javascript
import Vue from "vue";
import VueRouter from "vue-router";
import App from "./pages/App";
import router from "./router";
import store from './store/index'
Vue.use(VueRouter)

require('./bootstrap');
window.Vue = require('vue').default;

const files = require.context('./', true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('app', require('./pages/App').default)

const app = new Vue({
    el: '#app',
    components: {App},
    router,
    store
});

```

34. change HomePage.vue
35. https://bootstrap-vue.org/docs
