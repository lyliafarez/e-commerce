<template>
    <div class="container mx-auto  flex flex-col  space-y-4">
       <div class="mx-12 flex flex-row jutify-center space-x-3">
         <nuxt-link to="/products/" class="text-blue-400 text-left">back</nuxt-link>
        </div>
       <form action="" method="post" class="flex flex-col space-y-4 justify-center items-center " enctype="multipart/form-data" @submit.prevent="editProduct" >
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
export default {
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
               
            },
            selected: '',
        }
    },
    mounted() {
        this.getCategories()
        this.getProduct()
    },
    methods:{
        async getCategories(){
            const categories = await this.$axios.$get('/api/categories');
            this.categories = categories
            console.log(this.categories)
            
        },

        previewFiles(e) {
            this.form.image = e.target.files[0] 

        },
        async getProduct(){
            const product = await this.$axios.$get(`/api/product/${this.$route.params.id}`)
            console.log(product)
            this.form.title = product.title
            this.form.ref = product.ref
            this.form.price = product.price
            this.form.stock = product.stock
            this.category_id = product.category_id
            this.description = product.description
        },

        async editProduct(){
            const fd = new FormData();
            //fd.append('image', this.form.image, this.form.image.name)
            fd.append('title', this.form.title)
            fd.append('ref', this.form.ref)
            fd.append('price', this.form.price)
            fd.append('stock', this.form.stock)
            fd.append('category_id', this.form.category_id)
            fd.append('description', this.form.description)
            const resp = await this.$axios.$put(`/api/product/${this.$route.params.id} `,fd);
            console.log(resp)

        }
    }
}
</script>
<style>
    
</style>