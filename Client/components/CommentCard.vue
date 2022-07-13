<template>
    <!-- <div class="container mx-auto my-3">
        <h1>{{comment.user.username}}</h1>
        <p class ="bg-red-200 rounded-lg px-6">{{ comment.content}}</p>
    </div> -->
    <div class="container mx-auto">
        <div class="flex flex-col bg-gray-200">
            <div class="flex flex-row  px-3 py-6 ">
                <div class="name w-1/4 flex justify-center">
                    <UserIcon/>
                    <h1>{{comment.user.username}}</h1>
                </div>
                <div class="content w-2/4">
                    <p>{{ comment.content}}</p>
                </div>
                <div v-if="!liked" class="like w-1/4 flex justify-end">
                    <button @click="likeComment"><HeartIcon class="text-blue-500"/></button>
                    <p>{{ nbLikes }}</p>
                </div>
                <div v-else class="like w-1/4 flex justify-end">
                    <button @click="unlike"><HeartIcon class="text-green-500 bg-blue"/></button>
                    <p>{{ nbLikes }}</p>
                </div>
            </div>
            <div class="date flex justify-end px-2 py-2">
                {{ comment.created_at}}
            </div>
        </div>
    </div>
</template>
<script>
import { HeartIcon, UserIcon } from "@vue-hero-icons/outline"

export default {

    data() {
        return {
            nbLikes: '',
            liked: '',
        }
    },
    components:{
        UserIcon,
        HeartIcon,
    },
    props: ["comment"],

    mounted() {
       this.countLike()
       this.likedBy()
    },

    methods: {
        async likeComment(){
            await this.$axios.$post(`/api/likes/${this.comment.id}`) 
            this.liked = !this.liked

        },

        async countLike(){
            const count = await this.$axios.$get(`/api/likes/count/${this.comment.id}`)
            this.nbLikes = count
           
        },

        async likedBy(){
            const resp = await this.$axios.$get(`/api/comments/${this.comment.id}`)
            this.liked = resp
            
        },

        async unlike(){
            await this.$axios.$delete(`/api/likes/${this.comment.id}`)
            this.liked = !this.liked
        }



    },
}
</script>
<style>
    
</style>