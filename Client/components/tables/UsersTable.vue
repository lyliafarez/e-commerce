<template >
    <!-- component -->
<div class="bg-white p-8 rounded-md w-full">
	<div class=" flex flex-col justify-between pb-6 md:flex-row">
		<div>
			<h2 class="text-gray-600 font-semibold">Users list</h2>
			<span class="text-xs">All users</span>
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
                       <nuxt-link to="/users/create">Create</nuxt-link>
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
									Name
								</th>
								<th
									class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
									Username
								</th>
								<th
									class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
									Email
								</th>
								<th
									class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
									Role
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
                            
							<tr v-for="user in filterUsers" :key="user.id" >
								<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
									<div class="flex items-center">
											<div class="ml-3">
												<p class="text-gray-900 whitespace-no-wrap">
													{{ user.name}}
												</p>
											</div>
										</div>
								</td>
								<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
									<p class="text-gray-900 whitespace-no-wrap">{{ user.username }}</p>
								</td>
								<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
									<p class="text-gray-900 whitespace-no-wrap">
										{{ user.email}}
									</p>
								</td>
								<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
									<p class="text-gray-900 whitespace-no-wrap">
										{{ user.role.label}}
									</p>
								</td>
								<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
									<span v-show=" user.status == 1"
                                        class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                                    <span aria-hidden
                                            class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
									<span class="relative">Active</span>
									</span>
									<span v-show=" user.status == 0"
                                        class="relative inline-block px-3 py-1 font-semibold text-red-900 leading-tight">
                                    <span aria-hidden
                                            class="absolute inset-0 bg-red-200 opacity-50 rounded-full"></span>
									<span class="relative">Inactive</span>
									</span>
								</td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm space-x-3 flex flex-row">
									<button class="bg-green-300 p-2 rounded-xl">
										<nuxt-link :to="`/users/${user.id}`">Edit</nuxt-link>
										</button>
									<form action="" @submit="deleteUser(user.id)">
                                    <button class="bg-red-300 p-2 rounded-xl" type="submit">delete</button>
									</form>
									<form v-show="user.status === 1" action="" @submit="disableUser(user.id)">
                                    	<button class="bg-blue-300 p-2 rounded-xl" type="submit">Disable</button>
									</form>
									<form v-show=" user.status === 0 " action="" @submit="enableUser(user.id)">
                                    	<button class="bg-gray-300 p-2 rounded-xl" type="submit">Enable</button>
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
import Pagination from '../Pagination.vue'

export default {
  components: { Pagination },
    props:['users'],
	data(){
		return{
			search: '',
			showButton: false,
		}
	},
	computed: {
		filterUsers(){
			return this.search?.length >0 ? this.users.filter(
				user => user.name.toLowerCase().includes(this.search.toLowerCase()) ||
				user.email.toLowerCase().includes(this.search.toLowerCase()) ||
				user.username.toLowerCase().includes(this.search.toLowerCase()) ||
				user.role.label.toLowerCase().includes(this.search.toLowerCase())
			) 
			:this.users
		}
	},
	methods:{
		async deleteUser(id){
			await this.$axios.$delete(`/api/users/${id}`)
                        .then((resp) => {console.log(resp)})
                        .catch((err) => {
                            if (err.response.status = 422) {
                                errors = err.response.data.errors
                            }
                        })
                        this.errors = errors
		},
		async disableUser(id){
			await this.$axios.$post(`/api/user/disable/${id}`)
					.then((resp) => {console.log(resp)})
			this.showButton = true
			console.log(this.showButton)

		},

		async enableUser(id){
			await this.$axios.$post(`/api/user/enable/${id}`)
					.then((resp) => {console.log(resp)})
			this.showButton = false
		}


	}
}
</script>
<style >
    
</style>