<template>
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-around">
                <!-- left column -->
                <div class="col-md-10">
                    <!-- general form elements -->
                    <div class="card card-dark">
                        <div class="card-header">
                            <h3 class="card-title">Editar Categoría</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" @submit.prevent="updateCategory()">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="categoryId">Nombre Categoría</label>
                                    <input type="text" class="form-control" id="categoryId" placeholder="Nueva categoría" v-model="form.cat_nombre" name="cat_nombre" :class="{ 'is-invalid': form.errors.has('cat_nombre') }">
                                    <has-error :form="form" field="cat_nombre"></has-error>
                                </div>
                                 <div class="form-group">
                                    <label for="categoryId">Descripción Categoría</label>
                                    <input type="text" class="form-control" id="categoryId" placeholder="Nueva categoría" v-model="form.cat_descripcion" name="cat_descripcion" :class="{ 'is-invalid': form.errors.has('cat_descripcion') }">
                                    <has-error :form="form" field="cat_descripcion"></has-error>
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
        mounted(){
            axios.get(`/editcategory/${this.$route.params.categoryid}`)
                .then((response)=>{
                    this.form.fill(response.data.category)
                })
        },
        data(){
            return {
                form: new Form({
                    cat_nombre:'',
                    cat_descripcion:''
                })
            }
        },
        methods:{
            updateCategory(){
                this.form.post(`/update-category/${this.$route.params.categoryid}`)
                    .then((response)=>{
                        this.$router.push('/category-list')
                         toast.fire({
                            icon: 'success',
                            title: 'categoria eliminada'
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