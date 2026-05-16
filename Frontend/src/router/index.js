import Home from '@/views/Home.vue'
import Login from '@/views/Login.vue'
import Login_username from '@/views/Login_username.vue'
import Register from '@/views/Register.vue'
import TermsOfService from '@/views/TermsOfService.vue'
import { createRouter, createWebHistory } from 'vue-router'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    { path: '/login', component: Login, meta:{guest:true}},
    { path: '/login/username', component: Login_username, meta:{guest:true}},
    { path: '/register', component: Register, meta: {guest:true}},
    { path: '/', component: Home, meta: {auth: true}},
    { path: '/ToS', component: TermsOfService },
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
