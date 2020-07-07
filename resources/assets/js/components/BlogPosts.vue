<template>
        <div class="blog-section">
                <div class="container">
                    <h1 class="text-center">From Our Blog</h1>
    
                    <p class="section-description text-center" >Ako volite sebe i svoje najbliže, na pravoj ste adresi.</p>
    
                    <div class="blog-posts">
                    
                        <div v-for="post in posts" class="blog-post" :key="post.id" >
                              <a :href="post.link"><blog-image :url="post._links['wp:featuredmedia'][0].href"></blog-image></a>
                            <a :href="post.link"><h2 class="blog-title">{{post.title.rendered}}</h2></a>
                            <div class="blog-description">{{ stripTags(post.excerpt.rendered) }}</div>
                        </div>
        
                    </div>
                </div> <!-- end container -->
            </div> <!-- end blog-section -->
    
</template>

<script>
import sanitizeHtml from 'sanitize-html'
import BlogImage from './BlogImage'

export default {

    components:{
        BlogImage,
        },
   
    created(){
        axios.get('http://localhost/testsite/wp-json/wp/v2/posts?per_page=3')
                .then(response=>{
                    //console.log(response);
                    this.posts=response.data
                })
    },
    data(){
        return{
            posts:[]
        }
    },
   methods: {
        stripTags(html) {
            return sanitizeHtml(html, {
                allowedTags: []
            }).substring(0, html.indexOf('&hellip;'))
        }
    }
}
</script>