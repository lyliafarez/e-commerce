<template >
    <div class="container mx-auto">
        <h1 class="text-center text-blue-500 ">Details of your last order</h1>
        <div v-show="details.length > 0">
            <order-details-table v-for="detail in details" :key="detail.id" :detail="detail"/>
        </div>
        <div v-show="details.length === 0" class="flex flex-col justify-center items-center space-y-4 mt-24">
            <p class="text-center">You didn't order any item till now go to cart or go shopping !</p>
           <nuxt-link to="/products/products" class=""><button class="px-3 py-2 bg-blue-300 rounded-lg text-white">Go shopping</button></nuxt-link>
        </div>
    </div>
</template>
<script>
import OrderDetailsTable from '../../components/tables/OrderDetailsTable.vue'
export default {
  components: { OrderDetailsTable },
  data() {
      return {
          details: '',
      }
  },
    mounted() {
        this.purchaseDetails()
    },
    methods: {
        async purchaseDetails(){
            const resp = await this.$axios.$get('/api/orders/myOrders')
            this.details = resp
            console.log(this.details)


        }
    },
}
</script>
<style >
    
</style>