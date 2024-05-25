<template>
    <div>
        <h1>Login</h1>

        <form @submit.prevent ="login">
            <div>
                <label for="email">Email</label>
                <input type="text" v-model="email" id="" required>
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" v-model="password" id="" required>
            </div>
            <button type="submit">Login</button>
        </form>

    </div>
</template>

<script>
import axios from '../axios'

export default {
    name:'Login',
    data() {
        return {
            email:'',
            password:''
        }
    },
    methods: {
        async login() {
            try {
            const response = await axios.post('/login',{
                email: this.email,
                password: this.password,
            })
            const token = response.data.token
            const user = response.data.user
            
            localStorage.setItem('authToken',token)
            localStorage.setItem('userName',user.name)
            // console.log(user.n)
            this.$router.push({name:'AdminDashboard'})
        }
        catch(error) {
            console.error('Login Failed:',error)
        }

    }
        
}
}
</script>