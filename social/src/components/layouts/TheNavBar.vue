<template>
    <nav :class="cor || 'blue'">
        <div class="nav-wrapper container">
            <router-link class="brand-logo" :to="url || '/'">{{ logo || 'Site' }} {{ $store.getters.getNome }}</router-link>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <slot></slot>
            </ul>
        </div>
    </nav>
</template>

<script>
export default {
    name: 'TheNavbar',
    props: {
        logo: String,
        url: String,
        cor: String
    },
    data () {
        return {
            msg: 'Welcome to Your Vue.js App'
        }
    },
    created() {
        // altera valor da variavel do vuex
        // this.$store.commit('setNome', 'TEste');
    }
}
</script>

<style scoped>
</style>
