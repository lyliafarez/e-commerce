<template>
    <div class="bg-white p-8 rounded-md w-full">
	<div class=" flex  flex-col justify-between pb-6 md:flex-row">
		<div>
			<h2 class="text-gray-600 font-semibold">Products list</h2>
			<span class="text-xs">All products</span>
		</div>
		<div class="flex space-x-3">
			<div class="flex bg-gray-50  p-2 rounded-md">
				<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20"
					fill="currentColor">
					<path fill-rule="evenodd"
						d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
						clip-rule="evenodd" />
				</svg>
				<input class="bg-gray-50 outline-none ml-1 block " type="text" name="" v-model="search" id="" placeholder="search...">
          </div>
				<div class="">
					<button class="bg-indigo-600 px-4 py-2 rounded-md text-white font-semibold tracking-wide cursor-pointer">
                       <nuxt-link to="/products/create">Create</nuxt-link>
                    </button>
				</div>
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
									ID
								</th>
								<th
									class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
									title
								</th>
								<th
									class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
									reference
								</th>
								<th
									class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
									Stock
								</th>
								<th
									class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
									price
								</th>
								<th
									class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
									category
								</th>
								<th
									class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
									promotion
								</th>
								<th
									class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
									Add promo
								</th>
                                <th
									class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
									Actions
								</th>
							</tr>
						</thead>
						<tbody>
                            
							<tr v-for="(product,index) in filterProducts" :key="product.id" >
								<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
									<div class="flex items-center">
											<div class="ml-3">
												<p class="text-gray-900 whitespace-no-wrap">
													{{ filterProducts[index].id}}
												</p>
											</div>
										</div>
								</td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
									<div class="flex items-center">
											<div class="ml-3">
												<p class="text-gray-900 whitespace-no-wrap">
													{{ filterProducts[index].title}}
												</p>
											</div>
										</div>
								</td>
								<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
									<p class="text-gray-900 whitespace-no-wrap">{{ filterProducts[index].ref }}</p>
								</td>
								<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
									<p class="text-gray-900 whitespace-no-wrap">
										{{ filterProducts[index].stock}}
									</p>
								</td>
								<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
									<p class="text-gray-900 whitespace-no-wrap">
										{{ filterProducts[index].price}}
									</p>
								</td>
								<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
									<span
                                        class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                                        <span aria-hidden
                                            class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
									<span class="relative">{{filterProducts[index].category.label}}</span>
									</span>
								</td>
								<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
									<p class="text-gray-900 whitespace-no-wrap">
										{{ filterProducts[index].promotion}} %
									</p>
								</td>
								<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
									<form action="" @submit="addPromo(product.id)">
										<input type="number" name="promo" id="promo" v-model.lazy="form.promo" class="border-2 border-blue-300">
									</form>
								</td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm space-x-3 flex flex-row">
									<!-- <nuxt-link :to="`edit/${product.id}`">
										<button class="bg-green-300 p-2 rounded-xl" type="submit">edit</button>
									</nuxt-link> -->
									<form action="" @submit="deleteProduct(product.id)">
                                    <button class="bg-red-300 p-2 rounded-xl" type="submit">delete</button>
									</form>
								</td>
							</tr>
							
						</tbody>
					</table>
                     
				</div>
			</div>
		</div>
	</div>
</template>
<script>
export default {
    props: ["products"],

	data() {
		return {
			search: '',
			form: {
				promo: '',
			}
		}
	},
	mounted() {
		
	},

	computed: {
		filterProducts(){
			return this.search?.length >0 ? this.products.filter(
				product => product.title.toLowerCase().includes(this.search.toLowerCase()) ||
				product.category.label.toLowerCase().includes(this.search.toLowerCase()) ||
				product.ref == this.search ||
				product.id == this.search ||
				product.price == this.search
			)
			:this.products
			
		}
	},

	methods: {
		async deleteProduct(id){
			await this.$axios.$delete(`/api/product/${id}`)
		},

		async addPromo(id){
			await this.$axios.$post(`/api/product/promotion/${id}`,this.form)
			.then( resp => console.log(resp))
			.catch( err => console.log(err))
		}
		
	}
}
</script>
<style>
    
</style>