<template>
    <div id="components">
        <Conversation v-bind:user="user"/>
        <ContactList v-bind:contactList="contactList" />
    </div>
</template>

<script>
import Conversation from "./components/Conversation.vue";
import ContactList from "./components/ContactList.vue";
import {bus} from "./app"

    export default {
        components:{
            "Conversation":Conversation,
            "ContactList":ContactList
        },
        mounted(){
            bus.$emit('user',this.user);
        },
        props:{
            user:{
                type:Object,
                required:true
            }
        },
        data(){
            return{
                contactList:[]
            }
        },
        created(){
            // console.log(this.user);
            axios.get(`/api/contacts?api_token=${this.user.api_token}`)
                .then((response)=>{
                    this.contactList=response.data
                    console.log(response);
                })
                .catch((e)=>{console.log("Getting contacts error "+e)})
        }
    }

</script>

<style lang="scss" scoped>
    #components{
        display:flex;
    }
</style>