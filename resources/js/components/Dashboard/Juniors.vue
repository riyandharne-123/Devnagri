<template>
    <div class="container">
        <div class="row" style="padding-top:2%;">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5>My Juniors</h5>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="item in my_juniors" :key="item.id">
                                        <td>{{ item.user.name }}</td>
                                        <td>{{ item.user.email }}</td>
                                        <td>
                                            <button class="btn btn-danger" @click="deleteJunior(item.id)">Delete</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <br>
                <div class="card">
                    <div class="card-body">
                        <h5>Users</h5>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="item in juniors" :key="item.id">
                                        <td>{{ item.name }}</td>
                                        <td>{{ item.email }}</td>
                                        <td>
                                            <button class="btn btn-success" @click="createJunior(item.id)">Add</button>
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
            my_juniors: [],
            juniors: []
        }
    },
    mounted:function() {
        axios.get('/api/juniors')
            .then(res =>{
                this.my_juniors = res.data.my_juniors
                this.juniors = res.data.juniors
            })
    },
    methods: {
        createJunior(id) {
        axios.post('/api/juniors',{
            junior_id: id
        })
            .then(res =>{
                this.my_juniors = res.data.my_juniors
            })
        },
        deleteJunior(id) {
            axios.delete(`/api/juniors/${id}`)
                .then(res =>{
                    this.my_juniors = res.data.my_juniors
                })
        },
    },
}
</script>
