<template>
    <div id="conversation">
        <h1 id="conversation-contact">{{selectedContact!="" ? selectedContact.name : "Select a contact"}}</h1>
        <MessageFeed v-bind:user="user"/>
        <div v-if="selectedContact!=''" id="send-message">
            <textarea placeholder="Message.." v-on:keydown.enter="send" v-model="message"></textarea>
        </div>
    </div>
</template>

<script>
    import messagefeed from "./MessageFeed.vue";
    import {bus} from "../app";

export default {
    created() {
        bus.$on('SelectedContact',(contact)=>{
            console.log(contact);
            this.selectedContact=contact
        })
        bus.$on('user',(user)=>{
            console.log(user);
            // this.user=user
        })
    },
    props :{
        user:{
            type:Object,
            required:true
        }
    },
    data() {
        return {
            selectedContact:"",
            message:"",
            // user:''
        }
    },
    components:{
        "MessageFeed":messagefeed
    },
    methods: {
         send(e){
             e.preventDefault();
            console.log("Message sendinginitiated");
            if(this.message!='' && this.selectedContact!=""){
                console.log(this.message);
                axios.post("/api/messages",{
                    'to':this.selectedContact.id,
                    'message':this.message
                },{
                    headers:{
                        Authorization:'Bearer '+this.user.api_token
                    }
                })
                    .then((response)=>{
                        bus.$emit('newMessage',response.data)
                        console.log(response);
                    })
                    .catch((e)=>{
                        console.log(e);
                    })
            }
            this.message="";
        }
    },
}   
</script>

<style lang="scss" scoped>
    #conversation{
        flex:5;
        max-height: 600px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        h1{
            padding: 10px;
            font-size: 18px;
            font-weight: bold;
            margin: 0;
            border-bottom:1px dashed #bfbaba;
        }

        #send-message{
            textarea{
                    width: 96%;
                    resize: none;
                    margin: 10px;
                    border-radius: 5px;
                    border: 1px solid #bfbaba;
                    padding: 5px;
            }
        }
    }
  
</style>