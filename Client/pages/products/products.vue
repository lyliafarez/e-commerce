<template>
    <div class=" container mx-auto space-y-4 my-6">
        <div class="flex flex-row items-center justify-center mt-6 mb-12">
            <ShoppingCartIcon class="text-blue-400"/>
            <h1 class="text-center text-3xl font-bold text-blue-400 md:text-left">Products</h1>
        </div> 
     
        <div class="grid grid-cols-2 gap-4 md:grid-cols-4 ">
            <product-card v-for="product in products.products" :key="product.id" :productInfo="product"/>
        </div>
    </div>
</template>
<script>
import ProductCard from '../../components/ProductCard.vue'
import { ShoppingCartIcon } from "@vue-hero-icons/outline"
export default {
  components: { ProductCard, ShoppingCartIcon},

    data(){
        return{
            products : []
        }
    },

    mounted(){
        this.getProducts()
    },
    methods: {
        async getProducts(){

            const products = await this.$axios.$get('/api/products')
            console.log(products);
            this.products = products;
        }
    }
}
</script>
<style>
    
</style>