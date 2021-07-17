<template>
    <div class="container">
        <div class="row" style="padding-top:2%;">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form @submit.prevent="createRole()">
                            <div class="form-group">
                                <label>Name:</label>
                                <input type="text" class="form-control" v-model="role_name" required />
                            </div>
                            <button class="btn btn-primary" type="submit">Add Role</button>
                        </form>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="item in roles" :key="item.id">
                                        <td>{{ item.name }}</td>
                                        <td>
                                            <button class="btn btn-danger" @click="deleteRole(item.id)">Delete</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios'

export default {
    data() {
        return {
            roles: [],
            role_name: ''
        }
    },
    mounted:function(){
      axios.get('/api/roles')
       .then(res => {
            this.roles = res.data.roles
       })
    },
    methods: {
        createRole() {
            axios.post('/api/roles',{
                name: this.role_name
            })
                .then(res =>{
                    this.role_name = ''
                    this.roles = res.data.roles
                })
        },
        deleteRole(role_id) {
            axios.delete(`/api/roles/${role_id}`)
                .then(res =>{
                    this.roles = res.data.roles
                })
        }
    },
}
</script>
