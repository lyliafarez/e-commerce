<template>
    <div>
        <OrdersTable :orders="orders"/>
    </div>
</template>
<script>
import OrdersTable from '../../components/tables/OrdersTable.vue'
export default {
    components: {
        OrdersTable,
    },
    data() {
        return {
            orders: '',
        }
    },
    mounted() {
        this.getOrders()
    },
    methods: {
        async getOrders(){
             const resp = await this.$axios.$get('/api/orders/details')
             this.orders = resp
            
        }
    },
}
</script>
<style>
    
</style>