<template>
    <!-- Footer -->
    <footer class="bg-gray-900">
        <!-- flex container -->
        <div class="container flex flex-col-reverse justify-between px-6 py-10 mx-auto space-y-8 md:flex-row md:space-y-0">
          <div class="flex flex-col-reverse items-center justify-between space-y-12 md:flex-col md:space-y-0 md:items-start">
              <div class="mx-auto my-6 text-center text-white md:hidden ">
                  Copyright &copy; 2022,All Rights Reserved
              </div>
              <!-- Logo -->
              <div>
                 <!--  <img src="~assets/images/logo.png" class="h-8" alt=""> -->
                 <img src="~/assets/images/duty-free.png" alt="" class="h-16 w-16" >
              </div>
              <!-- social links container -->
              <div class="flex justify-center space-x-4">
                  <!-- link 1 -->
                  <img src="~assets/images/facebook-2.png" alt="" class="h-8">

                  <!-- link 2 -->
                  <img src="~assets/images/instagram.png" alt="" class="h-8">

                  <!-- link 3 -->
                  <img src="~assets/images/twitter.png" alt="" class="h-8">

                  <!-- link 4 -->
                  <img src="~assets/images/whatsapp.png" alt="" class="h-8">

                  <!-- link 5 -->
                  <img src="~assets/images/google.png" alt="" class="h-8">
              </div>
          </div>
          <!-- List container -->
          <div class="flex justify-around space-x-32">
              <div class="flex flex-col space-y-3 text-white">
                  <nuxt-link to="" class="hover:text-blue-400">Home</nuxt-link>
                  <nuxt-link to="" class="hover:text-blue-400">Pricing</nuxt-link>
                  <nuxt-link to="" class="hover:text-blue-400">Products</nuxt-link>
                  <nuxt-link to="" class="hover:text-blue-400">About</nuxt-link>
              </div>
              <div class="flex flex-col space-y-3 text-white">
                  <nuxt-link to="" class="hover:text-blue-400">Careers</nuxt-link>
                  <nuxt-link to="" class="hover:text-blue-400">Community</nuxt-link>
                  <nuxt-link to="" class="hover:text-blue-400">Privacy Policy</nuxt-link>
                  
              </div>
          </div>

          <!-- Input container -->
          <div class=" flex flex-col justify-between">
              <form>
                  <div class="flex space-x-3">
                      <input type="text" class="flex-1 px-4 rounded-full focus:outline-none" placeholder="Updated in your inbox">
                      <button class="px-6 py-2 text-white rounded-full bg-blue-400 hover:bg-blue-400 focus:outline-none"> <nuxt-link to="/auth/login">Login</nuxt-link></button>
                  </div>
              </form>
              <div class="hidden text-white md:block">
                  Copyright &copy; 2022, All Rights Reserved
              </div>
          </div>
        </div>

    </footer>
</template>
<script>
export default {
    
}
</script>
<style>
    
</style>