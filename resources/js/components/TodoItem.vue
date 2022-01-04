<template>
    <li class="list-group-item d-flex justify-content-between align-items-center">
        <span
            class="d-flex justify-content-between align-items-center"
            :class="{done: todo.completed}"
        >
            <input
                class="me-1"
                type="checkbox"
                @change="todo.completed = !todo.completed"
            >
            <strong class="me-1">{{index + 1}}</strong>
            {{todo.title | uppercase}}
        </span>
        <button
            class="btn btn-sm btn-outline-danger rounded-circle"
            @click="$emit('remove-todo', todo.id)"
        >
            &times;
        </button>
    </li>
</template>

<script>
export default {
    name: "TodoItem",
    props: {
        todo: {
            type: Object,
            required: true
        },
        index: Number
    },
    filters: {
        uppercase(value) {
            // console.log(value)
            return value.toUpperCase()
        }
    }
}
</script>

<style scoped>
.done {
    text-decoration: line-through;
}
</style>
