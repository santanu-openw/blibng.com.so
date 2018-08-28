<template>
    <v-layout row wrap class="auth-wrapper">
        <v-flex lg4 md3></v-flex>
        <v-flex lg4 md6>
            <slot></slot>
        </v-flex>
        <v-flex lg4 md3></v-flex>
    </v-layout>
</template>

<script>
    import Vue from "vue";
    import Component from "vue-class-component";

    @Component
    export default class AuthLayout extends Vue {
    }
</script>

<style scoped>

</style>