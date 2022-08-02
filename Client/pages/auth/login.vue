<template>

    <div class="min-h-full flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 my-12">
      <div class="max-w-md w-full space-y-8">
        <div>
          
          <h2 class="mt-6 text-center text-3xl font-extrabold text-blue-500">
              Sign in to your account
              </h2>
          <div  v-show="this.showAlert" class="flex flex-row justify-center bg-red-200 py-2 px-2 text-white space-x-3">
            <p class="text-center"> Your account is disabled ! please contact <nuxt-link to="/contactForm" class="text-blue-300">Admin</nuxt-link></p>
            <XCircleIcon v-on:click="toggle"/>
          </div>
        </div>
        <div class="errors flex flex-row justify-center bg-red-200">
          {{ this.errors }}
        </div>
        <form  @submit.prevent="login" class="mt-8 space-y-6"  >
          
          <div class="rounded-md shadow-sm -space-y-px">
            <div>
              <label for="email" class="sr-only">Email address</label>
              <input id="email" name="email" type="email" v-model="form.email"
                class="appearance-none rounded-none  block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm"
                placeholder="Email address" />
            </div>
            <div>
              <label for="password" class="sr-only">Password</label>
              <input id="password" name="password" type="password"  v-model="form.password"
                class="appearance-none rounded-none  block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm"
                placeholder="Password" />
            </div>
          </div>

          <!-- <div class="flex items-center justify-between">
            <div class="flex items-center">
              <input id="remember-me" name="remember-me" type="checkbox"
                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" />
              <label for="remember-me" class="ml-2 block text-sm text-gray-900"> Remember me </label>
            </div>

            <div class="text-sm">
              <a href="#" class="font-medium text-blue-600 hover:text-blue-500"> Forgot your password? </a>
            </div>
          </div>
 -->
          <div>
            <button type="submit"
              class="group  w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-300 hover:bg-blue-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-700"
              >
              <span class=" left-0 inset-y-0 flex items-center pl-3">
                <LockClosedIcon class="h-5 w-5 text-white-500 group-hover:text-white-400" aria-hidden="true" />
              </span>
              Sign in
            </button>
            <div class="flex flex-row justify-center items-center my-3">
                <p class="text-md text-gray-500">Not registered?</p>
                <nuxt-link to="/auth/register"><p  class="hover:text-blue-300">Register</p></nuxt-link>
            </div>
          </div>
        </form>
        
      </div>
    </div>
</template>
<script>
import { LockClosedIcon } from "@vue-hero-icons/outline"
import { LoginIcon, XCircleIcon } from "@vue-hero-icons/outline"
export default {

    components:{LockClosedIcon, LoginIcon,XCircleIcon},

    data:() => ({
            form: {
                email: '',
                password: ''
            },
            errors: '',
            showAlert: false,
        }),
    methods: {
        async login(){
            try { 
                
                const user = await this.$axios.$get(`/api/user/status/${this.form.email}`)
                const userStatus = user.status
                if(userStatus === 1){
                  await this.$auth.loginWith('laravelSanctum',{data:this.form})
                }
                else{
                   this.showAlert = true;
                }
            } catch (error) {
                if(error.response.status = 422){
                    this.errors = 'Could not sign you in with those credentials'
                }
            }
        },
        toggle(){
          this.showAlert = false
        }
    }
}
</script>
<style>
    
</style>