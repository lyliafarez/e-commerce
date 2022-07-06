<template >
    <div>
      <users-table :users="users" :results="results"/>
     <!--  <pagination :results="results" :users="users"/>  -->
    </div>
</template>
<script>
import UsersTable from '../../components/tables/UsersTable.vue'

export default {
    

    data:() =>({
        users: [],
        results: {},
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
            })
            .catch (err=>{console.log(err)})
        }
    },
}
</script>
<style >
    
</style>