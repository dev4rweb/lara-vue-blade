<template>
    <div>
        <loading v-if="is_loading"/>
        <div class="form-group">
            <label>Search</label>
            <input
                class="form-control"
                type="search"
                v-model="search_name"
                @change="searching"
                @click="canceled"
            >
        </div>
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
        <p v-if="pagination">Found {{pagination.total}} users</p>
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
        <nav v-if="pagination" aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                <li
                    class="page-item"
                    v-for="link in pagination.links"
                    :class="{'active': link.active, 'disabled': link.url === null} "
                    @click="paginationClick(link)"
                >
                    <button
                        class="page-link"
                        v-if="link.label.includes('Previous')"
                        aria-label="Previous"
                    >
                        <span aria-hidden="true">
                            &laquo;
                        </span>
                    </button>

                    <button
                        class="page-link"
                        v-else-if="link.label.includes('Next')"
                        aria-label="Next"
                    >
                        <span aria-hidden="true">&raquo;</span>
                    </button>
                    <button v-else class="page-link">{{ link.label }}</button>
                </li>
            </ul>
        </nav>
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
            editedUser: null,
            search_name: '',
            is_loading: false,
            pagination: null,
            current_page: 1
        }
    },
    methods: {
        getAllUsers() {
            axios.get('/api/users')
                .then(res => {
                    console.log('getAllUsers res', res)
                    if (res.data.success) {
                        this.users = res.data.models.data
                    }
                })
                .catch(err => {
                    console.log('getAllUsers err', err.response.data)
                });
        },
        createUser() {
            console.log('create User', this.user)
            axios.post('/api/users', this.user)
                .then(res => {
                    console.log('createUser res', res)
                    if (res.data.success) {
                        this.users.push(res.data.model)
                        this.user.name = ''
                        this.user.email = ''
                    }
                })
                .catch(err => {
                    console.log('createUser err', err.response.data)
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
        },
        searching() {
            this.is_loading = true
            console.log('searching', this.search_name)
            axios.get(`/api/users?page=${this.current_page}&search_name=${this.search_name}&role_id=0`)
                .then(res => {
                    console.log('searching res', res)
                    if (res.data.success) {
                        this.users = res.data.models.data
                        this.pagination = res.data.models
                    }
                })
                .catch(err => {
                    console.log('getAllUsers err', err.response.data)
                })
                .finally(() => {
                    this.is_loading = false
                });
        },
        paginationClick(link) {
            // console.log('paginationClick', link)
            if (link.label.includes('Previous')) {
                if (link.url)
                    this.current_page--
                else return
            } else if (link.label.includes('Next')) {
                if (link.url)
                    this.current_page++
                else return
            } else {
                this.current_page = parseInt(link.label)
            }
            this.searching()
        },
        canceled() {
            console.log('cancel')
            this.getAllUsers()
        }
    },
    mounted() {
        this.searching()
    }
}
</script>

<style scoped>

</style>
