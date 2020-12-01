
<template>
<div id="about">
<h1>这里是关于</h1>
<button v-on:click="xx">nihao</button>
</div>

</template>
<script>

export default {
   name:'About',
   methods:{
      xx(){
         console.log(this.$router);
         console.log(this);
         console.log("ddddddddddddddd");
      }
   }
}
</script>
<style>
#about{
   width:300px;
   height: 200px;
   background: blue;
}
</style>