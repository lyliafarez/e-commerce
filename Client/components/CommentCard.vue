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
                <div class="like w-1/4 flex justify-end">
                    <HeartIcon class="text-blue-500"/>
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
    components:{
        HeartIcon,
        UserIcon,
    },
    props: ["comment"]
}
</script>
<style>
    
</style>