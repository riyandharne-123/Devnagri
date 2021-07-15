import Vue from 'vue'
import VueRouter from 'vue-router'
import axios from 'axios'

import Login from './components/Login'
import Dashboard from'./components/Dashboard/Dashboard'
import Welcome from './components/Dashboard/Welcome'
import Users from './components/Dashboard/Users'
import User from './components/Dashboard/User'
import Roles from './components/Dashboard/Roles'
import Juniors from './components/Dashboard/Juniors'

Vue.use(VueRouter)

const routes = [
  {
   path:'/',
   redirect:'/login',
  },
  {
    path: '/login',
    component: Login,
    name: 'Login',
  },
  {
    path: '/dashboard',
    component: Dashboard,
    name: 'Dashboard',
    children: [
      {
        path: 'welcome',
        component: Welcome,
      },
      {
        path: 'users',
        component: Users,
        beforeEnter: (to,from,next) => {
          axios.post('/api/verify/permission',{
            permission_name: 'users'
          })
          .then(res => {
            if(res.data.status == true)
            {
              next()
            }
            
            else {
              next('/dashboard/welcome')
              alert('Unauthorized!')
            }
          })
        },
      },
      {
        path: 'user/:id',
        component: User,
        beforeEnter: (to,from,next) => {
          axios.post('/api/verify/permission',{
            permission_name: 'users'
          })
          .then(res => {
            if(res.data.status == true)
            {
              next()
            }
            
            else {
              next('/dashboard/welcome')
              alert('Unauthorized!')
            }
          })
        },
      },
      {
        path: 'roles',
        component: Roles,
        beforeEnter: (to,from,next) => {
          axios.post('/api/verify/permission',{
            permission_name: 'roles'
          })
          .then(res => {
            if(res.data.status == true)
            {
              next()
            }
            
            else {
              next('/dashboard/welcome')
              alert('Unauthorized!')
            }
          })
        },
      },
      {
        path: 'juniors',
        component: Juniors,
        beforeEnter: (to,from,next) => {
          axios.post('/api/verify/permission',{
            permission_name: 'juniors'
          })
          .then(res => {
            if(res.data.status == true)
            {
              next()
            }
            
            else {
              next('/dashboard/welcome')
              alert('Unauthorized!')
            }
          })
        },
      },
    ],
    beforeEnter: (to,from,next) => {
      axios.get('/api/verify/user')
      .then(res => {
        if(res.data.api_token == localStorage.getItem('token'))
        {
          next()
        }
      })
      .catch(err => 
        next('/login'))
    },
  },
]

const router = new VueRouter({routes})

//auth guard
router.beforeEach((to,from,next) => {
  const jwtToken = `Bearer ${localStorage.getItem('token')}`;
  window.axios.defaults.headers.common['authorization'] = jwtToken;
  next();
})

export default router
