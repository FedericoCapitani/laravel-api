<template>

    <div>
        <banner-component></banner-component>

        <div class="container-fluid">
            <div class="row">
                <main class="col-12 col-md-9 col-lg-10">
                    <section class="posts py-5  ">
                        <div class="container">
                            <div class="row row-cols1 row-cols-sm-2 row-cols-md-3 g4">
                                <div class="col" v-for="post in postsResponse.data" :key="post.id">
                                    <div class="product card">
                                        <img :src="post.image" :alt="post.title">
                                        <div class="card-body">
                                            <h3>{{post.title}}</h3>
                                            <p>{{post.body}}</p>
                                        </div>
                                        <div class="card-footer">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="author" v-if="post.user">
                                                        <h4>Author</h4>
                                                        <p> {{post.user.name}} </p>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <span v-if="post.category"><strong>Category</strong>: {{post.category.name}} </span> | 

                                                    <div class="tags" v-if="post.length > 0">
                                                        <strong>Tags:</strong>
                                                        <ul>
                                                            <li v-for="tag in post.tags" :key="tag.id"> {{tag.name}} </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <nav aria-label="Page navigation">
                                <ul class="pagination justify-content-center">
                                    <li class="page-item">
                                        <a class="page-link" v-if="postsResponse.current_page > 1" href="#" aria-label="Previous" @click.prevent="getAllPosts(postsResponse.current_page - 1)">
                                            <span aria-hidden="true">&laquo;</span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                    </li>
                                    <li :class="{'page-item' : true, 'active': page == postsResponse.current_page}" v-for="page in postsResponse.last_page" :key="page.index">
                                        <a class="page-link" href="#" @click.prevent="getAllPosts(page)">{{page}}</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" v-if="postsResponse.current_page < postsResponse.last_page " href="#" aria-label="Next" @click.prevent="getAllPosts(postsResponse.current_page + 1)">
                                            <span aria-hidden="true">&raquo;</span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </section>
                </main>

                <aside class="bg-white p-2 col-12 col-md-3 col-lg-2">
                    <div class="categories">
                        <h4>Categories</h4>
                        <ul>
                            <li v-for="category in categories" :key="category.id">
                                {{category.name}}
                            </li>
                        </ul>
                    </div>
                    <div class="tags">
                        <h4>Tags</h4>
                        <ul>
                            <li v-for="tag in tags" :key="tag.id">
                                {{tag.name}}
                            </li>
                        </ul>
                    </div>
                </aside>
            </div>
        </div>


    </div>

</template>


<script>
import BannerComponent from '../components/BannerComponent';
export default {
    name: 'App',
    components: { BannerComponent },
    data() {
        return{
            postsResponse: '',
            categories: '',
            tags: ''
        }
    },
    methods: {
        getAllPosts(postPage){
            axios
        .get('/api/posts', {
            params: {
                page: postPage
            }
        })
        .then((response) => {
            console.log(response);
            this.postsResponse = response.data
        }).catch(e => {
            console.error(e);
        })
        },
        getAllCategories(){
            axios
            .get('/api/categories')
            .then(response => {
                console.log(response);
                this.categories = response.data
            })
            .catch(e => {
                console.error(e);
            })
        },
        getAllTags(){
            axios
            .get('/api/tags')
            .then(response => {
                console.log(response);
                this.tags = response.data
            })
            .catch(e => {
                console.error(e);
            })
        }
    },
    mounted(){
        console.log('mounted');
        this.getAllPosts(1);
        this.getAllCategories();
        this.getAllTags();
    }
}
</script>