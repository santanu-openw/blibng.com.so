<template>
    <v-container class="auth">
        <v-layout row wrap>
            <v-flex sm5>
                <slot></slot>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
    import Vue from "vue";
    import Component from "vue-class-component";

    @Component
    export default class AuthLayout extends Vue {
    }
</script>

<style scoped>
    .auth {
        color: #4b5462;
    }
    .title h2 {
        font-size: 36px;
        font-family: 'FFKhallab', serif !important;
        font-weight: normal;
        padding-bottom: 20px;
    }

    .title hr {
        width: 113px;
        border: 1px solid #45acb7;
        margin-bottom: 40px;
    }
</style>