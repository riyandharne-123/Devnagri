<template>
    <div class="col-md-6" style="margin: 0 auto; padding-top:15%;">
        <div class="card">
            <div class="card-body">
                <form @submit.prevent="login()">
                <div class="form-group">
                    <label for="email">Email address:</label>
                    <input type="email" v-model="email" class="form-control" placeholder="Enter email" id="email" required />
                </div>
                <div class="form-group">
                    <label for="pwd">Password:</label>
                    <input type="password" v-model="password" class="form-control" placeholder="Enter password" id="pwd" required />
                </div>
                <div v-if="errors != null">
                    <label class="text-danger">{{ errors }}</label>
                    <br>
                </div>
                <button type="submit" class="btn btn-primary">Login <div v-if="loading" class="spinner-border text-light spinner-border-sm"></div></button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                loading: false,
                email: '',
                password: '',
                errors: null,
            }
        },
        
        methods: {
            login() {
                this.loading = true

                axios.post('/api/login', {
                    'email':this.email,
                    'password':this.password,
                }).then(res => {
                    console.dir(res)
                    localStorage.setItem('token',res.data.token);

                    this.loading = false

                    if (res.data.status != null) {
                        this.errors = res.data.status;
                    }

                    else {
                        this.$router.push('/dashboard');
                    }

                })
                .catch(err =>{
                    this.loading = false
                    console.warn(err)
                })
            },
        },
    }
</script>
