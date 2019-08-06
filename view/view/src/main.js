import 'bootstrap'
import './assets/loader.css'
import 'bootstrap/dist/css/bootstrap.min.css'
import 'bootstrap/dist/js/bootstrap.min.js'

import Vue from 'vue'
import App from './App.vue'
import axios from 'axios'
import store from './vuex/store'
import router from './router'

Vue.config.productionTip = false

window.axios = axios

axios.defaults.baseURL = 'http://localhost:8080/iot/'
axios.defaults.withCredentials = true
const accessToken = localStorage.getItem('accessToken')
console.log(accessToken)
if (accessToken!=null) {
  axios.defaults.headers.common['Authorization'] = accessToken
}
//axios.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded'
//axios.defaults.headers.put['Content-Type'] = 'application/x-www-form-urlencoded'

new Vue({
  el: '#app',
  router,
  store,
  render: h => h(App)
})
