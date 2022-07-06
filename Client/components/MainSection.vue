<template>
    <div class="container mx-auto bg-fixed bg-no-repeat bg-center bg-cover" :style="{'background-image': `url(${require('@/assets/images/shoppingcart.jpg')})`}">
       <div class="flex flex-col items-center p-12">
           <h1 class="text-center text-white mb-12 text-3xl mt-12">#2022 Promo Products</h1>
           <p class="text-4xl text-blue-400">More solds each day and everyday with new products </p>
           <p class="font-bold text-5xl text-orange-500">Promotion till -85%</p>
           <nuxt-link to="/products/products"><button class="p-4 rounded-lg bg-blue-500 text-white mt-24">Go shopping</button></nuxt-link>
       </div>
    </div>
</template>
<script>
export default {
    
}
</script>
<style>
    
</style>