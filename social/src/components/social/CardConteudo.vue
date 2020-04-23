<template>
    <div class="row">
        <div class="card">
            <div class="card-content">
                <div class="row valign-wrapper">
                    <base-grid tamanho="1">
                        <img :src="perfil" :alt="nome" class="circle responsive-img">
                    </base-grid>
                    <base-grid tamanho="11">
                        <span class="black-text">
                            <strong>{{ nome }}</strong> - <small>{{ data }}</small>
                        </span>
                    </base-grid>
                </div>
                <slot></slot>
            </div>
            <div class="card-action">
                <p>
                    <i class="material-icons">favorite_border</i>
                    <i class="material-icons">insert_comment</i>
                </p>
            </div>
        </div>
    </div>
</template>

<script>
import BaseGrid from '@/components/layouts/BaseGrid';

export default {
    name: 'CardConteudo',
    components: {
        BaseGrid
    },
    props: {
        perfil: String,
        nome: String,
        data: String
    },
    data () {
        return {
        }
    }
}
</script>

<style scoped>
</style>
