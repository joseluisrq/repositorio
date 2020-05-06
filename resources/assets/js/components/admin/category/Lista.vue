<template>
  <section class="content">
      <div class="row justify-content-around">
        <div class="col-11">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Categorias</h3>
              <div class="card-tools">
                    <router-link to="/add-category"  class="nav-link">
                        <button class="btn btn-outline-dark">Insertar Categoria</button>
                    </router-link>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
             <table class="table table-bordered  table-responsive">
                  <thead>                  
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Categoría</th>
                      <th>Descripción</th>
                      <th style="width: 150px">Fecha</th>
                      <th>Opciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(cat,index) in getallCategory" :key="cat.id">
                      <td>{{index+1}}</td>
                      <td>{{cat.cat_nombre}}</td>
                      <td>
                        {{cat.cat_descripcion}}
                       
                      </td>
                      <td>
                        {{cat.created_at | timeformat}}
                       
                      </td>
                      <td>
                         <span class="badge bg-warning"> <router-link :to="`/edit-category/${cat.id}`">Editar</router-link></span>
                            <a href="" @click.prevent="deleteCategory(cat.id)">  <span class="badge bg-danger">Eliminar</span></a>
                       </td>
                    </tr>
               
                  </tbody>
                </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

        
        
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
</template>

<script>
export default {
    name:'Lista',

    data(){
        return{
            categoryItem:[],
            select:'',
            all_select:false
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
          selectAll(){
                if(this.all_select==false){
                    this.all_select = true
                    for(var category in this.getallCategory){
                        this.categoryItem.push(this.getallCategory[category].id)
                    }
                }else{
                    this.all_select = false
                    this.categoryItem = []
                }


            },
               deleteCategory(id){
               axios.get('/category/'+id)
                   .then(()=>{
                       this.$store.dispatch("allCategory")
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

<style>

</style>