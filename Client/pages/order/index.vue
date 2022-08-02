<template>
    <div>
       
        <OrdersTable :orders="orders"/> 
        <Spinner v-show="loading" class="flex justify-center items-center"/>
     
    </div>
</template>
<script>
import OrdersTable from '../../components/tables/OrdersTable.vue'
import Spinner from '../../components/Spinner.vue'
export default {
    components: {
        OrdersTable,
       Spinner,
        
    },
    data() {
        return {
            orders: '',
            loading:true,
           
        }
    },
    mounted() {
        this.getOrders()
    },
    methods: {
        async getOrders(){
             const resp = await this.$axios.$get('/api/orders/details')
             this.orders = resp
             this.pagination = resp
             console.log(this.orders)
             this.loading = false
            
        },
        
    },
}
</script>
<style>
    
</style>