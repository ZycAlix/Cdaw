
import Vue from 'vue'
import Router from 'vue-router'
import Login from '@/vue/login.vue'
// import Main from '@/view/main/main.vue'
import Home from '@/vue/home.vue'
import Main from '@/vue/main.vue'
import Administrateur from '@/vue/administrateur.vue'

Vue.use(Router)

export default new Router({
    routes: [
        {
            path: '/',
            name: 'Login',
            component: Login
        },
        // {
        //     path: '/main',
        //     name: 'Main',
        //     component: Main
        // },
        {
            path: '/home',
            name: 'Home',
            component: Home
        },
        {
            path: '/administrateur/main',
            name: 'Main',
            component: Main
        },
        {
            path: '/administrateur',
            name: 'Administrateur',
            component: Administrateur
        }
    ]
})