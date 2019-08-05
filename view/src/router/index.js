/* Vue import needs */
import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

/* Components Import */
import Dashboard from '../components/Dashboard'
import Project from '../components/Project'
import Login from '../components/Login'

//async
function requireAuth(to, from, next) {
  const authenticated = !!localStorage.accessToken
  if (authenticated) {
    next()
  }
  else {
    console.log('route login else')
    router.push('/login')
  }
}
function reload(to, from, next) {
  location.reload()
}

export default new Router({
    mode: 'history',
    beforeEach: requireAuth,
    routes: [
      {
        path: '/login',
        name: 'login',
        component: Login
      },
      {
        path: '/dashboard',
        name: 'dashboard',
        component: Dashboard,
        //beforeEnter: requireAuth
      },
      {
        path: '/project',
        name: 'project',
        component: Project,
        //beforeEnter: requireAuth
      },
      {
        path: '/',
        name: 'project',
        component: Project,
        //beforeEnter: requireAuth
      },
      {
        path: '*',
        name: 'Login',
        component: Login
      }

    ],
    linkActiveClass: 'active'
})