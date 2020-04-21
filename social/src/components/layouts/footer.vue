<template>
    <footer :class="'footer-fixed page-footer ' + cor">
        <div class="container">
            <div class="row">
                <div class="col l6 s12">
                    <h5 class="white-text">{{ logo || 'Site' }}</h5>
                    <p class="grey-text text-lighten-4">{{ descricao || 'Sua descrição' }}</p>
                </div>
                <div class="col l4 offset-l2 s12">
                    <h5 class="white-text">Links</h5>
                    <ul>
                        <slot></slot>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-copyright">
            <div class="container">
                © {{ ano || '2018' }} Copyright Text
            </div>
        </div>
    </footer>
</template>

<script>
    export default {
        name: 'Footer',
        props: [
            'cor',
            'logo',
            'descricao',
            'ano'
        ],
        data () {
            return {
                msg: 'Welcome to Your Vue.js App'
            }
        }
    }
</script>

<style scoped>
</style>
