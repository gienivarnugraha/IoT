<template>
    <div class="container">
        <div class="row mb-3">
            <div class="col align-self-center">
                <button type="button" class="btn btn-outline-success" @click="showModal=true" >Add Project</button>
            </div>
        </div>
        <div class="row">
                <table class="table table-hover table-bordered">
                    <div class="container-loading" v-if="loading" >
                        <div class="lds-hourglass"></div>
                    </div>
                    <thead>
                        <tr>
                            <th>Project Name</th>
                            <th>Project Id</th>
                            <th>Sensor 1</th>
                            <th>Sensor 2</th>
                            <th>Sensor 3</th>
                            <th>Sensor 4</th>
                            <th>Latest Update</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item) in items" :key="item.projectId">
                            <td>{{item.projectName}}</td>
                            <td>{{item.projectId}}</td>
                            <td>{{item.sensor1Name}}</td>
                            <td>{{item.sensor2Name}}</td>
                            <td>{{item.sensor3Name}}</td>
                            <td>{{item.sensor4Name}}</td>
                            <td>
                                <button type="button" class="btn btn-outline-success">Update</button>
                                <button type="button" class="btn btn-outline-success" @click="deleteProjects(item.projectId)">Delete</button>
                            <td/>
                            <tr >
                                <td v-if="loaded" colspan=2>Values</td>
                                <td v-for="(value) in values" :key="value.sensorId">{{value}}</td>
                            </tr>
                        </tr>
                    </tbody>
                </table>
        </div>
        <div v-if="showModal" class="row mb-3">
            <div class="col align-self-center">
                <div class="card">
                    <div class="card-header">
                        Add New Project 
                    </div>
                    <form id="addForm" @submit.prevent="addProjects">
                        <span class="is-invalid"> {{errors}} </span>
                        <div class="card-body">
                            
                            <input-view
                                id="name"
                                name="name"
                                label="name" 
                                type="text"
                                v-model="form.projectName"
                            ></input-view>

                            <input-view
                                id="desc"
                                name="desc"
                                label="desc" 
                                type="text"
                                v-model="form.projectDesc"
                            ></input-view>

                            <input-view
                                id="sensor1"
                                name="sensor1"
                                label="sensor1" 
                                type="text"
                                v-model="form.sensor1Name"
                            ></input-view>
                            <input-view
                                id="sensor2"
                                name="sensor2"
                                label="sensor2" 
                                type="text"
                                v-model="form.sensor2Name"
                            ></input-view>
                            <input-view
                                id="sensor3"
                                name="sensor3"
                                label="sensor3" 
                                type="text"
                                v-model="form.sensor3Name"
                            ></input-view>
                            <input-view
                                id="sensor4"
                                name="sensor4"
                                label="sensor4" 
                                type="text"
                                v-model="form.sensor4Name"
                            ></input-view>

                        </div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-outline-success" @click="showModal=false" >Cancel</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import InputView from './widgets/inputView'
import Modal from './widgets/Modal'
import Form from '../lib/Form'
import {mapActions, mapGetters} from 'vuex'

export default {
    name: 'Project',
    components:{
        'input-view' : InputView,
        'modal' : Modal,
    },
    data() {
        return {
            items:[],
            values:[],
            sensorId:'',
            errors:'',
            showModal: false,
            loaded: false,
            form: {
                projectName:'',
                projectDesc:'',
                sensor1Name:'',
                sensor2Name:'',
                sensor3Name:'',
                sensor4Name:''
            },
            timeout: setInterval(this.fetchValues,5000)
        }
    },
    beforeRouteLeave (to, from, next) {
        clearInterval(this.timeout)
        clearInterval(this.timeout)
        clearInterval(this.timeout)
        next()
    },
    mounted() {
        this.fetchProjects()
    },
    methods: {
        ...mapActions([
            'loading'
        ]),
        resetValue(){
            this.form.projectName='',
            this.form.projectDesc='',
            this.form.sensor1Name='',
            this.form.sensor2Name='',
            this.form.sensor3Name='',
            this.form.sensor4Name=''
        },
        fetchProjects() {
            this.loading=true
            return new Promise((resolve, reject)=>{
                axios.get('/project')
                .then(response => {
                    this.loading=false
                    this.items = response.data.items
                    this.sensorId = response.data.items[0].sensorId
                    this.loaded=true
                    resolve(response)
                })
                .catch(error => {
                    console.log(error)
                    reject(error)
                })
            })
        },
        addProjects() {
            this.loading=true
            var formData = new Form(this.form)
            console.log(formData)
            return new Promise((resolve, reject)=>{
                axios.post('/project', formData.data() )
                .then(response => {
                    this.loading=false
                    this.fetchProjects()
                    this.resetValue()
                    this.showModal=false
                    console.log(response)
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
        },
        deleteProjects(id) {
            //this.loading=true
                console.log(id)
            return new Promise((resolve, reject)=>{
                axios.delete('/project/id/'+id)
                .then(response => {
                    this.loading=false
                    this.fetchProjects()
                    console.log(response)
                    resolve(response)
                })
                .catch(error => {
                    console.log(error)
                    reject(error)
                })
            })
        },
        fetchValues() {
            return new Promise((resolve, reject)=>{
                axios.get('/sensor/id/'+this.sensorId)
                .then(response => {
                    this.values = response.data.items
                    resolve(response)
                })
                .catch(error => {
                    
                    console.log(error.config);
                    reject(error)
                })
            })
        },
    }
}
</script>

