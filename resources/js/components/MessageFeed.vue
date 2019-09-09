<template>
    <div>
        <div id="messages">
             <li v-for="(messagelist,indexlist) in messages" v-bind:key="indexlist">
             {{messagelist.body}}
        </li>
        </div>
        <div id="send">
             <textarea name="" id="" cols="30" rows="10"></textarea>
        </div>
    </div>
</template>


<script>
 import {bus} from "../app";

export default {
     created() {
        bus.$on('SelectedContact',(contact)=>{
            console.log(contact);
            this.selectedContact=contact;
            this.GetMessages(contact);
        });
        bus.$on('user',(user)=>{
            console.log(user);
            this.user=user;
          
        });
    },
    mounted(){
      
    },
    data() {
        return {
            selectedContact:'',
            user:{},
            messages:[]
        }
    },
    methods:{
        GetMessages(contact){
            axios.get(`api/messages/${contact.id}?api_token=${this.user.api_token}`)
                .then((response)=>{
                    console.log("Messages "+response);
                    this.messages=response.data
                })
                .catch((e)=>{console.log("Error on getting messages "+e)})
        }
    }
}
</script>