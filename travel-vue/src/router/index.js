//import vue router
import { createRouter, createWebHistory } from 'vue-router'

//define a routes
const routes = [
    {
        path: '/',
        name: 'travel.index_user',
        component: () => import( /* webpackChunkName: "travel.Index_user" */ '@/views/travel/Index_user.vue')
    },
    {
        path: '/create_user',
        name: 'travel.create_user',
        component: () => import( /* webpackChunkName: "travel.Create_user" */ '@/views/travel/Create_user.vue')
    },
    {
        path: '/edit_user/:id',
        name: 'travel.edit_user',
        component: () => import( /* webpackChunkName: "travel.Edit_user" */ '@/views/travel/Edit_user.vue')
    }
]

//create router
const router = createRouter({
    history: createWebHistory(),
    routes  // config routes
})

export default router