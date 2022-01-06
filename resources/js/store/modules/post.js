export default {
    actions: {
        // async fetchPosts(ctx, limit = 10) {
        async fetchPosts({commit, getters, dispatch}, limit = 10) {
            axios.get(`https://jsonplaceholder.typicode.com/posts?_limit=${limit}`)
                .then(res => {
                    console.log(res)
                    // ctx.commit('updatePosts', res.data)
                    commit('updatePosts', res.data)
                    dispatch('sayHello')
                }).catch(err => {
                console.log(err)
            });
        },
        sayHello() {

        }
    },
    mutations: {
        updatePosts(state, posts) {
            state.posts = posts
        },
        createPost(state, newPost) {
            state.posts.unshift(newPost)
        }
    },
    state: {
        posts: []
    },
    getters: {
        validPosts(state) {
            return state.posts.filter(p => {
                return p.title && p.body
            });
        },
        allPosts(state) {
            return state.posts
        },
        /*postsCount(state) {
            return state.posts.length
        },*/
        postsCount(state, getters) {
            // return getters.allPosts.length
            return getters.validPosts.length
        }
    },
}
