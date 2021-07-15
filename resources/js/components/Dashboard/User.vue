<template>
    <div class="container">
        <div class="row" style="padding-top:2%;">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5>Name: {{ user.name }}</h5>
                        <h5>Email: {{ user.email }}</h5>
                        <h5>Role: {{ user.role.name }}</h5>
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
                            <div class="permissions" v-for="item in permissions" :key="item">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox"
                                         class="form-check-input"
                                         :checked="user_permissions.indexOf(item) != -1"
                                         @change="updatePermissions(item)"
                                         :value="item">{{ item }} 
                                    </label>
                                </div>
                            </div>
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
            role: ''
        }
    },
    mounted:function(){
        axios.get(`/api/users/`+this.$route.params.id)
            .then(res => {
                this.user = res.data.user
            })
        axios.get('/api/users')
            .then(res => {
                this.roles = res.data.roles
                this.user_permissions = res.data.permissions
            })   
    },
    methods: {
        updatePermissions(permission_name) {
            axios.post('/api/users/update_permissions',{
                name: permission_name
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