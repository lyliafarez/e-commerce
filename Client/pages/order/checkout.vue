<template>
    <div class="">
        
        <div class="container mx-auto mt-8 w-2/3">
         <h1 class="text-left text-blue-500 py-3">Personnel information:</h1>
            <div class="flex flex-col justify-center items-center -mx-2 mt-8">
                <div class="p-2 w-2/3 md:w-1/3">
                    <div class="relative">
                        <label for="first_name" class="leading-7 text-sm text-gray-600">First Name</label>
                        <input
                            type="text"
                            id="first_name"
                            name="first_name"
                            class="w-full bg-gray-100 rounded border border-gray-300 focus:border-indigo-500 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                            v-model="customer.first_name"
                            :disabled="paymentProcessing"
                        >
                    </div>
                </div>
                <div class="p-2  w-2/3 md:w-1/3">
                    <div class="relative">
                        <label for="last_name" class="leading-7 text-sm text-gray-600">Last Name</label>
                        <input
                            type="text"
                            id="last_name"
                            name="last_name"
                            class="w-full bg-gray-100 rounded border border-gray-300 focus:border-indigo-500 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                            v-model="customer.last_name"
                            :disabled="paymentProcessing"
                        >
                    </div>
                </div>
                <div class="p-2  w-2/3 md:w-1/3">
                    <div class="relative">
                        <label for="email" class="leading-7 text-sm text-gray-600">Email Address</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="w-full bg-gray-100 rounded border border-gray-300 focus:border-indigo-500 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                            v-model="customer.email"
                            :disabled="paymentProcessing"
                        >
                    </div>
                </div>
            </div>
            <h1 class="text-left text-blue-500 py-3">Delivery address information:</h1>
            <div class="flex flex-col justify-center items-center -mx-2 mt-4">
                <div class="p-2  w-2/3 md:w-1/3">
                    <div class="relative">
                        <label for="address" class="leading-7 text-sm text-gray-600">Street Address</label>
                        <input
                            type="text"
                            id="address"
                            name="address"
                            class="w-full bg-gray-100 rounded border border-gray-300 focus:border-indigo-500 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                            v-model="customer.address"
                            :disabled="paymentProcessing"
                        >
                    </div>
                </div>
                <div class="p-2  w-2/3 md:w-1/3">
                    <div class="relative">
                        <label for="city" class="leading-7 text-sm text-gray-600">City</label>
                        <input
                            type="text"
                            id="city"
                            name="city"
                            class="w-full bg-gray-100 rounded border border-gray-300 focus:border-indigo-500 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                            v-model="customer.city"
                            :disabled="paymentProcessing"
                        >
                    </div>
                </div>
                <div class="p-2  w-2/6 md:w-1/6">
                    <div class="relative">
                        <label for="state" class="leading-7 text-sm text-gray-600">State</label>
                        <input
                            type="email"
                            id="state"
                            name="state"
                            class="w-full bg-gray-100 rounded border border-gray-300 focus:border-indigo-500 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                            v-model="customer.state"
                            :disabled="paymentProcessing"
                        >
                    </div>
                </div>
                <div class="p-2  w-2/3 md:w-1/3">
                    <div class="relative">
                        <label for="zip_code" class="leading-7 text-sm text-gray-600">Zip Code</label>
                        <input
                            type="email"
                            id="zip_code"
                            name="zip_code"
                            class="w-full bg-gray-100 rounded border border-gray-300 focus:border-indigo-500 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                            v-model="customer.zip_code"
                            :disabled="paymentProcessing"
                        >
                    </div>
                </div>
            </div>
            <h1 class="text-left text-blue-500 py-3">Credit card information:</h1>
            <div class="flex flex-col justify-center items-center -mx-2 mt-4">
                <div class="p-2 w-2/3">
                    <div class="relative">
                        <!-- <label for="card-element" class="leading-7 text-sm text-gray-600">Credit Card Info</label> -->
                        <div id="card-element"></div>
                    </div>
                </div>
            </div>
            <div class="p-2 w-full">
                <button
                    class="flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg"
                    @click="processPayment"
                    :disabled="paymentProcessing"
                    v-text="paymentProcessing ? 'Processing' : 'Pay Now'"
                ></button>
            </div>
        </div>
    </div>
</template>
<script>
import {loadStripe} from '@stripe/stripe-js';
export default {
    data() {
            return {
                stripe: {},
                cardElement: {},
                customer: {
                    first_name: '',
                    last_name: '',
                    email: '',
                    address: '',
                    city: '',
                    state: '',
                    zip_code: ''
                },
                paymentProcessing: false,
                cart: '',
                total: 0,
                
            }
        },
        async mounted() {
            this.cart = this.$store.getters.getCart
            this.total = this.$store.getters.getTotal
           
            this.stripe = await loadStripe('pk_test_51LJBEUB5sPcQL0hJccnFNwsELoTgWD49AXWG9XpFJmeqC8So9GnbWhkXz6wX6UZaPJoGkDDIhbYGuIJxyE5lwCTR00UrSQInrN');
            const elements = this.stripe.elements();
            this.cardElement = elements.create( 'card',{
                classes: {
                    base: 'bg-gray-100 rounded border border-gray-300 focus:border-indigo-500 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out'
                }
            })
            this.cardElement.mount('#card-element')
        },
    methods: {
        async processPayment() {
            //send payment info to laravel +stripe
            this.paymentProcessing = true;
                const {paymentMethod, error} = await this.stripe.createPaymentMethod(
                    'card', this.cardElement, {
                        billing_details: {
                            name: this.customer.first_name + ' ' + this.customer.last_name,
                            email: this.customer.email,
                            address: {
                                line1: this.customer.address,
                                city: this.customer.city,
                                state: this.customer.state,
                                postal_code: this.customer.zip_code
                            }
                        }
                    }
                );
                if (error) {
                    this.paymentProcessing = false;
                    console.error(error);
                } else {
                    console.log(paymentMethod);
                    this.customer.payment_method_id = paymentMethod.id;
                    this.customer.amount = this.total*100;
                    this.customer.cart = JSON.stringify(this.cart)
                    console.log(this.customer)
                      this.$axios.$post('/api/pay/', this.customer)
                        .then((response) => {
                            this.paymentProcessing = false;
                           // this.$axios.$delete('/api/purchase/delete')
                            console.log(response);
                            this.$router.push("/order/summary");
                        })
                        .catch((error) => {
                            this.paymentProcessing = false;
                            console.error(error);
                        });   
                }
        }
    },
}
</script>
<style>
    
</style>