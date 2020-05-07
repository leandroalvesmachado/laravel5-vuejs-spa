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
                perfil="https://materializecss.com/images/yuna.jpg"
                nome="Leandro"
                data="20/20/2020"
            >
                <card-detalhe
                    img="https://materializecss.com/images/sample-1.jpg"
                    titulo=""
                    texto="teste"
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
            usuario: ''
        }
    },
    created() {
        // quando o componente é criado ciclo de vida
        let usuarioAux = sessionStorage.getItem('usuario');

        if (usuarioAux) {
            // pega a string e transforma em json
            this.usuario = JSON.parse(usuarioAux);
        }
    }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
</style>
