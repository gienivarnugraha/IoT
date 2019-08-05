<template>
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
            <li class="active">Projects</li>
        </ol>
        <div class="container-loading" v-if="loading" >
            <div class="lds-hourglass"></div>
        </div>
        <div class="row">
                <table  class="table table-hover table-borderless">
                    <thead class="thead-dark">
                        <tr>
                            <th>Project Name</th>
                            <th>API key</th>
                            <th>Sensor 1</th>
                            <th>Sensor 2</th>
                            <th>Sensor 3</th>
                            <th>Sensor 4</th>
                            <th>Action /<br> Latest Update</th>
                        </tr>
                    </thead>
                    <tbody v-if="items && items.length!=0">
                        <tr v-for="(item) in items" :key="item.projectId" >
                            <td>{{item.projectName}}</td>
                            <td>{{item.apiKey}}</td>
                            <td>{{item.sensor1Name}}</td>
                            <td>{{item.sensor2Name}}</td>
                            <td>{{item.sensor3Name}}</td>
                            <td>{{item.sensor4Name}}</td>
                            <td>
                                <button type="button" class="btn btn-outline-success" @click="modals('edit')">Edit</button>
                                <button type="button" class="btn btn-outline-danger" @click="deleteProjects(item.projectId)">Delete</button>
                            </td>
                            <tr v-if="values && values!=0">
                                <td colspan=2>Values</td>
                                <td v-for="(value) in values" :key="value.sensorId">{{value}}</td>
                            </tr> 
                            <tr class="table-danger" v-else>
                                <td colspan=7>Please connect the sensors to get the values</td>
                            </tr>
                        </tr>
                    </tbody>
                    <tbody v-else>
                        <tr class="table-danger">
                            <td colspan=6 >Please Add project by clicking button on the right! </td>
                            <td  >
                                <button type="button" class="btn btn-success" @click="modals('add')">Add Project</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
        </div>


        <div v-if="editModal" class="row mb-3">
            <div class="col align-self-center">
                <div class="card">
                    <div class="card-header">
                        Add New Project 
                    </div>
                    <form id="editForm" @submit.prevent="editProjects">
                        <span class="is-invalid"> {{errors}} </span>
                        <div class="card-body">
                            
                            <input-view
                                id="id"
                                name="id"
                                label="id" 
                                type="text"
                                v-model="form.projectId"
                                hidden
                            ></input-view>

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
                            <button type="button" class="btn btn-outline-success" @click="editModal=false" >Cancel</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        

        <div v-else-if="addModal" class="row mb-3">
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
                            <button type="button" class="btn btn-outline-success" @click="addModal=false" >Cancel</button>
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
            editModal: false,
            addModal: false,
            loaded: false,
            form: {
                projectId:'',
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
    beforeDestroy() {
        clearInterval(this.timeout)
    },
    mounted() {
        this.fetchProjects().then(response=>{
            console.log(response)
            this.loading=false
            if(response.data.items!=0 && response.data.count!=0 ){
                this.items = response.data.items
                this.sensorId = response.data.items[0].sensorId

                this.form.projectId=response.data.items[0].projectId,
                this.form.projectName=response.data.items[0].projectName,
                this.form.projectDesc=response.data.items[0].projectDesc,
                this.form.sensor1Name=response.data.items[0].sensor1Name,
                this.form.sensor2Name=response.data.items[0].sensor2Name,
                this.form.sensor3Name=response.data.items[0].sensor3Name,
                this.form.sensor4Name=response.data.items[0].sensor4Name
            }
            else {
                this.items=0
                this.form.projectName='',
                this.form.projectDesc='',
                this.form.sensor1Name='',
                this.form.sensor2Name='',
                this.form.sensor3Name='',
                this.form.sensor4Name=''
            }
            this.loaded=true
        }).catch(error=>{
            console.log(error)
        })
    },
    methods: {
        ...mapActions([
            'loading',
            'fetchProjects'
        ]),
        modals(select){
            if (select=="edit"){
                this.editModal=true
            } else {
                this.addModal=true
            }
        },
        editProjects() {
            this.loading=true
            return new Promise((resolve, reject)=>{
                axios.put('/project', this.form )
                .then(response => {
                    this.loading=false
                    this.editModal=false
                    this.fetchProjects()
                    console.log(response)
                    resolve(response)
                })
                .catch(error => {
                    if (error.response) {
                        console.log(error.response.data);
                        console.log(error.response.status);
                        console.log(error.response.headers);
                    } else if (error.request) {
                        console.log(error.request);
                    } else {
                        console.log('Error', error.message);
                    }
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
                    this.addModal=false
                    this.fetchProjects()
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
            this.loading=true
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
            if(this.items!=0 && this.sensorId!=null){
                return new Promise((resolve, reject)=>{
                    axios.get('/sensor/id/'+this.sensorId)
                    .then(response => {
                        console.log(response)
                        this.values = response.data.items
                        resolve(response)
                    })
                    .catch(error => {
                        
                        console.log(error.config);
                        reject(error)
                    })
                })
            }
        },
    }
}
</script>

