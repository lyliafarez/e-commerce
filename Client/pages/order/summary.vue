<template >
    <div class="container mx-auto">
       <h1 class="text-bold text-blue-500 text-center text-3xl">Summary</h1>
       <div class="flex flex-col justify-center items-center my-12">
           <p class="bg-green-200 px-3 py-2 rounded-lg">your payment was successful! to check your order details click <nuxt-link class="text-blue-500" to="/order/details">here</nuxt-link></p>
       </div>

    </div>
</template>
<script>
export default {

    data() {
        return {
            total:0,
        }
    },
    mounted(){
        
        
    },
    
}
</script>
<style >
    
</style>