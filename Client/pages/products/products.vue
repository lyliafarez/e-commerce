<template>
    <div class=" container mx-auto space-y-4 my-6">
        <div class="flex flex-row items-center mt-6 mb-12 ">
            <ShoppingCartIcon class="text-blue-400 text-center md:text-left"/>
            <h1 class="text-center text-3xl font-bold text-blue-400 md:text-left">Products</h1>
        </div> 
     <!-- Search bar -->
     <div class="flex flex-col justify-center items-center ">
        <div class="flex  bg-gray-50  p-2 rounded-md my-4">
				<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20"
					fill="currentColor">
					<path fill-rule="evenodd"
						d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
						clip-rule="evenodd" />
				</svg>
				<input class="bg-gray-50 outline-none ml-1 block " type="text" name="" v-model="search" id="" placeholder="search...">
          </div>
    </div>
        <div class="grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-4">
            <product-card v-for="product in filterProducts" :key="product.id" :productInfo="product"/>
        </div>
        <Spinner v-show="loading" class="flex justify-center items-center"/>
    </div>
</template>
<script>
import ProductCard from '../../components/ProductCard.vue'
import Spinner from '../../components/Spinner.vue'
import { ShoppingCartIcon } from "@vue-hero-icons/outline"
export default {
  components: { ProductCard, ShoppingCartIcon,Spinner},

    data(){
        return{
            products : [],
            search: '',
            loading: true,
        }
    },

    mounted(){
        this.getProducts()
    },
    computed: {
		filterProducts(){
			 return this.search?.length >0 ? this.products.filter(
				product => product.title.toLowerCase().includes(this.search.toLowerCase()) ||
				product.category.label.toLowerCase().includes(this.search.toLowerCase()) ||
				product.ref == this.search ||
				product.id == this.search ||
				product.price == this.search
			)
			:this.products
           
			
		}
	},
    methods: {
        async getProducts(){

            const products = await this.$axios.$get('/api/products')
            console.log(products);
            this.products = products.products;
            this.loading = false
        }
    }
}
</script>
<style>
    
</style>