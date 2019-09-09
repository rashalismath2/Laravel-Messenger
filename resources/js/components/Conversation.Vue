<template>
    <div id="conversation">
        <h1>{{selectedContact ? selectedContact.name : "Select a contact"}}</h1>
        <MessageFeed />
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
    },
    data() {
        return {
            selectedContact:{}
        }
    },
    components:{
        "MessageFeed":messagefeed
    }
}   
</script>

<style lang="scss" scoped>
    #conversation{
        flex:5;
    }
</style>