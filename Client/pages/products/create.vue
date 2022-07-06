<template >
   <div class="container mx-auto bg-green-200 flex flex-col justify-center items-center">
       <form action="" method="post" class="space-y-4" enctype="multipart/form-data" @submit.prevent="addProduct" >

           <div class="title">
               <label for="title">Title</label>
               <input name="title" type="text" v-model="form.title" placeholder="title..." class="border-2 border-gray-300 rounded-lg">
           </div>

           <div class="reference">
               <label for="reference">Reference</label>
               <input type="number" v-model="form.ref" name="ref" id="ref" placeholder="reference..." class="border-2 border-gray-300 rounded-lg">
           </div>

           <div class="price">
               <label for="price">Price</label>
               <input type="number" v-model="form.price" name="price" id="price" placeholder="price..." class="border-2 border-gray-300 rounded-lg">
           </div>
           <div class="stock">
               <label for="stock">Stock</label>
               <input type="number" v-model="form.stock" name="stock" id="stock" placeholder="stock..." class="border-2 border-gray-300 rounded-lg">
           </div>

           <div class="category">
               <label for="category">Category:</label>
               <select v-model="form.category_id">
                    <option v-for="category in categories" :value="category.id">
                        {{ category.label}}
                    </option>
                </select>
           </div>

           <div class="description flex flex-col">
               <label for="description">Description</label>
               <textarea name="description" v-model="form.description" id="" cols="20" rows="10"></textarea>
           </div>

           <div class="image">
               <label for="image">Image</label>
               <input type="file"  id="image" ref="myFiles" name="image" v-on:change="previewFiles" >
           </div>
          
          <button type="submit" class="my-3 bg-red-200 px-4 text-white rounded-lg"> Create </button>
           
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