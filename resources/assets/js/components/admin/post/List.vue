<template>
    <div>
        <section class="content">
            <div class="row justify-content-around" >
                <div class="col-12 ">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Lista de Posts</h3>

                            <div class="card-tools">                             
                                <router-link to="/add-post" >  
                                     <button class="btn btn-outline-primary"> Insertar Post </button>
                                </router-link>                             
                            </div>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover table-responsive">
                                <thead>
                                <tr>

                                    <th>#</th>
                                    <th>Usuario</th>
                                    <th>Categoría</th>
                                    <th>Título</th>
                                    <th>Descripción</th>
                                    <th>Foto</th>
                                    <th>Opciones</th>

                                </tr>
                                </thead>
                                <tbody>

                                <tr v-for="(post,index) in allpost" :key="post.id">
                                    <td>{{index+1}}</td>
                                    <td v-if="post.user">{{post.user.name}}</td>
                                    <td v-else></td>
                                    <td v-if="post.category">{{post.category.cat_nombre}}</td>
                                     <td v-else></td>
                                    <td>{{post.titulo | sortlength(40,"---")}}</td>
                                    <td>{{post.descripcion | sortlength(40,"....")}}</td>
                                    <td><img :src="ourImage(post.foto)" alt="" width="40" height="50"></td>
                                    <td>
                                        <router-link :to="`edit-post/${post.id}`"><span class="badge bg-warning"><i class="fas fa-edit"></i> Editar</span></router-link>
                                        <a href="" @click.prevent = "deletePost(post.id)" ><span class="badge bg-danger"><i class="far fa-trash-alt"></i> Eliminar</span></a>

                                    </td>
                                </tr>
                                </tbody>


                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
</template>

<script>
    export default {
        name: "List",
        mounted(){
            this.$store.dispatch('gelAllPost')
        },
        computed:{
            allpost(){
                return this.$store.getters.getAllPost
            }
        },
        methods:{
            ourImage(img){
                return "uploadimage/"+img;
            },
            deletePost(id){
               axios.get('/delete/'+id)
                   .then(()=>{
                       this.$store.dispatch('gelAllPost')
                        toast.fire({
                            icon: 'success',
                            title: 'Post Eliminado'
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