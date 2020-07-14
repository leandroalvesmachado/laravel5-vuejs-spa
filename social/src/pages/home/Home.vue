<template>
    <site-template>
        <span slot="menuesquerdo">
            <div class="row valign-wrapper">
                <base-grid tamanho="4">
                    <img :src="usuario.imagem" :alt="usuario.name" class="circle responsive-img">
                </base-grid>
                <base-grid tamanho="8">
                    <span class="black-text">
                        <h5>{{ usuario.name }}</h5>
                    </span>
                </base-grid>
            </div>
        </span>
        <span slot="principal">
            <publicar-conteudo />
            <card-conteudo
                v-for="item in conteudos"
                :key="item.id"
                :perfil="item.user.imagem"
                :nome="item.user.name"
                :data="item.data"
            >
                <card-detalhe
                    :img="item.imagem"
                    :titulo="item.titulo"
                    :texto="item.texto"
                />
            </card-conteudo>
        </span>
    </site-template>
</template>

<script>

import SiteTemplate from '@/templates/SiteTemplate';
import CardConteudo from '@/components/social/CardConteudo';
import CardDetalhe from '@/components/social/CardDetalhe';
import PublicarConteudo from '@/components/social/PublicarConteudo';
import BaseGrid from '@/components/layouts/BaseGrid';

export default {
    name: 'Home',
    components: {
        SiteTemplate,
        CardConteudo,
        CardDetalhe,
        PublicarConteudo,
        BaseGrid
    },
    data () {
        return {
            usuario: false,
            conteudos: []
        }
    },
    created() {
        // quando o componente é criado ciclo de vida
        let usuarioAux = this.$store.getters.getUsuario;

        if (usuarioAux) {
            this.usuario = this.$store.getters.getUsuario;
            this.$http.get(`${this.$urlApi}/conteudo/lista`, 
                {
                    "headers": { "authorization": `Bearer ${this.$store.getters.getToken}` }
                }
            )
            .then(response => {
                if (response.data.status) {
                    this.conteudos = response.data.conteudos.data;
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

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
</style>
