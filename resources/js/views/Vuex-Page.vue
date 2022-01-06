<template>
    <div>
<!--        https://youtu.be/c2SK1IlmYL8-->
        <h1>Vuex Page {{postsCount}}</h1>
        <PostForm/>
        <div
            class="card"
            v-for="post in validPosts"
            :key="post.id"
        >
            <h2>{{post.title}}</h2>
            <p>{{post.body}}</p>
        </div>
    </div>
</template>

<script>
import {mapGetters, mapActions} from 'vuex'
import PostForm from "../components/PostForm";
export default {
    name: "Vuex-Page",
    computed: mapGetters(['allPosts', 'postsCount', 'validPosts']),
    methods: mapActions(['fetchPosts']),
    mounted() {
        // this.$store.dispatch('fetchPosts')
        this.fetchPosts(7)
    },
    components: {
        PostForm
    }
    /*computed: {
        allPosts() {
            return this.$store.getters.allPosts
        }
    },*/
/*    data() {
        return {
            posts: []
        }
    },
    async mounted() {
        axios.get('https://jsonplaceholder.typicode.com/posts?_limit=50')
            .then(res => {
                console.log(res)
                this.posts = res.data
            }).catch(err => {
            console.log(err)
        });
    }*/
}
</script>

<style scoped>

</style>
