<template>
<button @click="fastLoginHandler">
    <slot/>  <i v-if="message">{{ message }}</i>
</button>
</template>

<script>
import Cookies from 'js-cookie'
import { useLogin } from '@web-auth/webauthn-helper'
export default {
    name: "FastLogin",
    props: ['fastLogin', 'fastLoginDetails'],
    data() {
        return {
            message: null
        }
    },
    methods: {
        fastLoginHandler() {
            const token = Cookies.get('XSRF-TOKEN')

            useLogin({
                actionUrl: this.fastLogin,
                optionsUrl: this.fastLoginDetails,
                actionHeader: {
                    'x-xsrf-token': token
                },
            }, {
                'x-xsrf-token': token
            })().then(res => {
                // the user has been logged in
                console.log('fastLoginHandler res', res)
                this.message = 'Ок'
                // window.location.reload()
            }).catch(err => {
                console.error('fastLoginHandler err', err)
                this.message = 'Error'
            });
        }
    }
}
</script>

<style scoped>

</style>
