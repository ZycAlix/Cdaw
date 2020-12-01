// console.log('hi,woshi luyouqi');

// import VueRouter from 'vue-router'
// import Home from '../vue/home.vue'
// import About from '../vue/about.vue'
// import Login from '../vue/login.vue'
// import Vue from 'vue'

// Vue.use(VueRouter)


// const routes = [
//     {path:'/',component:Login},
//     {path:'/home',component:Home},
//     {path:'/about',component:About}]  //路由表

// const router = new VueRouter({
//     routes
// })


// export default router;

import Vue from 'vue'
import Router from 'vue-router'
import Login from '@/vue/login.vue'
// import Main from '@/view/main/main.vue'
import Home from '@/vue/home.vue'

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
        }
    ]
})