<template>

</template>

<script type="text/babel">
    import Vue from 'vue';
    import Component from 'vue-class-component';

    @Component({

    })
    export default class Dashboard extends Vue {
        programs = [];

        mounted() {
            this.$store.dispatch('setBreadCrumbs', []);


        }

    }
</script>

<style scoped type="text/css">
    .card {
        margin: 5px;
    }
</style>
