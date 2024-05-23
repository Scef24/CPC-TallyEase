import { createRouter, createWebHistory } from 'vue-router'


const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: () => import('../views/DashboardView.vue'),
      meta:{
        requiresAuth:true
      }
    },
    {
      path: '/enroll',
      name: 'enroll',
      component: () => import('../views/EnrollView.vue'),
      meta:{
        requiresAuth:true
      }
    },
    {
      path: '/bulk',
      name: 'bulk',
      component: () => import('../views/BulkEnrollView.vue'),
      meta:{
        requiresAuth:true
      }
    },
    {
      path: '/students',
      name: 'students',
      component: () => import('../views/StudentsView.vue'),
      meta:{
        requiresAuth:true
      }
    },
    {
      path: '/login',
      name: 'login',
      component: () => import('../views/LoginView.vue'),
    },

  ]
})

router.beforeEach((to,from,next)=>{
  const isAuthenticated = localStorage.getItem('token')
  if (to.matched.some(record => record.meta.requiresAuth)) {
    if (!isAuthenticated) {
      next('/login');
    } else {
      next();
    }
  } else {
    next();
  }

})

export default router
