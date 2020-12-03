
import Vue from 'vue'
import Router from 'vue-router'
import Login from '@/vue/login.vue'
import Home from '@/vue/home.vue'
import Main from '@/vue/main.vue'
import Administrateur from '@/vue/administrateur.vue'

Vue.use(Router)

export default new Router({
    routes: [
        {
            path: '/login',
            name: 'Login',
            component: Login
        },
        {
            path: '/',
            redirect:'/login'
        },
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