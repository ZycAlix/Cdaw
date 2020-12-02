<template>
    <div>
        <div class="login-wrap" v-show="showLogin">
            <h3>Login</h3>
            <p v-show="showTishi">{{tishi}}</p>
            <input class="logininput" type="text" placeholder="Enter login" v-model="username">
            <input class="logininput" type="password" placeholder="Enter password" v-model="password">
            <button class="buttonlogin" v-on:click="login">Login</button>
            <span v-on:click="ToRegister">No account? Register at once!</span>
        </div>

        <div class="register-wrap" v-show="showRegister">
            <h3>Register</h3>
            <p v-show="showTishi">{{tishi}}</p>
            <input class="logininput" type="text" placeholder="Enter login" v-model="newUsername">
            <input class="logininput" type="password" placeholder="Enter password" v-model="newPassword">
            <input class="logininput" type="text" placeholder="Firstname" v-model="newFirstname">
            <input class="logininput" type="text" placeholder="Lastname" v-model="newLastname">

            <div class="radioadmin">
            <input class="logininput" type='radio' id="user" value='0' v-model='role'/>
            <label for='user'>Normal ACCOUNT</label>
            <input class="logininput" type='radio' id="admin" value='1' v-model='role'/>
            <label for='admin'>SUPPER ACCOUNT</label>
            </div>

            <button  class="buttonlogin" v-on:click="register">Registe</button>
            <span v-on:click="ToLogin">Already have an account? Login at once!</span>
        </div>
    </div>
</template>

<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>
const bcrypt = require('bcryptjs');

import axios from 'axios';
import {setCookie,getCookie} from '../assets/js/cookie.js'

    export default{
 

        mounted(){
            if(getCookie('username')){
                this.$router.push('/home')
            }
        },
        methods:{
            login(){
                let that = this;
                if(this.username == "" || this.password == ""){
                    alert("Please enter your login and password")
                }else{
                let salt = "$2a$10$xYH3WyLse6mEctoaKl8Ihe";
                
                let hashPassword = bcrypt.hashSync(this.password, salt); // salt is inclued in generated hash 
                    let data = {'login':this.username,'password':hashPassword}
                    data = JSON.stringify(data);
                        axios.post('http://localhost:8888/projet-cdaw/BackEnd/src/api.php/Login',data).then((res)=>{
                        console.log(res); 
                        this.tishi = "Login success";
                        this.showTishi = true; 
                        setCookie('username',this.username,1000*60);
                        setTimeout(function(){
                            console.log(res.data.data+"1111111111111111")
                            if(res.data.data == "0"){
                                this.$router.push('/home');
                                }
                            else{
                                this.$router.push('/administrateur');
                                }
                        }.bind(this),1000);}).catch(function (error){

                            console.log(error.response.status);
                            that.tishi = error.response.status + ":" + error.response.data;
                            that.showTishi = true;
                        })
                }
            },
            ToRegister(){
                this.showRegister = true
                this.showLogin = false
            },  
            ToLogin(){
                this.showRegister = false
                this.showLogin = true
            },
            register(){


                if(this.newUsername == "" || this.newPassword == ""){
                    alert("Please enter your login and password")
                }else{
                    let salt = "$2a$10$xYH3WyLse6mEctoaKl8Ihe";

                    let hashPassword = bcrypt.hashSync(this.newPassword, salt);
                    let data = {'USER_LOGIN':this.newUsername,'USER_PASSWORD':hashPassword,'USER_FIRSTNAME':this.newFirstname,'USER_LASTNAME':this.newLastname,'USER_ROLE':this.role,'ADRESS_IP':this.ip}
                    data = JSON.stringify(data);
                    console.log(data)
                    axios.post('http://localhost:8888/projet-cdaw/BackEnd/src/api.php/Register',data).then((res)=>{
                        console.log(res)
                        this.tishi = "Register success";
                        this.showTishi = true; 
                        this.username = ''
                        this.password = ''
  
                        setTimeout(function(){
                            this.showRegister = false
                            this.showLogin = true
                            this.showTishi = false
                        }.bind(this),1000)
                        }).catch(function (error){

                            console.log(error.response.status);
                            that.tishi = error.response.status + ":" + error.response.data;
                            that.showTishi = true;
                        })


                }
    
}
        },
        data(){
            return{
                showLogin: true,
                showRegister: false,
                showTishi: false,
                tishi: '',
                username: '',
                password: '',

                newUsername: '',
                newPassword: '',
                newFirstname:'',
                newLastname:'',
                ip:returnCitySN["cip"],
                role:''
            }
        }

    }
</script>
<style>
    .login-wrap{
        text-align:center;
    }
    .logininput{
        display:block;
        width:250px; 
        height:40px; 
        line-height:40px; 
        margin:0 auto; 
        margin-bottom: 10px; 
        outline:none; 
        border:1px solid #888; 
        padding:10px; 
        box-sizing:border-box;
        }
    p{
        color:red;
        }
    .buttonlogin{
        display:block; 
        width:250px; 
        height:50px; 
        line-height: 40px; 
        margin:0 auto; 
        order:none; 
        background-color:#41b883; 
        color:#fff; 
        font-size:16px; 
        margin-bottom:5px;}

    span{
        cursor:pointer;
        }
    span:hover{
        color:#41b883;
        }
 
</style>