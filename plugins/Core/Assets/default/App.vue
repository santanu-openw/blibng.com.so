<template>
    <v-app light class="lang-ar">
        <app-header></app-header>
        <app-banner></app-banner>
        <v-content>
            <v-container fluid class="l-main">
                <app-breadcrumbs v-if="$route.name !== 'home.index'"></app-breadcrumbs>
                <transition name="fade" mode="out-in">
                    <router-view></router-view>
                </transition>
            </v-container>
        </v-content>
        <app-footer></app-footer>
    </v-app>
</template>

<script>
    import Vue from 'vue';
    import Component from 'vue-class-component';
    import {mapGetters} from 'vuex';
    import AppHeader from "@zix-core/default/components/Header";
    import AppFooter from "@zix-core/default/components/Footer";
    import AppBanner from "@zix-core/default/components/Banner";
    import AppBreadcrumbs from "@zix-core/default/components/Breadcrumbs";

    import {localStorageGetItem} from "./plugins/local";
    import toastr from "toastr";
    @Component({
        computed: mapGetters(['isAuth']),
        components: {
            AppHeader, AppBanner, AppFooter, AppBreadcrumbs
        }
    })
    export default class App extends Vue {
        created() {
            if (localStorageGetItem('token')) {
                this.$store.dispatch('getUserData');
            }

            this.$events.$on('notify', (data) => {
                this.notifyViaToaster(data);
            });
        }

        notifyViaToaster(data) {

            //set the options
            toastr.options.closeButton = true;
            toastr.options.escapeHtml = true;
            toastr.options.progressBar = true;
            toastr.options.rtl = false;

            toastr[data.type](data.message, data.title);
        }
    }

</script>

<style scoped>

</style>