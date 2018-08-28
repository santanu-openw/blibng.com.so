<template>
    <div class="contact-page">
        <v-container>
            <v-layout row wrap>
                <v-flex sm12>
                    <div class="title mb-3">
                        <h2>{{page.title}}</h2>
                    </div>
                    <div class="page">
                        <vue-markdown :source="page.content"></vue-markdown>
                    </div>
                </v-flex>
            </v-layout>
        </v-container>
    </div>
</template>

<script type="text/babel">
    import Vue from 'vue';
    import Component from 'vue-class-component';
    import VueMarkdown from 'vue-markdown'

    @Component({
        components: {VueMarkdown}
    })
    export default class Pages extends Vue {
        page = {};
        index = null;

        mounted() {
            this.$store.dispatch('setBreadCrumbs', [
                'pages.index'
            ]);

            this.$http.get(`/pages/${this.$route.params.page}`).then(response => this.page = response.data.data)

        }


    }
</script>

<style scoped type="text/css">
    .contact-page {
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
    }

    .image > .layer {
        display: none;
        position: relative;
        top: 0;
        background-color: rgba(82, 189, 201, 0.6);
        width: 100%;
        height: inherit;
        text-align: center;
        padding: 55% 0;
    }

    .image:hover > .layer {
        display: block;
    }
    .image > .layer h3 {
        color: #FFF;
        font-size: 18px;
    }
</style>
