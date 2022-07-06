<template>
    <div>
        <div v-if="this.$auth.loggedIn">
        <nuxt-link to="/dashboard">Dashboard</nuxt-link>
         <nuxt-link to="">{{ this.$auth.user.name }}</nuxt-link>
         <nuxt-link to="/users/">Users</nuxt-link>
         <a href="" @click.prevent="logout">logout</a>
         </div>
         <div v-else>
             <nuxt-link to="/">Home</nuxt-link>
             <nuxt-link to="/auth/login">Login</nuxt-link>
             <nuxt-link to="/auth/register">Register</nuxt-link>
         </div>
    </div>

    
</template>
<script>
export default {
    methods: {
        logout(){
            this.$auth.logout()
        }
    }
}
</script>
<style>
    
</style> 