<template>
  <div id="app" >
    <div class="wrapper" v-if="isLoggedIn">
      <header-view></header-view>
      <content-wrap></content-wrap>
    </div>
    <div class="wrapper" v-else >
      <login></login>
    </div>
  </div>
</template>

<script>
/* import HeaderView from './components/HeaderView' */
import Login from './components/Login'
import HeaderView from './components/HeaderView'
import ContentWrap from './components/ContentWrap'
import {mapGetters} from 'vuex'

export default {
  name: 'app',
  components:{
    'header-view': HeaderView,
    'content-wrap': ContentWrap,
    'login': Login,
  },
  data () {
    return {
    }
  },
  computed: {
    ...mapGetters([
      'isLoggedIn',
      'user'
    ])
  }
}
</script>

<style lang="scss">
body {
  background-color: #66dfa8;
}

#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 20px;
}

h1, h2 {
  font-weight: normal;
}

ul {
  list-style-type: none;
  padding: 0;
}

li {
  display: inline-block;
  margin: 0 10px;
}

a {
  color: #66dfa8;
}



</style>
