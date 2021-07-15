<template>
    <div class="container">
        <div class="row" style="padding-top:2%;">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
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
    </div>
</template>

<script>
import axios from 'axios'

export default {
    data() {
        return {
            users: [],
        }
    },
    mounted:function(){
      axios.get('/api/users')
       .then(res => {
            this.users = res.data.users
       })
    },
    methods: {
        deleteUser(user_id) {
            axios.delete(`/api/users/${user_id}`)
            .then(res => {
                this.users = res.data.users
            })
        }
    },
}
</script>
