<template>
    <div class="container mx-auto space-y-6 bg-gray-200 p-12 ">
        <div class="flex flex-col md:flex-row space-y-12 justify-center items-center">
            <div class="flex md:w-2/3">
             <purchase-table :cart="cart"/>
            </div>
            <div class="flex flex-col md:w-1/3  px-4 py-3 bg-white mx-6">
            <h1 class="font-bold text-2xl mb-3">Resume of your commande </h1>
            <div class="flex flex-row justify-between">
                <h3>subTotal</h3>
                <p class="font-bold text-2xl">{{total}}$</p>
            </div>
            
                 <button class="bg-black text-white text-xl py-3 mx-3 mt-8"><nuxt-link to="/order/checkout">Pay</nuxt-link></button>
           
            <p class="text-gray-400 px-8 text-center my-3"> Apply coupon code follow the steps downbelow</p>

                <div class="payment flex flex-col">
                     <h1 class="font-bold text-2xl mt-8"> We accept  </h1>
                     <div class="flex flex-row space-x-2">
                         <img src="~/assets/images/american-express.png" alt="" class="h-14 w-16">
                         <img src="~/assets/images/visa.png" alt="" class="h-14 w-16">
                         <img src="~/assets/images/dinners-club.png" alt="" class="h-14 w-16">
                     </div>
                        <img src="~/assets/images/money.png" alt="" class="h-14 w-16">
                </div>
            </div>
        </div>
       
        <!-- <purchase-card v-for=" item in cart " :key="item.id" :item ="item"/>
        <p>the total on your cart :{{ total}} </p> -->
    </div>
</template>
<script>
import PurchaseCard from '../../components/PurchaseCard.vue';
import PurchaseTable from '../../components/tables/PurchaseTable.vue';
export default {
  components: { PurchaseCard, PurchaseTable },
    data() {
        return {
            cart: [],
            total: '',
        }
    },
    mounted(){
        this.getCart();
        this.getSum();
    },
    methods: {
        async getCart(){

            const cart = await this.$axios.$get('/api/purchase/cart')
            this.cart = cart
            this.$store.commit('setCart',cart)
            
        },

        async getSum(){

            const sum = await this.$axios.$get('/api/cart/sumProducts')
            this.total = sum
             this.$store.commit('setTotal',sum)
            
        }
    }
}
</script>
<style>
    
</style>