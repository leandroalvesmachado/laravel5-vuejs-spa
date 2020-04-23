<template>
    <login-template>
        <h2>Login</h2>
        <input type="text">
        <input type="text">
    </login-template>
</template>

<script>

import LoginTemplate from '@/templates/LoginTemplate';

export default {
    name: 'Login',
    components: {
        LoginTemplate
    },
    data () {
        return {
        }
    }
}
</script>

<style scoped>
</style>
