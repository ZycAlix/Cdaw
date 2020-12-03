<template>
    <div>
        <table id="tb">
            <tr>   
                <th>ID</th>
                <th>Login</th>
                <th>Role</th>
                <th>Ip</th>
                <th>Option</th>
            </tr>
            <tr v-if="length == 0">
                <td colspan="4">No data of users</td>
            </tr>

            <tr v-for="item in lists" :key=item.ID_UTILISATEUR>
                <td>{{item.ID_UTILISATEUR}}</td>
                <td>{{item.USER_LOGIN}}</td>
                <td>{{item.USER_ROLE == 1?"Administrateur":"User"}}</td>
                <td>{{item.ADRESS_IP}}</td>
                <td>option</td>
            </tr>

        </table>
    </div>
</template>


<script>

import $ from 'jquery' 
import {requestget} from '../netwrok/request.js'

    export default{
        data(){
            return{
                lists:[],
                length:""
            }
        },
        mounted(){
           var that = this;
            requestget({
                url: '/Users'
            },res=>{         
               that.lists = res.data
               that.length = that.lists.length 
            })
            $('#tb').DataTable(that.lists);
         },
    }
</script>

<style>
        #tb{

            width: 800px;
            border-collapse: collapse;
            margin: 20px auto;
        }
        #tb th{
            background-color: #0094ff;
            color: white;
            font-size: 16px;
            padding: 5px;
            text-align: center;
            border: 1px solid black;
        }
        #tb td{
            padding: 5px;
            text-align: center;
            border: 1px solid black;
        }
</style>