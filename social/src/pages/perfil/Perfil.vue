<template>
    <site-template>
        <span slot="menuesquerdo">
            <img :src="usuario.imagem" alt="" class="responsive-img">
        </span>
        <span slot="principal">
            <h2>Perfil</h2>
            <input type="text" placeholder="Nome" v-model="name">
            <input type="text" placeholder="E-mail" v-model="email">
            <div class="file-field input-field">
                <div class="btn">
                    <span>Imagem</span>
                    <input type="file" @change="salvaImagem">
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
            password_confirmation: '',
            imagem: ''
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
        salvaImagem(e) {
            let arquivo = e.target.files || e.dataTransfer.files;

            if (!arquivo.length) {
                return;
            }
            
            let reader = new FileReader();
            reader.onloadend = (e) => { this.imagem = e.target.result; };
            reader.readAsDataURL(arquivo[0]);
        },
        perfil() {
            this.$http.put(`${this.$urlApi}/perfil`, 
                {
                    name: this.name,
                    email: this.email,
                    imagem: this.imagem,
                    password: this.password,
                    password_confirmation: this.password_confirmation
                },
                {
                    "headers": { "authorization": `Bearer ${this.usuario.token}` }
                }
            )
            .then(response => {
                if (response.data.status) {
                    this.usuario = response.data.usuario;
                    sessionStorage.setItem('usuario', JSON.stringify(this.usuario));
                } else if (response.data.status == false && response.data.validacao) {
                    // erros de validação
                    let erros = '';
                    for (let erro of Object.values(response.data.erros)) {
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
