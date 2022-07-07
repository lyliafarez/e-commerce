<template>
   <!-- Contact Form -->
   <!-- component -->
   <div>
    <h1 class="text-center text-blue-400 my-4 text-2xl">Contact us !</h1>
    <form class=" container mx-auto w-full my-12 p-6 max-w-lg border-2 border-blue-300 rounded-lg shadow-xl">
    <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
        <label  class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
            Username
        </label>
        <input v-model="form.userName" class="appearance-none block w-full bg-gray-200 text-gray-700 border focus:border-blue-400 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" type="text" placeholder="Jane">
        <p v-show=" form.userName.length==0 " class="text-red-500 text-xs italic">Please fill out this field.</p>
        </div>
        <div class="w-full md:w-1/2 px-3">
        <label  class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
            subject
        </label>
        <input v-model="form.subject" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-blue-400" id="grid-last-name" type="text" placeholder="Doe">
        <p v-show=" form.subject.length==0 " class="text-red-500 text-xs italic">Please fill out this field.</p>
        </div>
    </div>
    <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full px-3">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
            E-mail
        </label>
        <input v-model="form.email" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-blue-400" id="email" type="email">
        <p class="text-gray-600 text-xs italic">Some tips - as long as needed</p>
        </div>
    </div>
    <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full px-3">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
            Message
        </label>
        <textarea v-model="form.message" class=" no-resize appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-blue-400 h-48 resize-none" id="message"></textarea>
        <!-- <p class="text-gray-600 text-xs italic">Re-size can be disabled by set by resize-none / resize-y / resize-x / resize</p> -->
        </div>
    </div>
    <div class="md:flex md:items-center">
        <div class="md:w-1/3">
        <button type="submit" @click.prevent="send" class="shadow text-white border-2 border-blue-300 bg-blue-300 focus:shadow-outline focus:outline-none font-bold py-2 px-4 w-full rounded" >
            Send
        </button>
        </div>
        <div class="md:w-2/3"></div>
    </div>
    <div class="flex flex-col mx-3 mb-6 my-6">
        <h2 class="text-center text-blue-300 font-bold mb-6 md:text-left">Contact information</h2> 
        <div class="info-list flex flex-col space-y-3">
            <div class="flex flex-row text-gray-500">
                <LocationMarkerIcon/>
                <p>69 rue maubeuge 75010</p>
            </div>
            <div class="flex flex-row text-gray-500">
                <PhoneIcon/>
                <p>06 35 09 46 70</p>
            </div>
            <div class="flex flex-row text-gray-500">
                <MailIcon/>
                <p>no.reply@heliop.com</p>
            </div>
        </div>
    </div>
    </form>
</div>
</template>
<script>
import { LocationMarkerIcon,PhoneIcon,MailIcon } from "@vue-hero-icons/outline"
export default {
    data(){
        return{
            form: {
                userName: '',
                subject: '',
                email: '',
                message: '',
            }
        }
    },

    components:{
        LocationMarkerIcon,
        PhoneIcon,
        MailIcon
    },

    methods: {
        async send(){
            await this.$axios.$post('/api/mail',this.form);
        }
    },
    
    
}
</script>
<style>
    
</style>

