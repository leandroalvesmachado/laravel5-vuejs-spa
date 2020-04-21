<template>
    <span>
        <header>
            <app-navbar
                logo="Social"
                url="#"
                cor="green darken-1"
            />
        </header>
        <main>
            <div class="container">
                <div class="row">
                    <app-grid tamanho="4">Menu</app-grid>
                    <app-grid tamanho="8">
                        <router-view />
                    </app-grid>
                </div>
            </div>
        </main>
        <app-footer
            cor="green darken-1"
            logo="Social"
            descricao="Teste"
            ano="2020"
        >
            <li><a class="grey-text text-lighten-3" href="#!">Home</a></li>
            <li><a class="grey-text text-lighten-3" href="#!">Link 2</a></li>
            <li><a class="grey-text text-lighten-3" href="#!">Link 3</a></li>
            <li><a class="grey-text text-lighten-3" href="#!">Link 4</a></li>
        </app-footer>
    </span>
</template>

<script>

import Navbar from '@/components/layouts/navbar';
import Footer from '@/components/layouts/footer';
import Grid from '@/components/layouts/grid';

export default {
    name: "App",
    components: {
        'app-navbar': Navbar,
        'app-footer': Footer,
        'app-grid': Grid
    }
};
</script>

<style>
</style>
