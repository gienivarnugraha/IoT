<template>
    <div class="container">
        <div class="container-loading" v-if="loading" >
            <div class="lds-hourglass"></div>
        </div>
        <section class="content">
            <div class="row">
                <div class="col align-self-center">
                    <div class="btn-group">
                        <button type="button" class="btn btn-secondary" @click=changeFormat(1)>1 Min</button>
                        <button type="button" class="btn btn-secondary" @click=changeFormat(2)>1 Hour</button>
                        <button type="button" class="btn btn-secondary" @click=changeFormat(3)>1 Day</button>
                    </div>
                </div>
            </div>

            <div class="row">
                <div v-if="loaded && sensor1.length!=0" :class="[sensor2.length!=0 ? 'col col-lg-6' : 'col col-lg-12']">
                    <chart id="sensor1" :chartData="collection1" :chartLabels="labels"></chart>
                </div>
                <div v-if="loaded && sensor2.length!=0" class="col col-lg-6">
                    <chart id="sensor2" :chartData="collection2" :chartLabels="labels"></chart>
                </div>
                <div v-if="loaded && sensor3.length!=0" :class="[sensor4.length!=0 ? 'col col-lg-6' : 'col col-lg-12']">
                    <chart id="sensor3" :chartData="collection3" :chartLabels="labels"></chart>
                </div>
                <div v-if="loaded && sensor4.length!=0" class="col col-lg-6">
                    <chart id="sensor4" :chartData="collection4" :chartLabels="labels"></chart>
                </div>
            </div>
        </section>
    </div>
</template>

<script>

import InputView from './widgets/inputView'
import Chart from './widgets/Chart'
import {dateToMin, dateToHour, dateToDay, dateBeautify, groupData, removeDuplicate} from '../lib/Date'
import {mapActions} from 'vuex'

export default {
    name: 'Dashboard',
    components:{
        'input-view' : InputView,
        'chart' : Chart
    },
    data() {
        return {
            items:[],
            labels:[],
            format: dateToDay,
            collection1:{},
            collection2:{},
            collection3:{},
            collection4:{},
            sensor1:[],
            sensor2:[],
            sensor3:[],
            sensor4:[],
            loaded:false,
            timeOut:setInterval(this.fillData,5000),
            sensorName:[],
            sensorId:''
        }
    }, 
    beforeRouteLeave (to, from, next) {
        clearInterval(this.timeOut)
        clearInterval(this.timeOut)
        clearInterval(this.timeOut)
        next()
    },
    beforeMount() {
        //this.loading=true
    },
    mounted() {
        this.fetchProjects()
    },
    methods: {
        ...mapActions([
            'loading'
        ]),
        changeFormat(param){
            if (param == 1){
                return this.format = dateToMin
            }
            if (param == 2){
                return this.format = dateToHour
            }
            if (param == 3){
                return this.format = dateToDay
            }
        },
        fetchProjects() {
            return new Promise((resolve, reject)=>{
                axios.get('/project')
                .then(response => {
                    console.log(response)
                    this.items = response.data.items
                    this.sensorId = response.data.items[0].sensorId
                    this.sensorName = response.data.items[0]
                    
                    resolve(response)
                })
                .catch(error => {
                    console.log(error)
                    reject(error)
                })
            })
        },
        fillData () {
            return new Promise((resolve,reject)=>{
                axios.get('/dashboard/id/'+this.sensorId)
                    .then(response => {
                        this.loading=false
                        console.log(response)
                        let results = response.data.items
                        this.items = response.data.items
                        this.labelFormat(this.format)
                        this.sensor1 = groupData(this.items, 1, this.format)
                        this.sensor2 = groupData(this.items, 2, this.format)
                        this.sensor3 = groupData(this.items, 3, this.format)
                        this.sensor4 = groupData(this.items, 4, this.format)

                        this.collection1 = {
                                            labels: this.labels,
                                            datasets: [
                                                    {
                                                    label: this.sensorName.sensor1Name,
                                                    data: this.sensor1,
                                                    backgroundColor: '#ff6384'
                                                    }
                                            ]
                        },
                        this.collection2 = {
                                            labels: this.labels,
                                            datasets: [
                                                    {
                                                    label: this.sensorName.sensor2Name,
                                                    data: this.sensor2,
                                                    backgroundColor: '#36a2eb'
                                                    }
                                            ]
                        },
                        this.collection3 = {
                                            labels: this.labels,
                                            datasets: [
                                                    {
                                                    label: this.sensorName.sensor3Name,
                                                    data: this.sensor3,
                                                    backgroundColor: '#cc65fe'
                                                    }
                                            ]
                        },
                        this.collection4 = {
                                            labels: this.labels,
                                            datasets: [
                                                    {
                                                    label: this.sensorName.sensor4Name,
                                                    data: this.sensor4,
                                                    backgroundColor: '#ffce56'
                                                    }
                                            ]
                        },
                        this.loaded=true
                    })
                    .catch(error => {
                        console.log(error)
                    })
            })
        },
        labelFormat(format) {
            this.labels = this.items
                .map(entry => format(entry.dateTime))
                .reduce(removeDuplicate, [])
        }
    }
}
</script>

<style lang="scss">
</style>


