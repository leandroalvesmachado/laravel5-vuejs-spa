<template>
    <site-template>
        <span slot="menuesquerdo">
            <img src="https://www.designerd.com.br/wp-content/uploads/2013/06/criar-rede-social.png" alt="" class="responsive-img">
        </span>
        <span slot="principal">
            <h2>Perfil</h2>
            <input type="text" placeholder="Nome" v-model="name">
            <input type="text" placeholder="E-mail" v-model="email">
            <div class="file-field input-field">
                <div class="btn">
                    <span>Imagem</span>
                    <input type="file">
                </div>
                <div class="file-path-wrapper">
                    <input type="text" class="file-path validate">
                </div>
            </div>
            <input type="password" placeholder="Senha" v-model="password">
            <input type="password" placeholder="Confirme sua senha" v-model="password_confirmation">
            <button type="button" class="btn" @click="perfil">Atualizar</button>
        </span>
    </site-template>
</template>

<script>

import SiteTemplate from '@/templates/SiteTemplate';
import axios from 'axios';

export default {
    name: 'Perfil',
    components: {
        SiteTemplate
    },
    data () {
        return {
            usuario: false,
            name: '',
            email: '',
            password: '',
            password_confirmation: ''
        }
    },
    created() {
        // quando o componente é criado ciclo de vida
        let usuarioAux = sessionStorage.getItem('usuario');

        if (usuarioAux) {
            // pega a string e transforma em json
            this.usuario = JSON.parse(usuarioAux);
            this.name = this.usuario.name;
            this.email = this.usuario.email;
        }
    },
    methods: {
        perfil() {
            axios.put(`http://localhost:8000/api/perfil`, 
                {
                    name: this.name,
                    email: this.email,
                    password: this.password,
                    password_confirmation: this.password_confirmation
                },
                {
                    "headers": { "authorization": `Bearer ${this.usuario.token}` }
                }
            )
            .then(response => {
                if (response.data.token) {
                    sessionStorage.setItem('usuario', JSON.stringify(response.data));
                    console.log('atualziado');
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
                 alert('Erro, tente novamente mais tarde');
            });
        }
    }
}
</script>

<style scoped>
</style>
