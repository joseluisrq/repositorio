<template>
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-around">
                <!-- left column -->
                <div class="col-md-10">
                    <!-- general form elements -->
                    <div class="card card-dark">
                        <div class="card-header">
                            <h3 class="card-title">Actualizar Post</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" enctype="multipart/form-data" @submit.prevent="updatePost()">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="postId">Titulo </label>
                                    <input type="text" class="form-control" id="postId" placeholder="Add New Post" v-model="form.titulo" name="titulo" :class="{ 'is-invalid': form.errors.has('titulo') }">
                                    <has-error :form="form" field="titulo"></has-error>
                                </div>
                                <div class="form-group">
                                    <label for="descriptionId">Descripción</label>

                                    <markdown-editor v-model="form.descripcion"></markdown-editor>

                                    <has-error :form="form" field="descripcion"></has-error>
                                </div>

                                <div class="form-group" >
                                    <label>Categoría</label>
                                    <select class="form-control" :class="{ 'is-invalid': form.errors.has('cat_id') }" v-model="form.cat_id">
                                        <option disabled value="">Seleccione categoría</option>
                                        <option :value="category.id" v-for="category in getallCategory" :key="category.id">{{category.cat_nombre}}</option>

                                    </select>
                                    <has-error :form="form" field="cat_id"></has-error>
                                </div>
                                <div class="form-group" >
                                    <input @change = "changePhoto($event)" name="foto" type="file" :class="{ 'is-invalid': form.errors.has('foto') }">
                                    <img :src="updateImage()" alt="" width="80" height="80">
                                    <has-error :form="form" field="foto"></has-error>
                                </div>

                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-outline-dark">Actualizar</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->

                </div>

            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
</template>

<script>
    export default {
        name: "Edit",
        data(){
            return{
                form: new Form({
                    titulo:'',
                    descripcion:'',
                    cat_id:'',
                    foto:'',
                })
            }
        },
        mounted(){
            this.$store.dispatch("allCategory")
        },
        created(){
            axios.get(`post/${this.$route.params.postid}`)
                .then((response)=>{
                  //  console.log(response.data)
                    this.form.fill(response.data.post)
                })

        },
        computed:{
            getallCategory(){
                return this.$store.getters.getCategory
            }
        },
        methods:{
            changePhoto(event){
                let file = event.target.files[0];

                if(file.size>1048576){
                    swal({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!',
                        footer: '<a href>Why do I have this issue?</a>'
                    })
                }else{
                    let reader = new FileReader();
                    reader.onload = event => {
                        this.form.foto = event.target.result
                       // console.log(event.target.result)
                    };
                    reader.readAsDataURL(file);
                }

            },
            updatePost(){
                this.form.post(`update/${this.$route.params.postid}`)
                    .then(()=>{
                        this.$router.push('/post-list')
                        toast({
                            type: 'success',
                            title: 'Post Updated successfully'
                        })
                    })
                    .catch(()=>{

                    })
            },
            updateImage(){
                let img = this.form.foto;
                if(img.length>100){
                    return  this.form.foto
                }else{
                    return `uploadimage/${this.form.foto}`
                }

            }
        }

    }
</script>

<style scoped>

</style>