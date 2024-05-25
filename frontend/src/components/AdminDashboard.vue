<template>
    <h1>Admin Dashboard</h1>
    <h1>Welcome {{ userName }}</h1>
    {{console.log(userName)}}
    <button @click="logout">Logout</button>

    <form @submit.prevent="addCommittee">
        <label for="name">Committee Name</label>
        <input type="text" v-model="committeeName" id="" required>
        
        <label for="email">Email</label>
        <input type="email" v-model="committeeEmail" required>

        <label for="password">Committee Password</label>
        <input type="password" v-model="committeePassword" required>

        <button type="submit">Add Committee</button>
        </form>
</template>

<script>

import axios from 'axios'
    export default{
     
        data() {
            return {
                userName:localStorage.getItem('userName'),
                committeeName:'',
                committeeEmail:'',
                committeePassword:'',
            }
        },
        methods: { 
            logout(){
                localStorage.removeItem('authToken')
                this.$router.push({name:'Login'})
            },
            async addCommittee() {
                // const token = response.data.token
            try {
                const response = await axios.post('/add-committee',{
                    name: this.committeeName,
                    email: this.committeeEmail,
                    password: this.committeePassword
                },{
                    headers:{
                        'Authorization': `Bearer ${localStorage.getItem('authToken')}`
                        // console.log(localStorage.getItem('authToken'))
                    }
                })
                console.log('Committee Added Succesfully', response.data)
            }
            catch(error) {
                console.error('Error adding Committee',error)
            }
        }
        }
    }
</script>