<template>
<!--    https://youtu.be/OlnwgS-gk8Y?t=2666-->
    <div>
        <AddTodo
            @add-todo="addTodo"
        />
        <select v-model="filter">
            <option value="all">All</option>
            <option value="completed">completed</option>
            <option value="not-completed">not completed</option>
        </select>
        <hr>
        <router-view />
        <hr>
        <Loader v-if="loading"/>
<!--        <TodoList
            v-else-if="todos.length"
            :todos="todos"
            @remove-item="removeTodo"
        />-->
        <TodoList
            v-else-if="filteredTodos.length"
            :todos="filteredTodos"
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
            loading: true,
            filter: 'all'
        }
    },
    /*watch: {
        filter(value) {
            console.log(value)
        }
    },*/
    computed: {
        filteredTodos() {
            if (this.filter === 'all') {
                return this.todos
            }
            if(this.filter === 'completed')
                return this.todos.filter(t => t.completed)

            if(this.filter === 'not-completed')
                return this.todos.filter(t => !t.completed)
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
