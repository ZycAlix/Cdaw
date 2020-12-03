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
            <label for='user'>Normal account</label>
            <input class="logininput" type='radio' id="admin" value='1' v-model='role'/>
            <label for='admin'>Super account</label>
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
import {requestpost} from '../netwrok/request'
import {mapMutations} from 'vuex'



    export default{
        mounted(){
            if(getCookie('username')){
                if(getCookie('userrole') == 0){
                this.$router.push('/home')}
                else{
                this.$router.push('/administrateur')}
            }
        },
        created(){
            console.log(localStorage.getItem('Authorization'))
        },
        methods:{
            ...mapMutations(['changeLogin']),
            login(){
                let that = this;
                if(this.username == "" || this.password == ""){
                    alert("Please enter your login and password")
                }else{
                let salt = "$2a$10$xYH3WyLse6mEctoaKl8Ihe";
                let hashPassword = bcrypt.hashSync(this.password, salt); // salt is inclued in generated hash 
                let data = {'login':this.username,'password':hashPassword}    
                data = JSON.stringify(data);
                requestpost({
                    url: '/Login',
                    data: data
                },res=>{
                    console.log( res.data.jwt_token)
                    that.tishi = "Login success";
                    that.showTishi = true; 
                    that.userToken = 'Bearer ' + res.data.jwt_token;
                    that.changeLogin({ Authorization: that.userToken })
                    setCookie('userrole',that.data,1000*60)
                    setCookie('username',that.username,1000*60);
                    setTimeout(function(){
                        if(res.data == "0"){
                            that.$router.push('/home');
                            }
                        else{
                            that.$router.push('/administrateur');
                            }
                        }.bind(that),1000);    
                    },err =>{
                        console.log(err)
                        if(err != null){
                            console.log(err.response.status);
                            that.tishi = err.response.status + ":" + err.response.data;
                            that.showTishi = true;
                        }
                    }
                )}  
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
                    requestpost({
                        url:'/Register',
                        data: data
                    },res=>{
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
                    },err=>{
                        console.log(err.response.status);
                        that.tishi = err.response.status + ":" + err.response.data;
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
                userToken:'',

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