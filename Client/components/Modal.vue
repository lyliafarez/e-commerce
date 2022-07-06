<template>
    <div>
    <button class="bg-blue-400 text-white active:bg-pink-600 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button" v-on:click="toggleModal()">
      Purchase
    </button>
    <div v-if="showModal" class="overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center flex">
      <div class="relative w-auto my-6 mx-auto max-w-xl">
        <!--content-->
        <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
          <!--header-->
          <div class="flex items-start justify-between p-5 border-b border-solid border-slate-200 rounded-t">
            <h3 class="text-3xl font-semibold">
              Get product
            </h3>
            <button class="p-1 ml-auto bg-transparent border-0 text-black opacity-5 float-right text-3xl leading-none font-semibold outline-none focus:outline-none" v-on:click="toggleModal()">
              <span class="bg-transparent text-black opacity-5 h-6 w-6 text-2xl block outline-none focus:outline-none">
                ×
              </span>
            </button>
          </div>
          <!--body-->
          <div class="relative p-6 flex-auto">
            <p class="my-4 text-slate-500 text-lg leading-relaxed">
              I always felt like I could do anything. That’s the main
              thing people are controlled by! Thoughts- their perception
              of themselves! They're slowed down by their perception of
              themselves. If you're taught you can’t do anything, you
              won’t do anything. I was taught I could do everything. 
            </p>
                    <!-- <vc-date-picker
                        :value="null"
                        color="red"
                        is-dark
                        is-range
                        /> -->
          </div>
          <!--footer-->
          <div class="flex items-center justify-center p-6 border-t border-solid border-slate-200 rounded-b">
            <button class="text-blue-500 bg-transparent border border-solid border-blue-500 hover:bg-red-500 hover:text-white hover:bg-blue-500 font-bold uppercase text-sm px-6 py-3 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button" v-on:click="toggleModal()">
              Close
            </button>
            <form @submit.prevent="purchaseProduct" >
            <button type="submit" class="text-blue-500 background-transparent font-bold uppercase px-6 py-2 text-sm outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" 
               >
               Add Item
            </button>
            
            </form>
          </div>
        </div>
      </div>
    </div>
    <div v-if="showModal" class="opacity-25 fixed inset-0 z-40 bg-black"></div>
  </div>
</template>
<script>
export default {

    props:["product"],
    data() {
    return {
      showModal: false,  
    }
  },
  methods: {
    toggleModal: function(){
      this.showModal = !this.showModal;
    },

    async addProduct(){
        let errors = []
        await this.$axios.$post(`/api/purchase/${this.product.id}`)
                .then( resp => { console.log(resp)})
                .catch( err => {
                    if (err.response.status = 422) {
                                errors = err.response.data.errors
                            }
                })
    },

    async purchaseProduct(){

        let count = await this.$axios.$get(`/api/purchase/count/${this.product.id}`)
        console.log(count)

        if(count < 1 ){
            await this.$axios.$post(`/api/purchase/${this.product.id}`)
            .then( resp => { console.log(resp)})
            .catch( err => {
                if (err.response.status = 422) {
                    errors = err.response.data.errors }
                    })
        }
        else{
            await this.$axios.$put(`/api/purchase/quantity/${this.product.id}`)
            .then(resp => { console.log(resp)})
            .catch( err => {
                if (err.response.status = 422) {
                    errors = err.response.data.errors }
            })
        }
        this.toggleModal()


    }
    
  }
    
}
</script>
<style>
    
</style>