
<template>

<div id="home">
<h1>这里是首页</h1>
<div>
   <p v-if="seen">666</p>
<button @click="change" >{{display}}</button>
</div>

<!-- <div v-for="stu of stuList" :key="stu.id">{{stu.age}}</div> -->
<input v-model="message"/>
<button v-on:click="ajouter" >添加</button>
{{message}}


<HelloWorld v-for="stu of stuList" :todo="stu" :key=stu.id></HelloWorld>
<!-- v-for="stu of stuList" :todo="stu" :key="stu.id" -->
</div>

</template>

<script>

import HelloWorld from '../components/HelloWorld.vue'

export default {
   name:'Home',
   data(){
      return{
         message:null ,
         seen:false,
         display:"显示",
         stuList:[
         {id:"1",age:"123"},
         {id:"2",age:"234"},
         {id:"3",age:"456"}] 
      }
   },

   methods:{
      change(){
       
         console.log("channge");
         
           this.seen = !this.seen;
           if(this.seen){
              this.display ="隐藏";
           }else {
              this.display = "显示";
           }
      },

      ajouter(){
         this.stuList.push({age:555});
      }
   },
         created(){
         console.log("组件创建成功"+"!!!!!!!!!!!!!!!!!!!!!!!!!!!!")
      },
         mounted(){
            console.log("组件挂在成功")
         },

   components:{
      HelloWorld

   }
      }
</script>
<style>
#home{
   width:300px;
   height: 200px;
   background: yellow;
}
</style>