import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'
import router from '../router/'

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
    topic: localStorage.topic,
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
    getTopic: (state, id )=> {
      state.topic = id
    },
    setTopic: (state, id )=> {
      state.topic = localStorage.setItem('topic',id)
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
            location.reload()
            router.push({path:'/project'})
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
              commit('loading', false)
            if(response.data.items==0){
              commit('error', response.data.message)
            } else {
              if (localStorage.topic==null){
                commit('setTopic', response.data.items[0].topic)
              } else {
                commit('getTopic', localStorage.topic)
              }
            }
            resolve(response)
          })
          .catch(error => {
            commit('loading', false)
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
      location.reload()
      router.push({path:'/login'})
    },
    loading({commit}, condition){
      commit('loading', condition)
    },
    fetchAccessToken({ commit }) {
      commit('updateAccessToken', localStorage.getItem('accessToken'))
    },
    fetchtopic({ commit }) {
      commit('getTopic', localStorage.getItem('topic'))
    },
  },

  /* GETTERS */

  getters:{
    isLoggedIn: state => state.isLoggedIn,
    errors: state => state.errors,
    topic: state => state.topic,
    user: state => state.user,
  }
})