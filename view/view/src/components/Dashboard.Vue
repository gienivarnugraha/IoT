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

            <div v-if="sensor1.length!=0 || sensor2.length!=0 || sensor3.length!=0 || sensor4.length!=0" class="row">
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
            
            <div v-else class="row">
                {{errors}}
            </div>

        </section>
    </div>
</template>

<script>

import InputView from './widgets/inputView'
import Chart from './widgets/Chart'
import {dateToMin, dateToHour, dateToDay, dateBeautify, groupData, removeDuplicate} from '../lib/Date'
import {mapActions, mapGetters} from 'vuex'

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
            loading:false,
            errors:null
        }
    }, 
    beforeDestroy() {
        clearInterval(this.timeOut)
    },
    beforeMount() {
        this.loading=true
    },
    mounted() {
        this.errors= this.$store.getters.errors
        this.fetchProjects().then(response=>{
                this.sensorName = response.data.items[0]
            })
    },
    methods: {
        ...mapActions([
            'fetchProjects'
        ]),
        changeFormat(param){
            this.loading=true
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
        fillData () {
            return new Promise((resolve,reject)=>{
                axios.get('/dashboard/id/'+this.$store.getters.sensorId)
                    .then(response => {
                        this.loading=false
                        console.log(localStorage)
                        console.log(response)
                        let results = response.data.items
                        let status = response.data.status
                        this.items = response.data.items
                        if (status==true){
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
                                                        fill:false,
                                                        borderColor: '#ff6384'
                                                        }
                                                ]
                            }
                            this.collection2 = {
                                                labels: this.labels,
                                                datasets: [
                                                        {
                                                        label: this.sensorName.sensor2Name,
                                                        data: this.sensor2,
                                                        fill:false,
                                                        borderColor: '#36a2eb'
                                                        }
                                                ]
                            }
                            this.collection3 = {
                                                labels: this.labels,
                                                datasets: [
                                                        {
                                                        label: this.sensorName.sensor3Name,
                                                        data: this.sensor3,
                                                        fill:false,
                                                        borderColor: '#cc65fe'
                                                        }
                                                ]
                            }
                            this.collection4 = {
                                                labels: this.labels,
                                                datasets: [
                                                        {
                                                        label: this.sensorName.sensor4Name,
                                                        data: this.sensor4,
                                                        fill:false,
                                                        borderColor: '#ffce56'
                                                        }
                                                ]
                            }
                        } else {
                            this.errors = response.data.message
                        }
                        this.loaded=true
                    })
                    .catch(error => {
                        this.loading=false
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


