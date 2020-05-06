<template>
    <span id="sidebar">
        <aside class="right-sidebar">
                <div class="widget">
                     <form class="form-search">
                        <input @keyup="RealSearch" placeholder="Escribe lo que buscas" v-model="keyword" type="text" class="input-medium search-query">
                        <button type="submit" @click.prevent="RealSearch" class="btn btn-square btn-theme">Buscar</button>
                    </form>
                  
                </div>
                <div class="widget">
                    <h5 class="widgetheading">Categorias</h5>
                     <ul class="cat">
                         <li v-for="category in allcategories" :key="category.id">
                                <i class="icon-angle-right"></i>
                                <router-link :to="`/categories/${category.id}`">{{category.cat_nombre}}</router-link>
                                <span> (20)</span>
                        </li>
                     </ul>
                </div>
                <div class="widget">
                    <h5 class="widgetheading">Últimas Publicaciones</h5>
                    <ul class="recent">
                     <li v-for="(post,index) in blogpost"  :key="post.id" v-if="index<5" >
                        <img :src="`uploadimage/${post.foto}`" class="pull-left" alt="" width="40" height="40"/>
                        <h6><router-link :to="`/blog/${post.id}`">{{post.titulo}}</router-link></h6>
                        <p>
                        {{post.descripcion | sortlength(100,"....")}}
                        </p>
                    </li>
                    </ul>
                </div>
              
        </aside>
    </span>
</template>

<script>
  import _ from 'lodash'
   export default {
        name: "BlogSidebar",
        data(){
           return {
               keyword:''
           }
        },
        computed:{
            allcategories(){
                return this.$store.getters.allcategories;
            },
            blogpost(){
                return this.$store.getters.latestpost
            }
        },
        mounted(){
            this.$store.dispatch('latestPost');
            this.$store.dispatch('allcategories')
        },
        methods:{
            RealSearch:_.debounce(function () {
                this.$store.dispatch('SearchPost',this.keyword);
            },1000)
        }
    }
</script>

<style>

</style>