<template>
    <v-container>
        <ul class="breadcrumb">
            <li>
                <a>
                    <v-icon>home</v-icon>
                </a>

            </li>
            <router-link v-for="breadcrumb of breadcrumbs" tag="li" :to="{name: breadcrumb}" :key="breadcrumb">
                <a>
                    {{$t(breadcrumb)}}
                </a>
            </router-link>

        </ul>
    </v-container>
</template>

<script>
    import Vue from 'vue';
    import Component from 'vue-class-component';
    import {mapGetters} from 'vuex';

    @Component({
        computed: mapGetters(['breadcrumbs'])
    })
    export default class Breadcrumbs extends Vue {
    }
</script>

<style scoped>
    .breadcrumb {
        background: #ecf4f7; /* Old browsers */
        background: -moz-linear-gradient(top, #fefefe 0%, #ecf4f7 100%); /* FF3.6-15 */
        background: -webkit-linear-gradient(top, #fefefe 0%, #ecf4f7 100%); /* Chrome10-25,Safari5.1-6 */
        background: linear-gradient(to bottom, #fefefe 0%, #ecf4f7 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#fefefe', endColorstr='#ecf4f7', GradientType=0); /* IE6-9 */
        padding: 5px;
        border: 1px solid #b4c5cf;
        border-radius: 5px;
        display: inline-flex;
        margin-bottom: 40px;
    }

    .breadcrumb li {
        list-style: none;
        padding: 5px 15px;
    }

    .breadcrumb li a {
        text-decoration: none;
        position: relative;
        display: block;
        float: right;
        background: transparent !important;
    }


</style>