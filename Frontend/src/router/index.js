import About from '@/views/About.vue'
import ChangePassword from '@/views/ChangePassword.vue'
import Home from '@/views/Home.vue'
import Login from '@/views/Login.vue'
import Login_username from '@/views/Login_username.vue'
import Profile from '@/views/Profile.vue'
import Prompt from '@/views/Prompt.vue'
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
    { path: '/settings', component: Settings, meta: {auth: true}},
    { path: '/change-password', component: ChangePassword, meta: {auth: true}},
    { path: '/ToS', component: TermsOfService },
    { path: '/prompt', component: Prompt },
  ],
})

router.beforeEach((to, from, next) => {
  const token = localStorage.getItem('token')

  if (to.meta.auth && !token) {
    return next('/login')
  }

  if (to.meta.guest && token) {
    return next('/')
  }
  
  next()
})

export default router
