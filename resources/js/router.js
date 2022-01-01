import Vue from "vue";
import Router from 'vue-router'
import TabHome from "./views/TabHome";

Vue.use(Router)

export default new Router({
    mode: 'history',
    routes: [
        {
            path: '/todo',
            component: TabHome
        },
        {
            path: '/tab-todos',
            component: () => import('./views/TabTodos')
        }
    ]
})
