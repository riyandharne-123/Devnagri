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
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="item in my_juniors" :key="item.id">
                                        <td>{{ item.name }}</td>
                                        <td>{{ item.email }}</td>
                                        <td>
                                            <button class="btn btn-danger" @click="deleteJunior(item.id)">Delete</button>
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
                console.log(this.my_juniors)
            })
    },
}
</script>
