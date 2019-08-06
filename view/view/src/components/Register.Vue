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
            <form id="form" @submit.prevent="register">
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

export default {
    name: 'register',
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
            loading:false,
        }
    },
    computed: {
/*         match: function() {
            if(this.password.value === this.matchPassword.value){
                return true
            } else {
                this.errors= 'passwor do not match!'
            }
        } */
    },
    methods: {
        register() {
            //this.loading=true
            var formData = new Form(this.form)
            return new Promise((resolve, reject)=>{
                axios.post('/register', formData.data() )
                .then(response => {
                    this.loading=false
                    console.log(response)
                    this.$router.go('/login')
                    resolve(response)
                })
                .catch(error => {
                    if (error.response) {
                        /*
                        * The request was made and the server responded with a
                        * status code that falls out of the range of 2xx
                        */
                        console.log(error.response.data);
                        console.log(error.response.status);
                        console.log(error.response.headers);
                    } else if (error.request) {
                        /*
                        * The request was made but no response was received, `error.request`
                        * is an instance of XMLHttpRequest in the browser and an instance
                        * of http.ClientRequest in Node.js
                        */
                        console.log(error.request);
                    } else {
                        // Something happened in setting up the request and triggered an Error
                        console.log('Error', error.message);
                    }
                    console.log(error)
                    reject(error)
                })
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

