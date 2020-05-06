<template>
  <section class="content">
    <div class="row justify-content-around">
        <div class="col-10">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Insertar Categorias</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="card card-dark">
                     <div class="card-header">
                        <h3 class="card-title">Nueva Categoría</h3>
                     </div>
              <!-- /.card-header -->
              <!-- form start -->
                    <form role="form" @click.prevent="addCategory()">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="categoryId">Nombre</label>
                                <input type="text" class="form-control" id="categoryId" 
                                v-model="form.nombre" name="nombre" placeholder="Escriba el nombre de la categoría"
                                  :class="{ 'is-invalid': form.errors.has('nombre') }">
                                  <has-error :form="form" field="nombre"></has-error>
                            </div>
                            <div class="form-group">
                                <label for="descripcionId">Descripción</label>
                                <input type="text" class="form-control" id="descripcionId" 
                                    v-model="form.descripcion"  name="descripcion"  placeholder="Escriba una breve descripción "
                                    :class="{ 'is-invalid': form.errors.has('descripcion') }" >
                                      <has-error :form="form" field="descripcion"></has-error>
                            </div>                            
                        </div>
                       <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-outline-dark">Guardar</button>
                        </div>
                    </form>
          
              </div>
                 
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
    </section>

    

</template>


<script>
export default {
    name:"New",
    data(){
            return{

                titulo:'Insertar Categoría',

                form: new Form({
                    nombre:'',
                    descripcion:''
                })
            }

    }, 
    methods:{
        addCategory(){
             this.form.post('/add-category')
                    .then((response)=>{
                       this.$router.push('/category-list')
                        toast.fire({
                            icon: 'success',
                            title: 'categoria insertada'
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