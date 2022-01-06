<template>
    <form @submit.prevent="submit">
        <input
            type="text"
            class="form-control mb-3"
            placeholder="title"
            v-model="title"
        >
        <input
            type="text"
            class="form-control mb-3"
            placeholder="body"
            v-model="body"
        >
        <button class="btn btn-success mb-3" type="submit">Create Post</button>
    </form>
</template>

<script>
import {mapMutations} from 'vuex'
export default {
    name: "PostForm",
    data() {
        return {
            title: '',
            body: ''
        }
    },
    methods: {
        ...mapMutations(['createPost']),
        submit() {
            this.createPost({
                id: Date.now(),
                title: this.title,
                body: this.body
            })
            this.title = this.body = ''
        }
    }
}
</script>

<style scoped>

</style>
