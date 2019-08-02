<template lang="html">
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col col-lg-9" v-if="!register">
                <div class="container-loading" v-if="loading">
                    <div class="lds-hourglass"></div>
                </div>
                <div class="card">
                    <img class="card-img-top img" src="../assets/logo.png" style="" alt="Card image cap">
                    <div class="card-header">
                        Login {{form.email}} {{form.password}}
                    </div>
                    <form id="form" @submit.prevent="loginSubmit">
                        <span class="is-invalid"> {{errors}} </span>
                        <div class="card-body">
                            <input-view
                                id="email"
                                label="Email" 
                                type="email"
                                name="email"
                                v-model="form.email"
                            ></input-view>

                            <input-view
                                id="password"
                                name="password"
                                label="Password" 
                                type="password"
                                v-model="form.password"
                            ></input-view>

                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="submit" class="btn btn-info" @click="register= true">Register</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col col-lg-9" v-else>
                <register></register>
            </div>
        </div>
    </div>
</template>

<script>
import inputView from './widgets/inputView'
import Register from './Register'
import Form from '../lib/Form'
import { mapState } from 'vuex'
import { mapActions } from 'vuex'

export default {
    name: 'login',
    components: {
        'input-view' : inputView,
        'register' : Register,
    },
    data(){
        return{
            valid: null,
            errors:'',
            register:false,
            form: {
                email:'',
                password:''
            },
        }
    },
    computed: {
        ...mapState([
            'loginError',
        ])
    },
    methods: {
        ...mapActions([
            'loading',
            'doLogin',
            'fetchProjects',
        ]),
        loginSubmit() {
            this.loading(true)
            var formdata = new Form(this.form)
            this.doLogin(formdata.data())
                .then(()=>{
                    this.loading(false)
                    this.$router.push('/')
                    this.fetchProjects()
                })
                .catch((error)=>{
                    console.log(error)
                })
        }
    },
}
</script>

<style lang="scss">
.img {
    width:25%; 
    margin:auto
}
</style>

