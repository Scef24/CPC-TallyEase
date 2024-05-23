<template>
    <div class="students">
       <div>
            <table>
                <thead>
                    <tr>
                        <th><input type="checkbox"></th>
                        <th>Id</th>
                        <th>Last Name</th>
                        <th>First Name</th>
                        <th>Middle Name</th>
                        <th>Department</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="student in students" :key="student.id">
                        <td><input type="checkbox"></td>
                        <td>{{ student.id }}</td>
                        <td>{{ student.last_name }}</td>
                        <td>{{ student.first_name }}</td>
                        <td>{{ student.middle_name }}</td>
                        <td>{{ student.department }}</td>
                        <td><button class="btn-delete"
                            @click="deleteStudent(student.id)">Delete</button></td>
                    </tr>
                    
                </tbody>
            </table>
            <div style="margin-left: 10%;">
                <button class="btn-tbl-delete"> Delete Selected Students</button> | 
                <button class="btn-tbl-footer"  @click="gotoPrevPage"> Prev</button> | 
                <button class="btn-tbl-footer" @click="gotoNextPage">Next</button>
            </div>
       </div>
    </div>
</template>

<script setup>
import axios from '../../axios-config.js'
import {ref,onMounted} from 'vue'
import Swal from 'sweetalert2'

const students =ref([])
const defaultUrl = ref('/v1/students')
const prevUrl = ref('')
const nextUrl = ref('')
const currentUrl = ref('')

const getStudents =async(url)=>{
    try{
        const res = await axios.get(url,{headers:{
            'Authorization': `Bearer ${localStorage.getItem('token')}`
        }})
        students.value = res.data.data
        prevUrl.value = res.data.prev_page_url
        nextUrl.value = res.data.next_page_url
        currentUrl.value = `http://localhost/lumen-laravel/3d-enrollment/public/api/v1/students?page=${res.data.current_page}`
       console.log(res)
    }catch(error){
        console.log(error)
    }
}
const gotoPrevPage = ()=>{
    getStudents(prevUrl.value);
}

const gotoNextPage = ()=>{
    getStudents(nextUrl.value);
}
const deleteStudent = async(id)=>{
    try{
        Swal.fire({
        title: 'Error!',
        text: 'Do you want to continue',
        icon: 'error',
        confirmButtonText: 'Yes'
        }).then(async(result)=>{
            if(result.isConfirmed){
                const res = await axios.delete(`/v1/students/${id}`,{headers:{
            'Authorization': `Bearer ${localStorage.getItem('token')}`
        }})
        console.log(res)
        getStudents(currentUrl.value);
         await Swal.fire({
                    text: "Student has been deleted.",
                    position: "top-end",
                    // backdrop:false,
                    width:"20em",
                    showConfirmButton: false,
                    timer: 2000,
                    toast:true,
                    background: "#ff6666",
                    color:"#fff",
                    allowEscapeKey:true,
                    showCloseButton: true,
                    });
            }
        })
    }catch(error){
        console.log(error)
    }
}
onMounted(()=>{
    getStudents(defaultUrl.value);
})
</script>

<style lang="scss" scoped>
.students{
    padding:10px;
    margin-top:10vh;
}
table,tr,td,th{
    padding:5px;
    margin:5px;
    border:1px solid;
    text-align: center;
}
table{
    margin-left: 50%;
    transform: translate(-50%);
    width: 85vw;
    font-size: 20px;
}
th{
    height: 6vh;
    background-color: var(--secondary);
    color:#fff;
}
.btn-tbl-footer{
    background-color: #007bff;
      color: #fff;
    padding:10px 15px 10px 15px;
    width: 100px;
    font-size: 20px;
    border:1px solid var(--main);
    border-radius: 5px;
    cursor: pointer;
}
.btn-tbl-delete{
    background-color: #f44336;
    border:1px solid #f44336;
    color:#fff;
    padding:10px 15px 10px 15px;
    font-size: 20px;
    border-radius: 5px;
}
tr{
    height: 2.5rem;
}
tr:hover{
    background-color: #f2f2f2;
}
.btn-tbl-footer:hover{
    background-color: #0056b3;
}
.btn-view, .btn-edit, .btn-delete{
    padding:5px 10px 5px 10px;
    font-size: 16px;
    border-radius: 5px;
    cursor: pointer;
}
.btn-view{
    background-color: #4dff4d;
    border:1px solid #4dff4d;
    text-decoration: none;
    color:#000;
}
.btn-view:hover{
    background-color: #00cc00;
}
.btn-edit{
    background-color: #007bff;
    border:1px solid #007bff;
    color:#fff;
    text-decoration: none;
}
.btn-edit:hover{
    background-color: #0056b3;
}
.btn-delete{
    background-color: #f44336;
    border:1px solid #f44336;
    color:#fff;
}
.btn-delete:hover{
    background-color: #d32f2f;
}
.btn-tbl-footer:disabled{
  opacity: 0.6;
  cursor: not-allowed;
}

</style>