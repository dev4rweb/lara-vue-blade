<template>
<button @click="registerHandler">
    <slot/> <i v-if="message">{{ message }}</i>
</button>
</template>

<script>
import Cookies from 'js-cookie'
import { useRegistration } from '@web-auth/webauthn-helper'
export default {
    name: "FastRegistration",
    props: ['fastLoginCreate', 'fastLoginCreateDetails'],
    data() {
        return {
            message: null
        }
    },
    methods: {
        registerHandler() {
            const token = Cookies.get('XSRF-TOKEN')
            console.log('registerHandler token', token)

            useRegistration({
                actionUrl: this.fastLoginCreate,
                optionsUrl: this.fastLoginCreateDetails,
                actionHeader: {
                    'x-xsrf-token': token
                },
            }, {
                'x-xsrf-token': token
            })().then(res => {
                // credential has been added
                console.log('registerHandler', res)
                this.message = 'Запись успешно создана'
            }).catch(err => {
                console.error('registerHandler Error', err)
                this.message = 'Произошла ошибка'
            });
        }
    }
}
</script>

<style scoped>

</style>
