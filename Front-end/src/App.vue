<template>
   <header class="header" v-if="myStore.isLoggedIn">
      <nav class="nav">
        <router-link class="link" to="/">Dashboard</router-link>
        <router-link class="link" to="/enroll">Enroll</router-link>
        <router-link class="link" to="/bulk">Bulk-Enroll</router-link>
        <router-link class="link" to="/students">Students</router-link>
        <router-link class="logout" to="#" @click="logout">Logout</router-link>
      </nav>
   </header>
   <br> <br>
  <router-view/>
</template>

<script setup>
import {useUserStore} from '@/stores/user'
import { useRouter } from 'vue-router'
import axios from '../axios-config.js'

const router = useRouter()
const myStore = useUserStore()

const logout = ()=>{

    var data = new FormData();
		data.append("tokenValue",localStorage.getItem('token'));
    
    axios.post('/logout',data,{
      headers:{
      'Authorization': `Bearer ${localStorage.getItem('token')}`
      }
    }).then((res)=>{
      console.log(res)
      localStorage.removeItem('token')
      localStorage.removeItem('isLoggedIn')
      myStore.isLoggedIn = false
      router.push('/login')
    }).catch((error)=>{
      console.log(error)
    })
}

</script>

<style scoped>
.header{
  border:1px solid var(--main);
  position:fixed;
  top:0;
  left:0;
  padding:10px;
  width: 100vw;
  height: auto;
  background-color: var(--main);
  box-shadow: 0 0 3.5px 0 rgba(0, 0, 0, 0.3);
  z-index: 3;
}
.nav{
  display: flex;
  width: 95vw;
}
.nav .link{
  text-decoration: none;
  color:#000;
  font-size: 20px;
  margin:5px;
  padding:5px 10px 5px 10px;
  border-radius: 5px;
}
.nav .link:hover{
  background-color: var(--secondary);
  color:#fff;
}
.nav .link.router-link-exact-active {
  background-color: var(--secondary);
  color:#fff;
}
.nav .logout{
  text-decoration: none;
  color:#000;
  font-size: 20px;
  margin:5px 5px 5px auto;
  padding:5px 10px 5px 10px;
  border-radius: 5px;
  background-color: var(--secondary);
  color:#fff;
}
</style>