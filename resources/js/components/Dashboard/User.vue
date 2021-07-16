<template>
    <div class="container">
        <div class="row" style="padding-top:2%;">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5>Name: {{ user.name }}</h5>
                        <h5>Email: {{ user.email }}</h5>
                        <h5>Role: {{ user.role.name }}</h5>
                        <h5>Permissions</h5>
                        <ul v-for="item in user_permissions" :key="item.id">    
                            <li>{{ item.name }} <button class="btn btn-danger" @click="deletePermissions(item.name)">X</button></li>
                        </ul>
                        <hr>
                        <h5>Update Details</h5>
                        <form>
                            <div class="form-group">
                                <h5><label>Role:</label></h5>
                                <select class="form-control" v-model="role" required>
                                    <option v-for="role in roles" :selected="role.id == user.role.id" :key="role.id" v-bind:value="role.id">
                                        {{ role.name }} 
                                    </option>
                                </select>
                            </div>
                            <ul class="permissions" v-for="item in permissions" :key="item">
                                <li>{{ item }} <button class="btn btn-success" type="button" @click="addPermissions(item)">Add</button></li>
                            </ul>
                            <button type="button" class="btn btn-primary btn-block" @click="updateUser">Update</button>
                        </form>
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
            permissions: [
                'users','roles','juniors'
            ],
            user: [],
            user_permissions: [], 
            user_id: this.$route.params.id,
            role: ''
        }
    },
    mounted:function(){
        axios.get(`/api/users/`+this.$route.params.id)
            .then(res => {
                this.user = res.data.user
                this.user_permissions = res.data.permissions
                this.roles = res.data.roles
            }) 
    },
    methods: {
        addPermissions(permission_name) {
            axios.post('/api/permissions',{
                name: permission_name,
                user_id: this.user_id
            })
                .then(res =>{
                    this.user_permissions = res.data.permissions
                })
        },

        deletePermissions(permission_name) {
            axios.post('/api/permissions/delete',{
                name: permission_name,
                user_id: this.user_id
            })
                .then(res =>{
                    this.user_permissions = res.data.permissions
                })
        },

        updateUser() {
            axios.put(`/api/users/`+this.$route.params.id,{
                role_id: this.role
            })
                .then(res => {
                    this.user = res.data.user
                })
        }
    },
}
</script>

<style>

</style>