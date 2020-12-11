<template>
    <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle waves-effect waves-light" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
               {{ user.name }}
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-default" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="#" @click.prevent="logout">Logout</a>
            </div>
          </li>
    </ul>
  </nav>
  <!-- /.navbar -->

</template>

<script>
    export default {
        name: 'Navbar',
        props : ['user'],
        mounted() {
            
        },
        data() {
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        },
        
        methods:{
            logout:function(){
               axios.post('/logout').then(response => {
                  if (response.status === 302 || 401) {
                    // console.log(process.env.MIX_APP_URL);
                    window.location.href = "/login";
                  }
                  else {
                      console.log('error logout');
                    // throw error and go to catch block
                  }
                }).catch(error => {
                    console.log('error logout');
                    window.location.href = "/";
              });
            },
        },
    }
</script>