<template>
    <div>
        <form @submit.prevent="addCommittee">
        <label for="name">Committee Name</label>
        <input type="text" v-model="committeeName" id="" required>
        
        <label for="email">Email</label>
        <input type="email" v-model="committeeEmail" required>

        <label for="password">Committee Password</label>
        <input type="password" v-model="committeePassword" required>

        <button type="submit">Add Committee</button>
        </form>
    </div>
</template>

<script>

import axios from 'axios'
export default {
    name:'AddCommittee',
    data() {
        return {
           committeeName:'',
           committeeEmail:'',
           committeePassword:'',
        }
    },
    methods:{
        async addCommittee() {
            try {
                const response = await axios.post('/add-committee',{
                    committeeName: this.committeeName,
                    committeeEmail: this.committeeEmail,
                    committeePassword: this.committeePassword
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