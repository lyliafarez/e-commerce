<template>
    <div class="container mx-auto">
        <products-table :products="products"/>
    </div>
</template>
<script>
import ProductsTable from '../../components/tables/ProductsTable.vue';
export default {

    data() {
        return {
            products: [],
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
        }
    },
}
</script>
<style>
    
</style>