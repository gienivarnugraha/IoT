<template lang="html">
    <div class="col col-lg-9 ">
        <div class="container-loading" v-if="loading">
            <div class="lds-hourglass"></div>
        </div>
        <div class="card" v-else>
            <img class="card-img-top img" src="../assets/logo.png" style="" alt="Card image cap">
            <div class="card-header">
                Login {{form.email}} {{form.password}}
            </div>
            <form id="form" @submit.prevent="loginSubmit">
                <span class="is-invalid"> {{errors}} </span>
                <div class="card-body">
                    
                    <input-view
                        id="name"
                        name="name"
                        label="name" 
                        type="text"
                        v-model="form.name"
                    ></input-view>

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
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import inputView from './widgets/inputView'
import Form from '../lib/Form'
import { mapState } from 'vuex'
import { mapActions } from 'vuex'

export default {
    name: 'login',
    components: {
        'input-view' : inputView
    },
    data(){
        return{
            valid: null,
            errors:'',
            form: {
                name:'',
                email:'',
                password:'',
                matchPassword: ''
            },
        }
    },
    computed: {
        ...mapState([
            'loading',
            'loginError',
        ]),
/*         match: function() {
            if(this.password.value === this.matchPassword.value){
                return true
            } else {
                this.errors= 'passwor do not match!'
            }
        } */
    },
    methods: {
        ...mapActions([
            'register',
        ]),
        loginSubmit() {
            var formdata = new Form(this.form)
            this.register(formdata.data())
                .then(()=>{
                    this.$router.push('/')
                })
        },
        isValid(){
            console.log(this.form.errors.has())
            console.log(this.form.errors.get())
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

