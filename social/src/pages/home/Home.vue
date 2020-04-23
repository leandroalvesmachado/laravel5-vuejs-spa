<template>
    <site-template>
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
    </site-template>
</template>

<script>

import SiteTemplate from '@/templates/SiteTemplate';
import CardConteudo from '@/components/social/CardConteudo';
import CardDetalhe from '@/components/social/CardDetalhe';
import PublicarConteudo from '@/components/social/PublicarConteudo';

export default {
    name: 'Home',
    components: {
        SiteTemplate,
        CardConteudo,
        CardDetalhe,
        PublicarConteudo
    },
    data () {
        return {
            msg: 'Welcome to Your Vue.js App'
        }
    }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
</style>
