import { createRouter, createWebHistory } from 'vue-router'
import CharacterCreate from '../pages/CharacterCreate.vue'
import CharacterSheet from '../pages/CharacterSheet.vue'
import Login from '../pages/Login.vue'
import Home from '../pages/Home.vue'

const routes = [
    {
        path: '/',
        redirect: '/characters/new',
    },
    {
        path: '/characters/new',
        component: CharacterCreate,
    },
    {
        path: '/characters/:id',
        component: CharacterSheet,
    },
    {
        path: '/login',
        name: 'login',
        component: Login,
    },
    {
        path: '/home',
        component: Home,
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes,
})

export default router