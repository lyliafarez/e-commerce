<template>
    <div class="container mx-auto p-12">
        <div class="flex flex-col ">
           
            <div class="flex flex-col justify-center items-center space-x-14  md:flex-row ">
                <div class="img flex justify-center w-1/2">
                <img :src="`http://localhost:8000/images/${product.image_path}`" alt="" class="w-1/2 h-1/2">
                </div>
                <div class="flex flex-col space-y-3 w-1/2">
                    <h1 class=" text-3xl">{{ product.title}}</h1>
                    <p>category : {{category.label}}</p>
                    <p> ref : {{product.ref}}</p>
                    <p class=""> price : {{product.price}} $</p>
                    <modal :product="product"/>
                    <div class="delivery-policy flex flex-col space-y-3 bg-gray-200 p-3">
                        <div class="delivry flex flex-row items-center space-x-2">
                            <TruckIcon class="text-blue-400"/>
                            <div class="flex flex-col">
                                <h4 class="text-xs font-bold">Delivery</h4>
                                <p class="text-xs text-gray-500"> free delivery once 39$</p>
                            </div>
                        </div>

                        <div class="policy flex flex-row items-center space-x-2">
                            <QuestionMarkCircleIcon class="text-blue-400"/>
                            <div class="flex flex-col">
                                <h4 class="text-xs font-bold">Policy</h4>
                                <p class="text-xs text-gray-500"> Read more</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           
            <div class="flex flex-col my-12 ">
                <div class="title bg-blue-300 py-4 flex flex-row items-center px-4">
                    <button v-on:click="showDescription">
                        <PlusCircleIcon v-show=" this.show === false " class="text-white"/> 
                        <MinusCircleIcon v-show=" this.show === true " class="text-white"/>
                    </button>
                    <h1 class="text-white text-xl text-center md:text-left">Description</h1>
                </div>
                <div v-show="this.show === true" class="description bg-gray-200">
                    <p class="p-4">{{product.description}}</p>
                </div>
            </div>
        </div>



        <button class="p-3 bg-blue-200 rounded-lg flex flex-row items-center my-12">
            <ArrowCircleLeftIcon/>
            <nuxt-link to="/products/products">Back</nuxt-link>
        </button>
        <div class="comment-post fex flex-col">

            <div class="flex flex-row items-center mb-12">
                 <h1 class="text-5xl text-center md:text-left">Comments</h1>
                  <ChatIcon class="text-blue-400"/>
            </div>
           
            <form @submit="postComment" class="flex flex-col space-y-4" method="POST">
                <input type="text" v-model="form.content" class="appearance-none rounded-none  block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm" placeholder="post your comment ...">
                <div>
                    <button type="submit" class="rounded-lg bg-blue-300 px-6 py-3 text-white">Post</button>
                </div>    
            </form>
            <div class="comments-section my-6 space-y-3">
                <comment-card v-for="comment in comments" :key="comment.id" :comment="comment"/>
            </div>
        </div>
    </div>
</template>
<script>

import CommentCard from '../../components/CommentCard.vue'
import Modal from '../../components/Modal.vue'
import { TruckIcon } from "@vue-hero-icons/outline"
import { QuestionMarkCircleIcon } from "@vue-hero-icons/solid"
import { PlusCircleIcon ,MinusCircleIcon ,ArrowCircleLeftIcon ,ChatIcon, XCircleIcon, } from "@vue-hero-icons/outline"

export default {
  components: { Modal, CommentCard, TruckIcon, QuestionMarkCircleIcon, PlusCircleIcon, MinusCircleIcon, ArrowCircleLeftIcon, ChatIcon, XCircleIcon, },
    data(){
        return {
            product: {},
            category: {},
            form:{
            content: '',
            },
            comments: [],
            show: false,
        }
    },

    mounted(){
        this.getProduct()
        this.showComments()
        //this.countProduct()
    },

    methods: {
        async getProduct(){

            const product = await this.$axios.$get(`/api/product/${this.$route.params.product}`)
            console.log(product)
            this.product = product[0]
            this.category = product[0].category
        },

        async countProduct(){
            
            const count = await this.$axios.$get(`/api/purchase/count/${this.$route.params.product}`)
            console.log(count)
        },

        async postComment(){

            await this.$axios.$post(`/api/comment/${this.$route.params.product}`, this.form)
            .then( resp => { console.log(resp)})
            .catch( err => console.log(err))
        },

        async showComments(){
            const comments = await this.$axios.$get('/api/comments');
            console.log(comments);
            this.comments = comments
        },

        showDescription(){
            this.show = !this.show
        },

        
    }
}
</script>
<style>
    
</style>