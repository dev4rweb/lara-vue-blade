<template>
<!--    https://youtu.be/OlnwgS-gk8Y?t=2666-->
    <div>
        <AddTodo
            @add-todo="addTodo"
        />
        <hr>
        <router-view />
        <hr>
        <Loader v-if="loading"/>
        <TodoList
            v-else-if="todos.length"
            :todos="todos"
            @remove-item="removeTodo"
        />
        <h3 v-else>No Items</h3>
    </div>
</template>

<script>
import TodoList from './TodoList'
import AddTodo from "./AddTodo";
import Loader from "./Loader";
export default {
    name: "Todo",
    data() {
        return {
            todos: [
                {id: 1, title: 'Buy bread', completed: false},
                {id: 2, title: 'Buy milk', completed: false},
                {id: 3, title: 'Buy baer', completed: false},
            ],
            loading: true
        }
    },
    methods: {
        removeTodo(id) {
            this.todos = this.todos.filter(t => t.id !== id)
        },
        addTodo(item) {
            // console.log('addTodo', item)
            this.todos.push(item)
        }
    },
    mounted() {
        fetch('https://jsonplaceholder.typicode.com/todos?_limit=5')
            .then(response => response.json())
            .then(json => {
                console.log(json)
                this.todos = json
                this.loading = false
            });
    },
    components: {
        TodoList,
        AddTodo,
        Loader
    }
}
</script>

<style scoped>

</style>
