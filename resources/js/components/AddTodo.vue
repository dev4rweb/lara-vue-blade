<template>
    <form
        class="d-flex justify-content-between align-items-center"
        @submit.prevent="onSubmit"
    >
        <div class="form-group w-75">
            <input
                type="text"
                class="form-control"
                v-model="title"
            >
        </div>
        <button
            type="submit"
            class="btn btn-primary"
        >
            Create
        </button>
    </form>
</template>

<script>
export default {
    name: "AddTodo",
    data() {
        return {
            title: ''
        }
    },
    methods: {
        onSubmit() {
            console.log('Submit', this.title)
            if (this.title.trim()) {
                const todo = {
                    id: Date.now(),
                    title: this.title,
                    completed: false
                }

                this.$emit('add-todo', todo)
                this.title = ''
            }
        }
    }
}
</script>

<style scoped>

</style>
