<template>
    <div>
        <!-- component -->
<div class="bg-white p-8 rounded-md w-full">
	<div class=" flex items-center justify-between pb-6">
		<div>
			<h2 class="text-gray-600 font-semibold">Orders list</h2>
			<span class="text-xs">All orders</span>
		</div>
		<!-- <div class="flex items-center justify-between">
			<div class="flex bg-gray-50 items-center p-2 rounded-md">
				<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20"
					fill="currentColor">
					<path fill-rule="evenodd"
						d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
						clip-rule="evenodd" />
				</svg>
				<input class="bg-gray-50 outline-none ml-1 block " type="text" name="" id="" placeholder="search...">
          </div>
				<div class="lg:ml-40 ml-10 space-x-8">
					<button class="bg-indigo-600 px-4 py-2 rounded-md text-white font-semibold tracking-wide cursor-pointer">New Report</button>
					<button class="bg-indigo-600 px-4 py-2 rounded-md text-white font-semibold tracking-wide cursor-pointer">Create</button>
				</div>
			</div> -->
		</div>
		<div>
			<div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
				<div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
					<table class="min-w-full leading-normal">
						<thead>
							<tr>
								<th
									class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
									ID
								</th>
								<th
									class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
									User
								</th>
								<th
									class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
									Total
								</th>
								<th
									class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
									Transaction ID
								</th>
								<th
									class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
									Status
								</th>
                                <th
									class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
									Actions
								</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="order in orders" :key="order.id" >
								<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
									<div class="flex items-center">
											<div class="">
												<p class="text-gray-900 whitespace-no-wrap">
													{{ order.id}}
												</p>
											</div>
										</div>
								</td>
								<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
									<p class="text-gray-900 whitespace-no-wrap">{{order.user_id}}</p>
								</td>
								<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
									<p class="text-gray-900 whitespace-no-wrap">
									{{ order.total/100}}
									</p>
								</td>
								<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
									<p class="text-gray-900 whitespace-no-wrap">
										{{ order.transaction_id}}
									</p>
								</td>
								<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
									<span v-if="order.shipping_status == 0 && order.delivery_status == 0 && order.reception_status == 0"
                                        class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                                        <span aria-hidden
                                            class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
									<span class="relative">on process</span>
									</span>
									<span v-if="order.shipping_status == 1 && order.delivery_status == 0 && order.reception_status == 0"
                                        class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                                        <span aria-hidden
                                            class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
									<span class="relative">shipped</span>
									</span>
									<span v-if="order.shipping_status == 0 && order.delivery_status == 1 && order.reception_status == 0"
                                        class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                                        <span aria-hidden
                                            class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
									<span class="relative">delivered</span>
									</span>
									<span v-if="order.shipping_status == 0 && order.delivery_status == 0 && order.reception_status == 1"
                                        class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                                        <span aria-hidden
                                            class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
									<span class="relative">received</span>
									</span>
								</td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm flex flex-row space-x-2">
									
									<form action="" @submit="deleteOrder(order.id)">
                                    <button class="bg-red-300 p-2 rounded-xl" type="submit">delete</button>
									</form>
									<form  action="" @submit="shipOrder(order.id)">
                                    	<button class="bg-blue-300 p-2 rounded-xl" type="submit">send</button>
									</form>
									<form action="" @submit="deliverOrder(order.id)">
                                    	<button class="bg-gray-300 p-2 rounded-xl" type="submit">deliver</button>
									</form>
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
					
				</div>
				<!-- <Pagination :results="orders"/> -->

			</div>
		</div>
	</div>
    </div>
</template>
<script>

import LaravelVuePagination from '@/plugins/vueLaravelPagination'
export default {
    props: ["orders"],
	components:{
	
	},
	methods: {
		async shipOrder(order){
			const resp = await this.$axios.$put(`/api/order/shippingStatus/${order}`)
				.then( resp => console.log(resp))
		},
		async deliverOrder(order){
			const resp = await this.$axios.$put(`/api/order/deliveryStatus/${order}`)
				.then( resp => console.log(resp))
		},
		async deleteOrder(order){
			const resp = await this.$axios.$delete(`/api/order/delete/${order}`)
		}

	},
}
</script>
<style>
    
</style>