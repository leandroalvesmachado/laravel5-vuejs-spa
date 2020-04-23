<template>
    <div class="row">
        <base-grid class="input-field" tamanho="12">
            <textarea v-model="conteudo" class="materialize-textarea"></textarea>
            <label for="conteudo">O que está acontecendo?</label>
        </base-grid>
        <p>
            <base-grid v-if="conteudo" class="btn waves-effect waves-light" tamanho="2 offset-s10">Publicar</base-grid>
        </p>
    </div>
</template>

<script>
import BaseGrid from '@/components/layouts/BaseGrid';

export default {
    name: 'PublicarConteudo',
    components: {
        BaseGrid
    },
    props: {
    },
    data () {
        return {
            conteudo: ''
        }
    }
}
</script>