import About from '@/views/About.vue'
import Allusers from '@/views/Allusers.vue'
import ChangePassword from '@/views/ChangePassword.vue'
import CreatePrompt from '@/views/CreatePrompt.vue'
import Dashboard from '@/views/Dashboard.vue'
import Home from '@/views/Home.vue'
import Login from '@/views/Login.vue'
import Login_username from '@/views/Login_username.vue'
import Myprompt from '@/views/Myprompt.vue'
import Profile from '@/views/Profile.vue'
import Prompt from '@/views/Prompt.vue'
import Promptmanage from '@/views/Promptmanage.vue'
import Register from '@/views/Register.vue'
import Settings from '@/views/Settings.vue'
import TermsOfService from '@/views/TermsOfService.vue'
import { createRouter, createWebHistory } from 'vue-router'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    { path: '/login', component: Login, meta:{guest:true}},
    { path: '/login/username', component: Login_username, meta: {guest:true}},
    { path: '/register', component: Register, meta: {guest:true}},
    { path: '/', component: Home, meta: {auth: true}},
    { path: '/about', component: About },
    { path: '/profile', component: Profile, meta: {auth: true}},
    { path: '/profile/myprompt', component: Myprompt, meta: {auth: true}},
    { path: '/profile/myprompt/create', component: CreatePrompt, meta: {auth: true}},
    { path: '/settings', component: Settings, meta: {auth: true}},
    { path: '/change-password', component: ChangePassword, meta: {auth: true}},
    { path: '/ToS', component: TermsOfService },
    { path: '/prompt', component: Prompt },
    { path: '/dashboard', component: Dashboard, meta: {auth:true, role: 'admin'}},
    { path: '/dashboard/allusers', component: Allusers, meta: {auth:true, role: 'admin'}},
    { path: '/dashboard/prompt', component: Promptmanage, meta: {auth:true, role: 'admin'}}
  ],
})

router.beforeEach((to, from, next) => {
  const token = localStorage.getItem('token')
  const role = localStorage.getItem('role')

  if (to.meta.auth && !token) {
    return next('/login')
  } 

  if (to.meta.guest && token) {
    return next(role === 'admin' ? '/dashboard' : '/')
  }

  if(to.meta.role && to.meta.role !== role) {
    return next('/')
  }

  next()
})

export default router
