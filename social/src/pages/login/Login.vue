<template>
    <login-template>
        <span slot="menuesquerdo">
            <img src="https://www.designerd.com.br/wp-content/uploads/2013/06/criar-rede-social.png" alt="" class="responsive-img">
        </span>
        <span slot="principal">
            <h2>Login</h2>
            <input type="text" placeholder="E-mail" v-model="email">
            <input type="password" placeholder="Senha" v-model="password">
            <button type="button" class="btn" @click="login">Entrar</button>
            <router-link class="btn orange" to="/cadastro">Cadastre-se</router-link>
        </span>
    </login-template>
</template>

<script>

import LoginTemplate from '@/templates/LoginTemplate';
import axios from 'axios';

export default {
    name: 'Login',
    components: {
        LoginTemplate
    },
    data () {
        return {
            email: '',
            password: ''
        }
    },
    methods: {
        login() {
            axios.post(`http://localhost:8000/api/login`, {
                email: this.email,
                password: this.password
            })
            .then(response => {
                console.log(response);
                if (response.data.token) {
                    // login com sucesso
                } else if (response.data.status == false) {
                    // login não existe
                    alert('Login inválido');
                } else {
                    // erros de validação
                    let erros = '';
                    for (let erro of Object.values(response.data)) {
                        erros += erro + " ";
                    }
                    
                    alert(erros);
                }
            })
            .catch(e => {
                console.log(e);
            });
        }
    }
}
</script>

<style scoped>
</style>
