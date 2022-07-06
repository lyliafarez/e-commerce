<template>
<!-- Website NavBar -->
   <nav class="relative container mx-auto p-6">
       <!-- flex container -->
       <div class="flex justify-between items-center">
           <!-- Logo -->
           <div class="pt-2">
              <img src="~/assets/images/duty-free.png" alt="" class="h-16 w-16" >
           </div>
           <!-- Menu -->
           <div class="hidden md:flex space-x-6" v-if="!this.$auth.loggedIn">
               <nuxt-link to="/" class="hover:text-blue-300">Home</nuxt-link>
               <nuxt-link to="" class="hover:text-blue-300">Product</nuxt-link>
               <nuxt-link to="" class="hover:text-blue-300">About Us</nuxt-link>
               <nuxt-link to="/auth/register" class="hover:text-blue-300">Register</nuxt-link>
           </div>
           <div v-else class="hidden md:flex space-x-6">
               <div v-show="this.$auth.user.role_id === 2" class="space-x-3">
                <nuxt-link to="/users/" class="hover:text-blue-300">Users space</nuxt-link>
                <nuxt-link to="/products/" class="hover:text-blue-300">products space</nuxt-link>
               </div>
               <nuxt-link to="/products/products" class="hover:text-blue-300">Products</nuxt-link>
               <nuxt-link to="/dashboard" class="hover:text-blue-300">Dashboard</nuxt-link>
               <nuxt-link to="/products/cart" class="hover:text-blue-300">Cart</nuxt-link>
               <a href=""@click.prevent="logout">Logout</a>   
           </div>
           <!-- Button -->
           <button v-show="!this.$auth.loggedIn" class="hidden md:block bg-blue-300 px-6 p-3 pt-2 rounded-full  text-white hover:bg-blue-400" @click="$router.push('/auth/login')"> Login </button>

           <!-- Hamburger -->
           <button id="menu-btn" class="block hamburger md:hidden focus:outline-none " @click="toggleBtn">
               <span class="hamburger-top"></span>
               <span class="hamburger-middle"></span>
               <span class="hamburger-bottom"></span>
           </button>
       </div>
       <!-- Mobile Menu -->
       <div class="md:hidden" v-if="!this.$auth.loggedIn">
           <div id="menu" class="  flex-col items-center hidden self-end py-8 mt-10 space-y-6 font-bold bg-white sm:w-auto sm:self-center left-6 right-6 drop-shadow-[0_35px_35px_rgba(0,0,0,0.25)] ">
            <nuxt-link to="" class="hover:text-blue-300">Pricing</nuxt-link> 
            <nuxt-link to="" class="hover:text-blue-300">Products</nuxt-link> 
            <nuxt-link to="/" class="hover:text-blue-300">About Us</nuxt-link> 
            <nuxt-link to="" class="hover:text-blue-300">Careers</nuxt-link> 
            <nuxt-link to="/auth/register" class="hover:text-blue-300">Register</nuxt-link> 
            <nuxt-link to="/auth/login" class="hover:text-blue-300">Login</nuxt-link> 
            
           </div>
       </div>
       <div class="md:hidden" v-else>
           <div id="menu" class=" flex-col items-center hidden self-end py-8 mt-10 space-y-6 font-bold bg-white sm:w-auto sm:self-center left-6 right-6 drop-shadow-[0_35px_35px_rgba(0,0,0,0.25)] ">
               <div v-show="this.$auth.user.role_id === 2" class="flex flex-col space-y-6 ">
                <nuxt-link to="/users/" class="hover:text-blue-300">Users space</nuxt-link>
                <nuxt-link to="/products/" class="hover:text-blue-300">products space</nuxt-link>
             </div>
            <nuxt-link to="/products/products" class="hover:text-blue-300">Products</nuxt-link>
            <nuxt-link to="/dashboard" class="hover:text-blue-300">Dashboard</nuxt-link>
            <nuxt-link to="/products/cart" class="hover:text-blue-300">Cart</nuxt-link>
            <a href=""@click.prevent="logout">Logout</a>  
           </div>
       </div>
   </nav>
</template>

<script>
export default {
    methods:{
        toggleBtn(){
            const btn = document.getElementById('menu-btn')
            const nav=document.getElementById('menu')
            btn.classList.toggle('open')
            nav.classList.toggle('flex')
            nav.classList.toggle('hidden')
        },
        logout(){
            this.$auth.logout()
        }
    }
}
</script>
<style>
  .hamburger{
      cursor: pointer;
      width:24px;
      height: 24px;
      transition: all 0.25s;
      position: relative;
    }
    .hamburger-top,
    .hamburger-middle,
    .hamburger-bottom{
        position: absolute;
        top: 0;
        left: 0;
        width:24px;
        height: 2px;
        background: #000;
        transform: rotate(0);
        transition: all 0.5s;
    }
    .hamburger-middle{
        transform:translateY(7px)
    }
    .hamburger-bottom{
        transform:translateY(14px)
    }
    .open{
        transform: rotate(90deg);
        transform: translateY(0px);
    }
    .open .hamburger-top{
        transform:rotate(45deg) translateY(6px) translate(6px);
    }
    .open .hamburger-middle{
        display: none;
    }
    .open .hamburger-bottom{
        transform:rotate(-45deg) translateY(6px) translate(-6px);
    }
</style>