<template >
    <!-- Hero Section -->
    <section id="hero">
        <!-- flex container -->
        <div class="container flex flex-col-reverse  items-center px-6 mx-auto mt-10 space-y-0 md:flex-row md:space-y-0">
            <!-- left Item -->
            <div class="flex flex-col mb-32 space-y-12 md:w-1/2">
                <h1 class="max-w-md text-4xl font-bold text-center md:text-5xl md:text-left">Bring everyone together to find new and  innovative products</h1>
                <p class="max-w-sm text-center text-gray-400 md:text-left">
                    Manage makes it simpler for
                     various clients to purchase day-to-day needs so easily
                </p>
                <div class="flex justify-center md:justify-start">
                     <button class="bg-blue-300 px-6 p-3 pt-2 rounded-full  text-white hover:bg-blue-300">  <nuxt-link to="/auth/login">Login</nuxt-link> </button>
                    
                </div>
            </div>
            <!-- Right Item Image -->
            <div class="md:w-1/2">
                <img class="w-80 h-100 " src="~assets/images/pexels-cottonbro-5076510.jpg" alt="">
            </div>
        </div>
    </section>
</template>
<script>
export default {
    
}
</script>
<style >
    
</style>