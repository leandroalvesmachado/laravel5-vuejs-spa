<template>
    <span>
        <div v-if="img" class="card-image">
            <img :src="img">
            <span class="card-title">{{ titulo || '' }}</span>
        </div>
        <div v-if="texto" class="card-content">
            <p>{{ texto || '' }}</p>
        </div>
    </span>
</template>

<script>

export default {
    name: 'CardDetalhe',
    props: {
        img: String,
        titulo: String,
        texto: String
    },
    data () {
        return {
        }
    }
}
</script>

<style scoped>
</style>
