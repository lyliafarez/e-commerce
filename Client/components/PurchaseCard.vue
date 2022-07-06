<template>
    <div class="container mx-auto bg-green-300 flex flex-row space-x-3  items-center">
       <img :src="item.product.image_path" alt="" class=" h-20 w-20">
       <div class="flex flex-col">
           <h1>{{item.product.title}}</h1>
           <h1>{{item.product.ref}}</h1>
       </div>
       <div class="flex flex-col justify-end">
           <h1>quantity</h1>
           <div class="flex flex-row space-x-3">
               <button type="submit" v-on:click="addItem">Add</button>
                 <h1>{{item.quantity}}</h1>
                <button type="submit" v-on:click="removeItem">Remove</button>
            </div>
       </div>
       <div>
           <button v-on:click="deleteItem"><TrashIcon class="h-5 w-5 text-blue-500 "/></button>
       </div>
    </div>
</template>
<script>
import { TrashIcon, } from "@vue-hero-icons/solid";
export default {
    components: {
        TrashIcon,
    },
    props: ["item"],

    methods: {
        async addItem(){
            await this.$axios.$put(`/api/purchase/quantity/${this.item.product.id}`)
            .then(resp => { console.log(resp)})
            .catch( err => {
                if (err.response.status = 422) {
                    errors = err.response.data.errors }
            })
            window.location.reload();
        },

        async removeItem(){
            let count = this.item.quantity
            console.log(count)

            if(count > 1 ){
            await this.$axios.$put(`/api/purchase/quantityReduce/${this.item.product.id}`)
            .then( resp => { console.log(resp)})
            .catch( err => {
                if (err.response.status = 422) {
                    errors = err.response.data.errors }
                    })
        }
        else{
            await this.$axios.$delete(`/api/purchase/delete/${this.item.id}`)
            .then(resp => { console.log(resp)})
            .catch( err => {
                if (err.response.status = 422) {
                    errors = err.response.data.errors }
            })
        } 
        window.location.reload();
        },

        async deleteItem(){
            await this.$axios.$delete(`/api/purchase/delete/${this.item.id}`)
            .then(resp => { console.log(resp)})
            .catch( err => {
                if (err.response.status = 422) {
                    errors = err.response.data.errors }
            })
             window.location.reload();
        }
        
    },
}
</script>
<style>
    
</style>