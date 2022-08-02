<template >
    <div>
       
      <users-table :users="users" :results="results"/>
       <Spinner v-show="loading" class="flex justify-center items-center"/>
     <!--  <pagination :results="results" :users="users"/>  -->
    </div>
</template>
<script>
import UsersTable from '../../components/tables/UsersTable.vue'

export default {
    

    data:() =>({
        users: [],
        results: {},
        loading: true,
    }),
    components:{
        UsersTable
    },

    mounted(){
        this.getUsers()
    },

    methods: {
        async getUsers(){
            await this.$axios.$get('/api/users')
            .then(res=>{
                console.log(res.users)
                this.users = res.users
                this.results = res.users
                this.loading = false
            })
            .catch (err=>{console.log(err)})
        }
    },
}
</script>
<style >
    
</style>