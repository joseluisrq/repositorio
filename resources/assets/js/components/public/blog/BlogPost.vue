<template>
    <span id="blogpost">
         <!-- end header -->
    <section id="inner-headline">
      <div class="container">
        <div class="row">
          <div class="span4">
            <div class="inner-heading">
              <h2>Publicaciones</h2>
            </div>
          </div>
          <div class="span8">
            <ul class="breadcrumb">
              <li><a href="#"><i class="icon-home"></i></a><i class="icon-angle-right"></i></li>
              <li><a href="#">Publicaciones</a><i class="icon-angle-right"></i></li>
             
            </ul>
          </div>
        </div>
      </div>
    </section>
    <section id="content">
      <div class="container">
        <div class="row">
          <div class="span8">

            <article v-for="post in blogpost" :key="post.id">
              <div class="row">
                <div class="span8">
                  <div class="post-image">
                    <div class="post-heading">
                      <h3>  <router-link :to="`/blog/${post.id}`">{{post.titulo}}</router-link></h3>
                    </div>
                    <img :src="`uploadimage/${post.foto}`" alt="" />
                  </div>
                  <p>
                   {{post.descripcion | sortlength(500,"...")}}
                  </p>
                  <div class="bottom-article">
                    <ul class="meta-post">
                      <li><i class="icon-calendar"></i><a href="#"> {{post.created_at}}</a></li>
                      <li v-if="post.user"><i class="icon-user"></i><a href="#">{{post.user.name}}</a></li>
                      <li v-if="post.category"><i class="icon-folder-open"></i><a href="#"> {{post.category.cat_nombre}}</a></li>
                      <li><i class="icon-comments"></i><a href="#">4 Comments</a></li>
                    </ul>
                    <router-link :to="`/blog/${post.id}`" class="pull-right">Continuar leyendo <i class="icon-angle-right"></i></router-link>
                  </div>
                </div>
              </div>
            </article>

            <div id="pagination">
              <span class="all">Page 1 of 3</span>
              <span class="current">1</span>
              <a href="#" class="inactive">2</a>
              <a href="#" class="inactive">3</a>
            </div>
          </div>
          <div class="span4">
              <BlogSidebar/>
          </div>
         
        </div>
      </div>
    </section>
    </span>
</template>

<script>
    import BlogSidebar from "./BlogSidebar.vue"
    export default {
        name: "BlogPost",
        components:{
            BlogSidebar
        },
        mounted(){
            this.$store.dispatch('getblogPost');
        },
        computed:{
            blogpost(){
                return this.$store.getters.getblogPost
            }
        },
        methods:{
            getAllCategoryPost(){
                if(this.$route.params.id!=null){
                    this.$store.dispatch('getPostByCatId',this.$route.params.id);
                }else{
                    this.$store.dispatch('getblogPost');
                }

            }
        },
        watch:{
            $route(to,from){
                this.getAllCategoryPost();
            }
        }
    }
</script>

<style scoped>
</style>