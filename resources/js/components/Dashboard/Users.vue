<template>
    <div class="container">
        <div class="row" style="padding-top:2%;">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#AddUserModal">Add User</button>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="user in users" :key="user.id">
                                        <td>{{ user.name }}</td>
                                        <td>{{ user.email }}</td>
                                        <td>{{ user.role.name }}</td>
                                        <td>
                                            <router-link :to='"/dashboard/user/"+user.id'>
                                                <a class="btn btn-info text-light">View</a>
                                            </router-link>
                                            <button class="btn btn-danger" @click="deleteUser(user.id)">Delete</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- The Modal -->
        <div class="modal" id="AddUserModal">
        <div class="modal-dialog">
            <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Add User</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
                <div class="modal-body">           
                    <div v-if="error != ''">
                        <div class="alert alert-success">
                            <strong>{{ error }}</strong>
                        </div>
                        <br>
                    </div>
                    <form @submit.prevent="addUser()">
                    <div class="form-group">
                        <label>Name:</label>
                        <input type="text" class="form-control" v-model="name" required />
                    </div>
                    <div class="form-group">
                        <label>Email:</label>
                        <input type="email" class="form-control" v-model="email" required />
                    </div>
                    <div class="form-group">
                        <label>Password:</label>
                        <input type="password" class="form-control" v-model="password" required />
                    </div>
                    <div class="form-group">
                        <h5><label>Role:</label></h5>
                        <select class="form-control" v-model="role_id" required >
                            <option v-for="role in roles" :key="role.id" v-bind:value="role.id">
                                {{ role.name }} 
                            </option>
                        </select>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" @change="addPermissions('users')" class="form-check-input" value="users">users
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" @change="addPermissions('roles')" class="form-check-input" value="users">roles
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" @change="addPermissions('juniors')" class="form-check-input" value="users">juniors
                        </label>
                    </div>
                    <button class="btn btn-primary" type="submit">Add User</button>
                </form>
                </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
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
            users: [],
            roles: [],
            permissions: [],
            name: '',
            email: '',
            password: '',
            role_id: '',
            error: ''
        }
    },
    mounted:function(){
      axios.get('/api/users')
       .then(res => {
            this.users = res.data.users
            this.roles = res.data.roles
       })
    },
    methods: {
        deleteUser(user_id) {
            axios.delete(`/api/users/${user_id}`)
            .then(res => {
                this.users = res.data.users
            })
        },
        addPermissions(name) {
            if (this.permissions.indexOf(name) === -1) {
                this.permissions.push(name)
            }

            else {
                let index = this.permissions.indexOf(name);
                this.permissions.splice(index, 1)
            }
        }, 
        addUser() {
            axios.post(`/api/users`,{
                name: this.name,
                email: this.email,
                password: this.password,
                role_id: this.role_id,
                permissions: this.permissions
            })
                .then(res => {
                    this.users = res.data.users
                    $('#AddUserModal').modal('hide');
                    this.name = ""
                    this.email = ""
                    this.password = ""
                    this.role_id = ""
                    this.permissions = []
                })
                .catch(err =>{
                    alert('ERROR');
                })

        }
    },
}
</script>
