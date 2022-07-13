<template>
    <div>
        <!-- component -->
<div class="bg-white p-8 rounded-md w-full">
	<div class=" flex items-center justify-between pb-6">
		<!-- <div>
			<h2 class="text-gray-600 font-semibold">Products Oder</h2>
			<span class="text-xs">All products item</span>
		</div> -->
		<div class="flex items-center justify-between">
			<!-- <div class="flex bg-gray-50 items-center p-2 rounded-md">
				<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20"
					fill="currentColor">
					<path fill-rule="evenodd"
						d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
						clip-rule="evenodd" />
				</svg>
				<input class="bg-gray-50 outline-none ml-1 block " type="text" name="" id="" placeholder="search...">
          </div> -->
				<!-- <div class="lg:ml-40 ml-10 space-x-8">
					<button class="bg-indigo-600 px-4 py-2 rounded-md text-white font-semibold tracking-wide cursor-pointer">New Report</button>
					<button class="bg-indigo-600 px-4 py-2 rounded-md text-white font-semibold tracking-wide cursor-pointer">Create</button>
				</div> -->
			</div>
		</div>
		<div>
			<div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
				<div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
					<table class="min-w-full leading-normal">
						<thead>
							<tr>
								<th
									class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
									Product
								</th>
								<th
									class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
									Price
								</th>
								<th
									class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
									Nb items
								</th>
								<th
									class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
									Total
								</th>
								<th
									class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
									Status
								</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="(product,index) in detail.products" :key="product.id">
								<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
									<div class="flex items-center">
										<div class="flex-shrink-0 w-10 h-10">
											<img class="w-full h-full rounded-full"
                                          :src=" `http://localhost:8000/images/${product.image_path}`" 
                                                alt="" />
                                        </div>
											<div class="ml-3">
												<p class="text-gray-900 whitespace-no-wrap">
													{{product.title}}
												</p>
											</div>
										</div>
								</td>
								<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
									<p class="text-gray-900 whitespace-no-wrap">{{product.price}}</p>
								</td>
								<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
									<p class="text-gray-900 whitespace-no-wrap">
										{{detail.purchases[index].quantity}} 
									</p>
								</td>
								<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
									<p class="text-gray-900 whitespace-no-wrap">
											 {{ getPrice((detail.purchases[index].quantity),(product.price))}} 
									</p>
								</td>
								<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
									<span v-if="detail.shipping_status == 0 && detail.delivery_status == 0 && detail.reception_status == 0"
                                        class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                                        <span aria-hidden
                                            class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
									<span class="relative">on process</span>
									</span>
									<span v-if="detail.shipping_status == 1 && detail.delivery_status == 0 && detail.reception_status == 0"
                                        class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                                        <span aria-hidden
                                            class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
									<span class="relative">shipped</span>
									</span>
									<span v-if="detail.shipping_status == 0 && detail.delivery_status == 1 && detail.reception_status == 0"
                                        class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                                        <span aria-hidden
                                            class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
									<span class="relative">delivered</span>
									</span>
									<span v-if="detail.shipping_status == 0 && detail.delivery_status == 0 && detail.reception_status == 1 "
                                        class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                                        <span aria-hidden
                                            class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
									<span class="relative">received</span>
									</span>
								</td>
							</tr>
							
						</tbody>
					</table>
					<!-- <div
						class="px-5 py-5 bg-white border-t flex flex-col xs:flex-row items-center xs:justify-between          ">
						<span class="text-xs xs:text-sm text-gray-900">
                            Showing 1 to 4 of 50 Entries
                        </span>
						<div class="inline-flex mt-2 xs:mt-0">
							<button
                                class="text-sm text-indigo-50 transition duration-150 hover:bg-indigo-500 bg-indigo-600 font-semibold py-2 px-4 rounded-l">
                                Prev
                            </button>
							&nbsp; &nbsp;
							<button
                                class="text-sm text-indigo-50 transition duration-150 hover:bg-indigo-500 bg-indigo-600 font-semibold py-2 px-4 rounded-r">
                                Next
                            </button>
						</div>
					</div> -->

					<div class="flex flex-row justify-between">
						<p>Total price : {{getTotal}}</p>
						<p>{{date}}</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div v-show="detail.delivery_status == 1" class="reception flex flex-row justify-center items-center space-x-3 my-4">
		<p>if received click </p>
		<form action="" @submit="receivedOrder(detail.id)">
        <button class="bg-green-300 px-2 rounded-xl" type="submit">received</button>
		</form>
	</div>
	<div class="container mx-auto flex flex-row justify-center">
		<p class="bg-red-100 px-3 rounded-lg">the delivery is going to be between {{minDate}} and {{maxDate}}</p>
	</div>
    </div>
</template>
<script>
export default {
   props: ["detail"],
	data() {
		return {
			totalPrice: '',
			date: '',
			maxDate: '',
			minDate: '',
		}
	},
	mounted() {
		this.getDate()
		this.getDeliveryInterval()
	},

	computed: {
		getTotal(){
			this.totalPrice = this.detail.total/100
			return this.totalPrice
		},
		
	},

	methods: {
		getPrice(quantity,price){
			return quantity*price
		},
		async getDate(){
			const resp = await this.$axios.$get(`/api/order/date/${this.detail.id}`)
			this.date = resp
			
		},
		async getDeliveryInterval(){
			const resp = await this.$axios.$get(`/api/order/Intervaldate/${this.detail.id}`)
			this.minDate = resp['min_date']
			this.maxDate = resp['max_date']
			console.log(this.minDate,this.maxDate)
		},
		async receivedOrder(order){
			const resp = await this.$axios.$put(`/api/order/receptionStatus/${order}`)
				.then( resp => console.log(resp))
		}

	},
}
</script>
<style>
    
</style>