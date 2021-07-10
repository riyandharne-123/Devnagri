<template>
<nav class="navbar navbar-expand-md bg-dark navbar-dark">
  <!-- Brand -->
  <a class="navbar-brand" href="#">Laravel App</a>

  <!-- Toggler/collapsibe Button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Navbar links -->
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <router-link to="/dashboard/welcome">
            <a class="nav-link text-light">Welcome</a>
        </router-link>
      </li>
      <li class="nav-item">
        <router-link to="/dashboard/users">
            <a class="nav-link text-light">Users</a>
        </router-link>
      </li>
      <li class="nav-item">
        <router-link to="/dashboard/juniors">
            <a class="nav-link text-light">Juniors</a>
        </router-link>
      </li>
      <li class="nav-item">
        <router-link to="/dashboard/roles">
            <a class="nav-link text-light">Roles</a>
        </router-link>
      </li>
      <li class="nav-item" @click="logout()">
        <a class="nav-link text-light">Logout</a>
      </li>
    </ul>
  </div>
</nav>
</template>

<script>
export default {
methods: {
   logout:function()
       {
        localStorage.removeItem('token');
        //routing to login page
        this.$router.push('/login');    
       },
   },
}
</script>
