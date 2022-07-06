<template>
    <div class="container mx-auto mt-16 sm:px-6 lg:px-8">
        
        
    </div>
</template>

<script>
    export default {
        
        data: ()=> ({
            errors: [],
        }),

        mounted(){
            this.getUser()
        },

        methods: {
            async register() {
                try {
                    let errors = []
                    
                    await this.$axios.$post(`/api/users/${this.$route.params.id}`,this.user)
                        .then((resp) => {})
                        .catch((err) => {
                            if (err.response.status = 422) {
                                errors = err.response.data.errors
                            }
                        })
                        this.errors = errors
                    
                } catch (error) {}
            },

            async getUser(){
                let id = this.$route.params.id
                let errors = []
                const user = await this.$axios.$get(`/api/users/${id}`)
                console.log(user)
                       
            }
        }
    }
</script>
