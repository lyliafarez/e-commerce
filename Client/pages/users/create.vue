<template>

    <div  class="h-screen md:flex">
        <div class="mx-12 flex flex-row jutify-center space-x-3">
            <ArrowCircleLeftIcon class="text-blue-400"/>
         <nuxt-link to="/users/" class="text-blue-400 text-left">back</nuxt-link>
        </div>
      <div class="flex md:w-1/2 justify-center py-10 items-center bg-white">
        <form @submit.prevent="register" class="bg-white">
          <h1 class="text-blue-600 text-center font-bold text-2xl mb-1">Add user</h1>
          <div class="flex items-center border-2 py-2 px-3 rounded-2xl mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20"
              fill="currentColor">
              <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
            </svg>
            <input class="pl-2 outline-none border-none" type="text" v-model="form.name"  placeholder="Full name" />
          </div>
          <div class="flex items-center border-2 py-2 px-3 rounded-2xl mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24"
              stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457.39-2.823 1.07-4" />
            </svg>
            <input class="pl-2 outline-none border-none" type="text"  v-model="form.username" placeholder="Username" />
          </div>
          <div class="flex items-center border-2 py-2 px-3 rounded-2xl mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24"
              stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
            </svg>
            <input class="pl-2 outline-none border-none" type="email" v-model="form.email" placeholder="Email Address" />
          </div>
          <div class="flex items-center border-2 py-2 px-3 rounded-2xl">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20"
              fill="currentColor">
              <path fill-rule="evenodd"
                d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                clip-rule="evenodd" />
            </svg>
            <input class="pl-2 outline-none border-none" type="password"  v-model="form.password" placeholder="Password" />
          </div>
          <div class="flex items-center border-2 py-2 px-3 rounded-2xl">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20"
              fill="currentColor">
              <path fill-rule="evenodd"
                d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                clip-rule="evenodd" />
            </svg>
            <input class="pl-2 outline-none border-none" type="password"  v-model="form.password_confirmation" placeholder="Password confirmation " />
          </div>
          <button type="submit"
            class="block w-full bg-blue-600 mt-4 py-2 rounded-2xl text-white font-semibold mb-2" >Register</button>
          
        </form>
      </div>
    </div>
</template>

<script>
import { ArrowCircleLeftIcon } from "@vue-hero-icons/outline"
    export default {
        components: {ArrowCircleLeftIcon},
        data: ()=> ({
            form: {
                name: '',
                username: '',
                email: '',
                password: '',
                password_confirmation: '',
            },
            errors: [],
        }),
        methods: {
            async register() {
                try {
                    let errors = []
                    //await this.$axios.$get('sanctum/csrf-cookie')
                    await this.$axios.$post('/api/users/create', this.form)
                        .then((resp) => {
                          this.$router.push("/users/");
                        })
                        .catch((err) => {
                            if (err.response.status = 422) {
                                errors = err.response.data.errors
                            }
                        })
                        this.errors = errors
                    //await this.$auth.loginWith('laravelSanctum', {data: this.form})
                } catch (error) {}
            }
        }
    }
</script>