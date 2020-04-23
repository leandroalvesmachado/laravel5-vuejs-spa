<template>
    <span>
        <header>
            <the-nav-bar
                logo="Social"
                url="#"
                cor="green darken-1"
            />
        </header>
        <main>
            <div class="container">
                <div class="row">
                    <base-grid tamanho="6">
                        <card-menu>
                        </card-menu>
                    </base-grid>
                    <base-grid tamanho="6">
                        <slot></slot>
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
    name: "LoginTemplate",
    components: {
        TheNavBar,
        TheFooter,
        BaseGrid,
        CardMenu
    }
};
</script>

<style>
</style>
