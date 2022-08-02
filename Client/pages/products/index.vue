<template>
    <div class="container mx-auto">
        <products-table :products="products"/>
         <Spinner v-show="loading" class="flex justify-center items-center"/>
    </div>
</template>
<script>
import ProductsTable from '../../components/tables/ProductsTable.vue';
export default {

    data() {
        return {
            products: [],
            loading: true,
        }
    },
    components: {
        ProductsTable,
    },
    mounted() {
        this.getProducts()
    },

    methods: {
        
        async getProducts(){
            const products = await this.$axios.$get('/api/product');
            console.log(products)
            this.products = products
            this.loading = false
        }
    },
}
</script>
<style>
    
</style>