<template>
    <login-template>
        <span slot="menuesquerdo">
            <img src="https://www.designerd.com.br/wp-content/uploads/2013/06/criar-rede-social.png" alt="" class="responsive-img">
        </span>
        <span slot="principal">
            <h2>Cadastro</h2>
            <input type="text" placeholder="Nome" value="">
            <input type="text" placeholder="E-mail" value="">
            <input type="password" placeholder="Senha" value="">
            <input type="password" placeholder="Confirme sua senha" value="">
            <button type="button" class="btn">Enviar</button>
            <router-link class="btn orange" to="/login">Já tenho conta</router-link>
        </span>
    </login-template>
</template>

<script>

import LoginTemplate from '@/templates/LoginTemplate';

export default {
    name: 'Cadastro',
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
