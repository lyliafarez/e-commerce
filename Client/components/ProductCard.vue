<template>
    <!-- <div class="flex flex-col justify-start rounded-lg drop-shadow-md border-2 border-inherit h-25 ">
        <div class="img h-2/3">
            <nuxt-link :to="`/products/${productInfo.id}`">
            <img :src=" `http://localhost:8000/images/${productInfo.image_path}`" alt="" class="rounded-lg h-full w-full ">
            </nuxt-link>
        </div>

        <div class="info-section flex flex-col p-3 space-y-2 h-1/3">
            <span class="text-sm px-2 bg-blue-200 rounded-lg w-1/4 text-center ">{{ productInfo.category.label}}</span>
            <h4 class="text-sm">{{productInfo.title}}</h4>
            <p>{{productInfo.price}}$</p>
        </div>
       
    </div> -->
    <div class="flex flex-col roundes-lg drop-shadow-md border-2 h-60 ">
        <div class="img h-2/3">
           <nuxt-link :to="`/products/${productInfo.id}`">
            <img :src=" `http://localhost:8000/images/${productInfo.image_path}`" alt="" class="rounded-lg h-full w-full ">
            </nuxt-link>
        </div>
        <div class="info-section flex flex-col p-3  h-1/3">
        <div class="label">
             <span class="text-sm px-2 bg-blue-200 rounded-lg  text-center ">{{ productInfo.category.label}}</span>
        </div>
         <h4 class="text-sm">{{productInfo.title}}</h4>
        <p>{{productInfo.price}}$</p>

        </div>
    </div>
</template>
<script>
export default {
    props: ['productInfo'],

    
}
</script>
<style>
    
</style>