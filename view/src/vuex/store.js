import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'

Vue.use(Vuex)

export default new Vuex.Store({
  /* STATES */
  state: {
    isLoggedIn: !!localStorage.accessToken,
    user: {
      accessToken: localStorage.accessToken,
      email: localStorage.email,
      userId: localStorage.userId,
      name: localStorage.name,
    },
    sensorId: localStorage.sensorId,
    loading: false,
    errors:null,
    loginError: null,
  },

  /* MUTATIONS */

  mutations: {
    loginSuccess: (state, data) => {
      state.isLoggedIn = true,
      state.user.accessToken = localStorage.setItem('accessToken', data.key),
      state.user.email = localStorage.setItem('email', data.email),
      state.user.userId = localStorage.setItem('userId', data.userId),
      state.user.name = localStorage.setItem('name', data.name)
    },
    logout: state => state.isLoggedIn = false,
    loading: (state, condition) => {
      state.loading = condition
    },
    loginStop: (state, errorMessage) => {
      state.loading = false;
      state.loginError = errorMessage;
    },
    updateAccessToken: (state, accessToken) => {
      state.user.accessToken= accessToken
    },
    getSensorId: (state, id )=> {
      state.sensorId = localStorage.setItem('sensorId', id)
    },
    error: (state, errorMessage )=> {
      state.errors = errorMessage
    }
  },

  /* ACTIONS */

  actions: {
    doLogin({ commit }, loginData) {
      return new Promise((resolve, reject)=>{
          commit('loading', true);
          axios.post('/login', loginData)
          .then(response => {
            commit('loading', false)
            commit('loginSuccess', response.data)
            commit('updateAccessToken', response.data.key)
            resolve(response)
          })
          .catch(error => {
            commit('updateAccessToken', null)
            commit('loginStop', error)
            reject(error)
          })
        })
    },
    fetchProjects({commit }) {
      return new Promise((resolve, reject)=>{
        axios.get('/project')
        .then(response => {
          console.log(response)
            if(response.data.items==0){
              commit('error', response.data.message)
            } else {
              if (localStorage.sensorId==null){
                commit('getSensorId', response.data.items[0].sensorId)
              } else {
                commit('getSensorId', localStorage.getItem('sensorId'))
              }
            }
            resolve(response)
          })
          .catch(error => {
            if (error.response) {
                commit('error', error.response.data)
              } else if (error.request) {
                commit('error', error.request)
              } else {
                commit('error', error.message)
            }
            console.log(error)
            reject(error)
          })
        })
    },
    logout({ commit }){
      commit('loading')
      commit('logout')
      localStorage.clear()
      commit('loginStop', null)
    },
    loading({commit}, condition){
      commit('loading', condition)
    },
    fetchAccessToken({ commit }) {
      commit('updateAccessToken', localStorage.getItem('accessToken'))
    },
  },

  /* GETTERS */

  getters:{
    isLoggedIn: state => state.isLoggedIn,
    errors: state => state.errors,
    sensorId: state => state.sensorId,
    user: state => state.user,
    accessToken: state => state.user.accessToken,
    email: state => state.user.email,
    userId: state => state.user.userId,
    name: state => state.user.name,
  }
})