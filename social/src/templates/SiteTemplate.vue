<template>
    <span>
        <header>
            <the-nav-bar
                logo="Social"
                url="/"
                cor="green darken-1"
            >
                <li><router-link to="/">Home</router-link></li>
                <li v-if="!usuario"><router-link to="/login">Entrar</router-link></li>
                <li v-if="!usuario"><router-link to="/cadastro">Cadastre-se</router-link></li>
                <li v-if="usuario"><router-link to="/perfil">{{ usuario.name }}</router-link></li>
                <li v-if="usuario"><a @click="sair">Sair</a></li>
            </the-nav-bar>
        </header>
        <main>
            <div class="container">
                <div class="row">
                    <base-grid tamanho="4">
                        <card-menu>
                            <slot name="menuesquerdo"></slot>
                        </card-menu>
                        <card-menu>
                            <h3>Amigos</h3>
                            <li>Leandro</li>
                            <li>Gustavo</li>
                        </card-menu>
                    </base-grid>
                    <base-grid tamanho="8">
                        <slot name="principal"></slot>
                    </base-grid>
                </div>
            </div>
        </main>
        <the-footer
            cor="green darken-1"
            logo="Social"
            descricao="Teste"
            ano="2020"
        >
            <li><a class="grey-text text-lighten-3" href="#!">Home</a></li>
            <li><a class="grey-text text-lighten-3" href="#!">Link 2</a></li>
            <li><a class="grey-text text-lighten-3" href="#!">Link 3</a></li>
            <li><a class="grey-text text-lighten-3" href="#!">Link 4</a></li>
        </the-footer>
    </span>
</template>

<script>

import TheNavBar from '@/components/layouts/TheNavBar';
import TheFooter from '@/components/layouts/TheFooter';
import BaseGrid from '@/components/layouts/BaseGrid';
import CardMenu from '@/components/layouts/CardMenu';

export default {
    name: "SiteTemplate",
    components: {
        TheNavBar,
        TheFooter,
        BaseGrid,
        CardMenu
    },
    data () {
        return {
            usuario: false
        }
    },
    created() {
        // quando o componente é criado ciclo de vida
        let usuarioAux = this.$store.getters.getUsuario;
        console.log(usuarioAux);
        if (usuarioAux) {
            // pega a string e transforma em json
            this.usuario = this.$store.getters.getUsuario;
        } else {
            this.$router.push('/login');
        }
    },
    methods: {
        sair() {
            this.$store.commit('setUsuario', null);
            sessionStorage.clear();
            this.usuario = false;
            this.$router.push('/login');
        }
    }
};
</script>

<style>
</style>
