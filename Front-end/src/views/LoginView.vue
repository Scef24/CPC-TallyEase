<template>
        <div class="main-container">
            <div class="login-container">
                 <h2>Login</h2>
                <form class="login-form" @submit="login">
                    <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" v-model="email"  required>
                    </div>
                    <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" v-model="password"  required>
                    </div>
                    <div class="form-group">
                    <button type="submit">{{ buttonName }}</button>
                    </div>
                </form>
            </div>
            </div>
</template>

<script setup>
import axios from '../../axios-config.js'
import {ref,onMounted} from 'vue'
import { useRouter } from 'vue-router'
import {useUserStore} from '@/stores/user'


const myStore = useUserStore()

const email = ref('')
const password = ref('')
const buttonName= ref('Login')
const router = useRouter()



const login = (e)=>{
    e.preventDefault();
    buttonName.value="Logging In..."
    axios.post('/login',{
        email:email.value,
        password:password.value
    }).then((res)=>{
        if(res.status===200){
            buttonName.value="Login";
            localStorage.setItem("token",res.data.token)
            localStorage.setItem("isLoggedIn",true)
            myStore.isLoggedIn = true;
            router.push('/')
        }
    }).catch((error)=>{
        console.log(error)
        buttonName.value="Login"
    })
}
onMounted(()=>{
    localStorage.removeItem('token')
    localStorage.removeItem('isLoggedIn')
    myStore.isLoggedIn = false
    router.push('/login')
})

</script>

<style lang="scss" scoped>
.login-container {
      background-color: #fff;
      border-radius: 5px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      padding: 20px;
      width: 400px;
      margin-left: 50%;
      margin-top:2rem;
      transform: translate(-50%);
    }

    .login-container h2 {
      margin-top: 0;
      font-size: 24px;
      text-align: center;
    }

    .login-form {
      display: flex;
      flex-direction: column;
    }

    .form-group {
      margin-bottom: 15px;
    }

    .form-group label {
      font-weight: bold;
    }

    .form-group input[type="email"],
    .form-group input[type="password"] {
      width: 95%;
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 3px;
    }

    .form-group button[type="submit"] {
      background-color: #007bff;
      color: #fff;
      border: none;
      border-radius: 3px;
      padding: 10px 15px;
      cursor: pointer;
    }

    .form-group button[type="submit"]:hover {
      background-color: #0056b3;
    }
</style>