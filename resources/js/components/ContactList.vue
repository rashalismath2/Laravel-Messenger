<template>
    <div id="contact-list">
        <ul id="contacts">
            <li v-on:click="SelectectedContact(contact)" v-bind:class="selected.id==contact.id?'selected':'' " v-for="(contact,index) in contactList" v-bind:key="index">
                <div id="contact">
                    <div id="contact-img">
                        <img v-bind:src="contact.profile_img" alt="profile Image">
                    </div>
                    <div id="contact-name">
                        <p id="name">{{contact.name}}</p>
                        <p>{{contact.email}}</p>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</template>

<script>

import {bus} from "../app";

export default {
    props:{
        contactList:{
            type:Array,
            required:true
        }
    },
    methods:{
        SelectectedContact(data){
            bus.$emit('SelectedContact',data);
            this.selected=data
        }
    },
    data() {
        return {
            selected:''
        }
    },
}
</script>

<style lang="scss" scoped>
    #contact-list{
        flex:2;
        max-height:600px;
        overflow-y: scroll;
        border-left:1px solid black;
           
    }

    #contacts{
        list-style-type: none;
        padding-left:0
    }

    .selected{
         background: #dee1e4;
    }

    #contact{
        
        display:flex;
        border-bottom:1px solid black;
        height: 80px;
        cursor:pointer
    }

    #contact-img {
        display: flex;
        align-items: center;
        width:30px;
        flex:1 !important;
        img{
            height:50% !important;
            border-radius: 50%;
            height: 50%;
            margin: 0 4px 2px;
        }

    }
    
    #contact-name{
        display:flex;
      justify-content: center;
        flex-flow: column;
        align-items: flex-start;
        font-size: 12px;
        flex:3;
        p{
            margin:0;
        }
        p#name{
            font-weight:bold;
        }
    }

</style>