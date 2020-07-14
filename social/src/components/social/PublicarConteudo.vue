<template>
    <div class="row">
        <base-grid class="input-field" tamanho="12">
            <input type="text" v-model="conteudo.titulo">
            <textarea
                v-if="conteudo.titulo"
                placeholder="Conteúdo"
                v-model="conteudo.texto"
                class="materialize-textarea"
            >
            </textarea>
            <input
                v-if="conteudo.titulo && conteudo.texto"
                type="text"
                placeholder="Link"
                v-model="conteudo.link"
            >
            <input 
                v-if="conteudo.titulo && conteudo.texto"
                type="text"
                placeholder="Url da imagem"
                v-model="conteudo.imagem"
            >
            <label for="conteudo">O que está acontecendo?</label>
        </base-grid>
        <p class="right-align">
            <button
                @click="addConteudo"
                v-if="conteudo.titulo && conteudo.texto"
                class="btn waves-effect waves-light"
                tamanho="2 offset-s10"
            >
                Publicar
            </button>
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
            conteudo: {
                titulo: '',
                texto: '',
                imagem: '',
                link: ''
            }
        }
    },
    methods: {
        addConteudo() {
            this.$http.post(`${this.$urlApi}/conteudo/adicionar`, 
                {
                    titulo: this.conteudo.titulo,
                    texto: this.conteudo.texto,
                    imagem: this.conteudo.imagem,
                    link: this.conteudo.link,
                },
                { 
                    "headers": { "authorization": `Bearer ${this.$store.getters.getToken}`
                }
            }).then(response => {
                if (response.data.status) {
                    console.log(response.data.conteudos);
                }
            }).catch(e=> {
                console.log(e);
            });
        }
    }
}
</script>