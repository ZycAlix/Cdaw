<template>
    <div>
        <table id="optiontalbe">
            <tr><input class="inputAdminOp" type="text" v-model="ipbloquer"> <button class="buttonAdminOp" @click="bloquerIp">Bloquer l'adress IP</button><button class="buttonAdminOp" @click="unbloquerIp">Unbloquer l'adress Ip</button></tr>
            <tr><input class="inputAdminOp" type="text" v-model="emailbloquer"> <button class="buttonAdminOp" @click="bloqueremail">Bloquer l'adress Email</button><button class="buttonAdminOp" @click="unbloquerEmail">Unbloquer l'adress Email</button></tr>
            <tr><input class="inputAdminOp" type="text" v-model="userprom"> <button class="buttonAdminOp" @click="promouser" >Promouvoir cet utilisateur</button></tr>
            <tr><input class="inputAdminOp" type="text" v-model="admindelete"> <button class="buttonAdminOp" @click="deleteadmin" >Supprimer l'administrateur</button></tr>    
        </table>
            <router-link to="/administrateur/main"><button>Get all user</button></router-link>  
    </div>
</template>
<script>

    import {requestput} from '../netwrok/request.js'
export default {

   data() {
      return {
          ipbloquer:"",
          emailbloquer:"",
          admindelete:"",
          userprom:""
      }
   },
   methods:{
        bloquerIp(){
            if(this.ipbloquer == ""){
                alert("Please enter the IP you want to block")
                }else{
                    let data = {'ADRESS_IP':this.ipbloquer}
                    data = JSON.stringify(data);
                    requestput({
                        url:'/BlockIp',
                        data: data
                    },res=>{
                        console.log(res); 
                        alert("User is blocked")
                    },err=>{
                        console.log(err.response.status);
                        alert(err.response.status + ":" + err.response.data);
                    })                        
                }
       },

       bloqueremail(){
                if(this.emailbloquer == ""){
                alert("Please enter the user you want to block")
                }else{
                    let data = {'USER_LOGIN':this.emailbloquer}
                    data = JSON.stringify(data);
                    requestput({
                        url:'/BlockUser',
                        data: data
                    },res=>{
                        console.log(res); 
                        alert("User is blocked")                        
                    },err=>{
                        console.log(err.response.status);
                        alert(err.response.status + ":" + err.response.data); 
                    })
                }
       }, 

        promouser(){
                if(this.userprom == ""){
                alert("Please enter the user you want to promote")
                }else{
                    let data = {'USER_LOGIN':this.userprom}
                    data = JSON.stringify(data);
                    requestput({
                        url:'/PromUser',
                        data: data
                    },res=>{
                        console.log(res); 
                        alert("User is promoted")                        
                    },err=>{
                        console.log(err.response.status);
                        alert(err.response.status + ":" + err.response.data); 
                    })
                }
       },  

        deleteadmin(){
                if(this.admindelete == ""){
                alert("Please enter the administrateur you want to delete")
                }else{
                    let data = {'USER_LOGIN':this.userprom}
                     data = JSON.stringify(data);
                    requestput({
                        url:'/DeleteAdmin',
                        data: data
                    },res=>{
                        console.log(res); 
                        alert("User is deleted")                        
                    },err=>{
                        console.log(err.response.status);
                        alert(err.response.status + ":" + err.response.data); 
                    })
                }
       }, 

        unbloquerIp(){
            if(this.ipbloquer == ""){
                alert("Please enter the IP you want to unblock")
            }else{
                let data = {'ADRESS_IP':this.ipbloquer}
                data = JSON.stringify(data);
                requestput({
                    // url:'/BlockIp',
                    data: data
                },res=>{
                    console.log(res); 
                    alert("User is unblocked")
                },err=>{
                    console.log(err.response.status);
                    alert(err.response.status + ":" + err.response.data);
                })                        
            }
        },

        unbloquerEmail(){
                if(this.emailbloquer == ""){
                alert("Please enter the user you want to unblock")
                }else{
                    let data = {'USER_LOGIN':this.emailbloquer}
                    data = JSON.stringify(data);
                    requestput({
                        // url:'/BlockUser',
                        data: data
                    },res=>{
                        console.log(res); 
                        alert("User is blocked")                        
                    },err=>{
                        console.log(err.response.status);
                        alert(err.response.status + ":" + err.response.data); 
                    })
                }
       }, 

       

   }
}
</script>
<style>
    #optiontable{
        text-align:center;
        }
        
        .inputAdminOp{
        width:200px; 
        height:20px; 

        margin:0 auto; 
 

        border:1px solid #888; 
        padding:10px; 
        box-sizing:border-box;
        }
        
        .buttonAdminOp{
        width:200px; 
        height:20px; 

        margin:0 auto; 
        order:none; 
        background-color:#41b883; 
        margin-left:100px;
        color:#fff; 
        font-size:14px; 
        margin-bottom:10px;
    }

</style>