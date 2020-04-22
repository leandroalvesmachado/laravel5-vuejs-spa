<template>
    <div :class="'col s' + tamanho">
        <slot></slot>
    </div>
</template>

<script>
    export default {
        name: 'BaseGrid',
        props: [
            'tamanho'
        ],
        data () {
            return {
            }
        }
    }
</script>

<style scoped>
</style>
