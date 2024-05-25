import {createRouter, createWebHistory} from 'vue-router'
import Login from '../components/Login.vue'
import AdminDashboard from '../components/AdminDashboard.vue'
import Home from '../components/Home.vue'
import AddCommittee from '../components/AddCommittee.vue'



const routes = [
    {
        path:'/',
        component:Home,
        name:'Home'
    },
    {
        path:'/login',
        component:Login,
        name:'Login'
    },
    {
        path:'/admin',
        component:AdminDashboard,
        name:'AdminDashboard'
    },
    {
        path:'/addCommittee',
        component:AddCommittee,
        name:'AddCommittee'
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes,
})

router.beforeEach((to, from, next)=> {
    const requiresAuth = to.matched.some(record => record.meta.requiresAuth)
    const token = localStorage.getItem('authToken')

    if(requiresAuth && token) {
        next ({name:'Login'})
    }
    else {
        next();
    }
})


export default router;