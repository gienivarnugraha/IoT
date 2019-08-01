import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    isLoggedIn: !!localStorage.accessToken,
    user: {
      accessToken: localStorage.accessToken,
      email: localStorage.email,
      userId: localStorage.userId,
      name: localStorage.name
    },
    loading: false,
    loginError: null,
  },
  mutations: {
    loginSuccess: (state, data) => {
      state.isLoggedIn = true,
      state.user.accessToken = localStorage.setItem('accessToken', data.key),
      state.user.email = localStorage.setItem('email', data.email),
      state.user.userId = localStorage.setItem('userId', data.userId),
      state.user.name = localStorage.setItem('name', data.name)
    },
    logout: state => state.isLoggedIn = false,
    loading: state => state.loading = true,
    loginStop: (state, errorMessage) => {
      state.loading = false;
      state.loginError = errorMessage;
    },
    updateAccessToken: (state, accessToken) => {
      state.user.accessToken= accessToken
    }
  },
  actions: {
    doLogin({ commit }, loginData) {
      return new Promise((resolve, reject)=>{
          commit('loading');
          axios.post('/login', loginData)
          .then(response => {
            console.log(response)
            commit('loginStop', null)
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
    logout({ commit }){
      commit('logout')
      localStorage.clear()
    },

    /*  PROJECTS ACTIONS */
    loading({commit}){
      commit('loading')
    },
    fetchAccessToken({ commit }) {
      commit('updateAccessToken', localStorage.getItem('accessToken'))
    },
  },
  getters:{
    isLoggedIn: state => state.isLoggedIn,
    user: state => state.user,
    accessToken: state => state.user.accessToken,
    email: state => state.user.email,
    userId: state => state.user.userId,
    name: state => state.user.name,
  }
})