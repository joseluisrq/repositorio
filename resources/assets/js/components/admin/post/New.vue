<template>
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-around">
                <!-- left column -->
                <div class="col-md-10">
                    <!-- general form elements -->
                    <div class="card card-dark">
                        <div class="card-header">
                            <h3 class="card-title">Insertar nuevo Post</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" enctype="multipart/form-data" @submit.prevent="addnewPost()">
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="postId">Título </label>
                                    <input type="text" class="form-control" id="postId" placeholder="Nuevo Post" 
                                    v-model="form.titulo" name="titulo" :class="{ 'is-invalid': form.errors.has('titulo') }">
                                    <has-error :form="form" field="titulo"></has-error>
                                </div>

                                <div class="form-group">
                                    <label for="descripcionId">Post</label>
                                    <markdown-editor v-model="form.descripcion"></markdown-editor>
                                    <has-error :form="form" field="descripcion"></has-error>
                                </div>

                                <div class="form-group" >
                                    <label>Selecionar</label>
                                    <select class="form-control" :class="{ 'is-invalid': form.errors.has('cat_id') }" v-model="form.cat_id">
                                        <option disabled value="">Seleccione Categoría</option>
                                        <option :value="category.id" v-for="category in getallCategory" :key="category.id"> {{category.cat_nombre}}</option>

                                    </select>
                                    <has-error :form="form" field="cat_id"></has-error>
                                </div>
                                <div class="form-group" >
                                    <input @change = "changePhoto($event)" name="foto" type="file" :class="{ 'is-invalid': form.errors.has('foto') }">
                                   <br> <img :src="form.foto" alt="" width="250" >
                                    <has-error :form="form" field="foto"></has-error>
                                </div>

                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-outline-dark">Guardar</button>
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
        name: "New",
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
                         text: 'Algo salio mal',
                         footer: '<a href>¿Por qué tengo este problema?</a>'
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
            addnewPost(){
                this.form.post('/savepost')
                    .then(()=>{
                        this.$router.push('/post-list')
                        toast.fire({
                            icon: 'success',
                            title: 'Post insertado'
                          })
                    })
                    .catch(()=>{

                    })
            }
        }

    }
</script>

<style scoped>

</style>