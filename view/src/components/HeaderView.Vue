<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <div class="pull-left">
                    <li class="nav-item">
                        <router-link class="nav-link" to="/dashboard">Dashboard</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" to="/project">Project</router-link>
                    </li>
                </div>
                <div class="pull-right">
                    <li class="nav-item">
                        <a href="#" class="btn btn-default btn-flat" @click="logout" >Sign out</a>
                    </li>
                </div>

            </ul>
        </div>
    </nav>
</template>

<script>
export default {
    name : 'HeaderView',
    methods: {
        logout () {
            this.$store.dispatch('logout')
                .then(() => {
                    this.$router.push('/login')
                }).catch((err) => {
                    console.log(err)
                })
        }
    },
}
</script>

