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
            this.$http.post(`${this.$urlApi}/login`, {
                email: this.email,
                password: this.password
            })
            .then(response => {
                console.log(response);
                if (response.data.status) {
                    // login com sucesso
                    // criando sessão
                    // session storage, se o usuario fechar o navegador, perder a sessao
                    // local storage, mesmo fechando, fica salvo
                    this.$store.commit('setUsuario', response.data.usuario);
                    sessionStorage.setItem('usuario', JSON.stringify(response.data.usuario));
                    this.$router.push('/');
                } else if (response.data.status == false && response.data.validacao) {
                    // erros de validação
                    let erros = '';
                    for (let erro of Object.values(response.data.erros)) {
                        erros += erro + " ";
                    }

                    alert(erros);
                } else {
                    // login não existe
                    console.log('Login não existe');
                }
            })
            .catch(e => {
                console.log(e);
                 alert('Erro, tente novamente mais tarde');
            });
        }
    }
}
</script>

<style scoped>
</style>
