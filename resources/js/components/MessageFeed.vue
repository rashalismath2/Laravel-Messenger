<template>
    <div id="conv" ref="conv">
        <div v-if="selectedContact" id="conversation-messages">
            <li v-bind:class="`message${messagelist.to==user.id?'recieved':'sent'}`" v-for="(messagelist,indexlist) in messages" v-bind:key="indexlist">
                <p v-if="user.id==messagelist.from || selectedContact.id==messagelist.from">{{messagelist.body}}</p>
            </li>
        </div>
    </div>
</template>


<script>
 import {bus} from "../app";
import { setTimeout } from 'timers';

export default {
     created() {
        bus.$on('SelectedContact',(contact)=>{
            console.log(contact);
            this.selectedContact=contact;
            this.messages=[];
            this.GetMessages(contact);
           
        });
        bus.$on('user',(user)=>{
            // this.user=user;
        });
        bus.$on('newMessage',(message)=>{
            this.messages.push(message)
 
        });
    },
    props:{
        user:{
            type:Object,
            required:true
        }
    },
    watch:{
        selectedContact:function(){
            this.scrollConv();
        },
        messages:function(){
            this.scrollConv();
        }
    },
    data() {
        return {
            selectedContact:'',
            // user:{},
            messages:[],
            message:''
        }
    },
    mounted(){
        this.listen();
    },
    computed:{
        // ShowMessages(){

        //     this.messages.filter((message)=>{
        //     console.log(`selected contact ${this.selectedContact.id}  message gtom ${message.from}` );
        //         return this.selectedContact.id==message.from
        //     })
        // }
    },
    methods:{
        GetMessages(contact){
            axios.get(`api/messages/${contact.id}?api_token=${this.user.api_token}`)
                .then((response)=>{
                    console.log("Messages "+response);
                    this.messages=response.data
                })
                .catch((e)=>{console.log("Error on getting messages "+e)})
        },
        scrollConv(){
            setTimeout(()=>{
                var el=this.$refs.conv;
                el.scrollTop=el.scrollHeight-el.clientHeight
            },50)
        },
        listen(){
            console.log("user "+JSON.stringify(this.user.id));
            Echo.private("messages."+this.user.id).listen('NewMessage',(message)=>{
                console.log("New message have been broadcasted "+JSON.stringify(message));
                this.messages.push(message.message);
            })
        } 
    } 
}
</script>

<style lang="scss" scoped>
    #conv{
            background-color: #f9f9f9;
            height: 100%;
            overflow-y: scroll;
    }

    #conversation-messages
    {
        padding-top:10px;
        list-style-type: none;

        li{
            width:100%;
            p{
                margin:0;
            }
        }
        li.messagerecieved{
             text-align: right;
            p{
                max-width: 200px;
                margin: 2.5px 8px 2.5px auto;
                background: #a3aab1;
                text-align: start;
                border-radius:5px;
                padding: 7px;
            }
        }
        li.messagesent{
            text-align: left;
            p{
                padding: 7px;
                max-width: 200px;
                margin: 2.5px 0 2.5px 8px;
                text-align: start;
                border-radius:5px;
                background: #87c3ff;
            }
        }
    }
</style>