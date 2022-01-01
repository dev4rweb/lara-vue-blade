<template>
    <ul class="list-group">
        <TodoItem
            v-for="(todo, i) in todos"
            :todo="todo"
            :index="i"
            :key="todo.id"
            @remove-todo="removeTodo"
        />
    </ul>
</template>

<script>
import TodoItem from "./TodoItem";
export default {
    name: "TodoList",
    props: ['todos'],
    components: {
        TodoItem
    },
    methods: {
        removeTodo(id) {
            console.log('removeTodo', id)
            this.$emit('remove-item', id)
        }
    }
}
</script>

<style scoped>

</style>
