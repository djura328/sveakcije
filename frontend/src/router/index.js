import Vue from 'vue'
import Router from 'vue-router'
import Index from '@/pages/index'
import Article from '@/pages/article'
import Dashboard from '@/pages/dashboard/insert'
import Show from '@/pages/dashboard/show'
import Login from '@/pages/login'

Vue.use(Router)

export default new Router({
  mode: 'history',
  routes: [
    {
      path: '/',
      name: 'index',
      component: Index,
      beforeEnter: (to, from, next) => {
        next()
      }
    },
    {
        path: '/article/:id',
        name: 'article-id',
        component: Article
    },
    {
      path: '/dashboard/insert',
      name: 'dashboard-insert',
      component: Dashboard
    },
    {
      path: '/dashboard',
      name: 'dashboard',
      component: Show
    },
    {
        path: '/login',
        name: 'login',
        component: Login
    }
  ]
})
