<template>
    <login-template>
        <span slot="menuesquerdo">
            <img src="https://www.designerd.com.br/wp-content/uploads/2013/06/criar-rede-social.png" alt="" class="responsive-img">
        </span>
        <span slot="principal">
            <h2>Cadastro</h2>
            <input type="text" placeholder="Nome" v-model="name">
            <input type="text" placeholder="E-mail" v-model="email">
            <input type="password" placeholder="Senha" v-model="password">
            <input type="password" placeholder="Confirme sua senha" v-model="password_confirmation">
            <button type="button" class="btn" @click="cadastro">Enviar</button>
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
            name: '',
            email: '',
            password: '',
            password_confirmation: ''
        }
    },
    methods: {
        cadastro() {
            this.$http.post(`${this.$urlApi}/cadastro`, {
                name: this.name,
                email: this.email,
                password: this.password,
                password_confirmation: this.password_confirmation,
            })
            .then(response => {
                console.log(response);
                if (response.data.status) {
                    // login com sucesso
                    // criando sessão
                    // session storage, se o usuario fechar o navegador, perder a sessao
                    // local storage, mesmo fechando, fica salvo
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
                    alert('Erro no cadastro');
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
