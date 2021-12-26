<template>
    <div>
        <form v-if="!editedUser" @submit.prevent="createUser">
            <div class="form-group">
                <label>User Name</label>
                <input
                    type="text"
                    v-model="user.name"
                    class="form-control"
                    placeholder="name">
            </div>
            <div class="form-group">
                <label>User Email</label>
                <input
                    type="email"
                    v-model="user.email"
                    class="form-control"
                    placeholder="email">
            </div>
            <button type="submit" class="btn btn-primary">Add</button>
        </form>
        <form v-if="editedUser" @submit.prevent="updateUser">
            <div class="form-group">
                <label>User Name</label>
                <input
                    type="text"
                    v-model="editedUser.name"
                    class="form-control"
                    placeholder="name">
            </div>
            <div class="form-group">
                <label>User Email</label>
                <input
                    type="email"
                    v-model="editedUser.email"
                    class="form-control"
                    placeholder="email">
            </div>
            <button type="submit" class="btn btn-warning">Change</button>
            <button type="button" @click="backToCreating" class="btn btn-info">Back</button>
        </form>
        <p>Found {{users.length}} users</p>
        <ul class="list-group">
            <li
                class="list-group-item d-flex justify-content-between align-items-center"
                v-for="user in users"
            >
                <p @click="showUser(user)">{{ user.name }}</p>
                <button
                    class="btn btn-danger"
                    @click="removeUser(user)"
                >
                    &times;
                </button>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    name: "Users",
    data() {
       return {
           users: [],
           user: {
               name: 'userB',
               email: 'b@gmail.com',
               password: 'password'
           },
           editedUser: null
       }
    },
    methods: {
        getAllUsers() {
            axios.get('/api/users')
                .then(res => {
                    console.log('getAllUsers res',res)
                    if (res.data.success) {
                        this.users = res.data.models
                    }
                })
                .catch(err => {
                    console.log('getAllUsers err',err.response.data)
                });
        },
        createUser() {
            console.log('create User', this.user)
            axios.post('/api/users', this.user)
                .then(res => {
                    console.log('createUser res',res)
                    if (res.data.success) {
                        this.users.push(res.data.model)
                        this.user.name = ''
                        this.user.email = ''
                    }
                })
                .catch(err => {
                    console.log('createUser err',err.response.data)
                });
        },
        showUser(user) {
            console.log('show User', user)
            this.editedUser = user
            axios.get(`/api/users/${user.id}`)
                .then(res => {
                    console.log('showUser res', res)
                })
                .catch(err => {
                    console.log('showUser err', err.response.data)
                });
        },
        updateUser() {
            console.log('update User', this.editedUser)
            axios.post(`/api/users/${this.editedUser.id}`, {
                _method: 'PUT',
                name: this.editedUser.name,
                email: this.editedUser.email
            }).then(res => {
                console.log('updateUser res', res)
                if (res.data.success) {
                    const updatedUser = res.data.model
                    const filterUsers = this.users.filter(i => i.id !== updatedUser.id)
                    filterUsers.push(updatedUser)
                    this.users = filterUsers
                    this.editedUser = null
                }
            }).catch(err => {
                console.log('updateUser err', err)
            });
        },
        removeUser(user) {
            console.log('removeUser', user)
            axios.post(`/api/users/${user.id}`, {
                _method: 'DELETE'
            }).then(res => {
                console.log('removeUser res', res)
                if (res.data.success) {
                    const removedUserId = res.data.id
                    this.users = this.users.filter(i => i.id !== parseInt(removedUserId))
                }
            }).catch(err => {
                console.log('removeUser err', err.response.data)
            });
        },
        backToCreating() {
            console.log('backToCreating')
            this.editedUser = null
        }
    },
    mounted() {
        this.getAllUsers()
    }
}
</script>

<style scoped>

</style>
