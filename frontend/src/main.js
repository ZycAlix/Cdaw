import Vue from 'vue'
import App from './myvue.vue'
import router from './router/index.js'
import store from '@/store'

Vue.config.productionTip = false
console.log("hhhhhhhhhhhhhhhhhhhhh");


//setTimeout(() => {
  new Vue({
    //el:'#app'
    router,
    store,
    render: h => h(App)      
  }).$mount('#app')

//}, 5000);   //5秒钟之后再进行挂载


  //  const myvue= new Vue({
  //   render:h => h(App)
  // })
  // myvue.$mount('#app');
  

