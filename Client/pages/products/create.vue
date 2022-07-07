<template >
   <div class="container mx-auto  flex flex-col  space-y-4">
       <div class="mx-12 flex flex-row jutify-center space-x-3">
            <ArrowCircleLeftIcon class="text-blue-400"/>
         <nuxt-link to="/products/" class="text-blue-400 text-left">back</nuxt-link>
        </div>
       <form action="" method="post" class="flex flex-col space-y-4 justify-center items-center " enctype="multipart/form-data" @submit.prevent="addProduct" >
         <h1 class="text-blue-500 text-center text-2xl">Add product</h1>
           <div class="title ">
               <input name="title" type="text" v-model="form.title" placeholder="title..." class="border-2 border-gray-300 rounded-lg w-full ">
           </div>

           <div class="reference">
               <input type="number" v-model="form.ref" name="ref" id="ref" placeholder="reference..." class="border-2 border-gray-300 rounded-lg w-full">
           </div>

           <div class="price">
               <input type="number" v-model="form.price" name="price" id="price" placeholder="price..." class="border-2 border-gray-300 rounded-lg w-full">
           </div>
           <div class="stock">
               <input type="number" v-model="form.stock" name="stock" id="stock" placeholder="stock..." class="border-2 border-gray-300 rounded-lg w-full">
           </div>

           <div class="category">
               <label for="">category:</label>
               <select v-model="form.category_id" class="border-2 border-gray-300 w-full" >
                    <option v-for="category in categories" :value="category.id">
                        {{ category.label}}
                    </option>
                </select>
           </div>

           <div class="description flex flex-col">
               <textarea name="description" v-model="form.description" id="" cols="20" rows="10" class="border-2 border-gray-300 rounded-lg" placeholder=" Add description"></textarea>
           </div>

           <div class="image">
               <label for="image">Image</label>
               <input type="file"  id="image" ref="myFiles" name="image" v-on:change="previewFiles" >
           </div>
          
          <button type="submit" class="my-3 bg-blue-500 px-4 py-3 text-white rounded-lg"> Create </button>
           
       </form>





       
   </div>
</template>
<script>
import { ArrowCircleLeftIcon } from "@vue-hero-icons/outline"
export default {
     components: {ArrowCircleLeftIcon},
    data() {
        return {
            categories: [],
            form: {
                title: '',
                ref: '',
                price: '',
                stock: '',
                category_id: '',
                description: '',
                image: '',
                test: 'test',
            },
            selected: '',

        }
    },

    mounted() {
        this.getCategories()
        
    },
    
    methods: {

        async getCategories(){
            const categories = await this.$axios.$get('/api/categories');
            this.categories = categories
            //console.log(categories);
        },

        previewFiles(e) {
           // console.log(this.$refs.myFiles.files[0] instanceof File);
            this.form.image = e.target.files[0] 
            /* const fd = new FormData();
            fd.append('image', this.form.image, this.form.image.name)
            console.log('test',fd) */
            //console.log(this.form.image)
            //this.form.test = formData.append("image",e.target.files[0] ,e.target.files[0].name )
           
            

        },

        async addProduct(){
            const fd = new FormData();
            fd.append('image', this.form.image, this.form.image.name)
            //fd.append('image', this.form.image, this.form.image.name)
            fd.append('title', this.form.title)
            fd.append('ref', this.form.ref)
            fd.append('price', this.form.price)
            fd.append('stock', this.form.stock)
            fd.append('category_id', this.form.category_id)
            fd.append('description', this.form.description)


            await this.$axios.$post('/api/product', fd
                /* title : this.form.title,
                ref : this.form.ref,
                price : this.form.price,
                category_id : this.form.category_id, */
                )
                .then( resp => { console.log(resp)})
                .catch( err => { console.log(err)})
        } 
        /* async addProduct(){
            console.log(this.form.image)
           const formData = new FormData()
            formData.append("image",this.form.image ,this.form.image.name )
            console.log(formData)

            await this.$axios.$post('/api/product',formData)
                .then( resp => { console.log(resp)})
                .catch( err => { console.log(err)})
        } */
    }
}
</script>
<style >
    
</style>