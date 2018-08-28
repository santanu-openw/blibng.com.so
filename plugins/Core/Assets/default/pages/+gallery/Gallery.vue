<template>
    <div class="contact-page">
        <v-container>
            <v-layout row wrap>
                <v-flex sm12>
                    <div class="title mb-3">
                        <h2>معرض الصور</h2>
                    </div>
                    <v-layout row wrap class="gallery">
                        <vue-gallery :images="images" :index="index" @close="index = null"></vue-gallery>
                        <v-flex xl3 lg3 md4 sm6 xs12
                                class="pa-3"
                                v-for="image, imageIndex in gallery.images"
                                :key="imageIndex"
                        >
                            <div @click="index = imageIndex" class="image"
                                 :style="{ background: 'url(' + image.url + ')',backgroundSize: 'cover', width: '100%', height: '365px' }">
                                <div class="layer">
                                    <img src="/images/rectangle-icon.png">
                                    <h3>{{image.title}}</h3>
                                </div>
                            </div>
                        </v-flex>
                    </v-layout>
                </v-flex>
            </v-layout>
        </v-container>
    </div>
</template>

<script type="text/babel">
    import Vue from 'vue';
    import Component from 'vue-class-component';
    import VueGallery from 'vue-gallery';

    @Component({
        components: {VueGallery}
    })
    export default class Home extends Vue {
        gallery = {images: []};
        index = null;

        get images() {
            return this.gallery.images.map(image => image.url);
        }

        mounted() {
            this.$store.dispatch('setBreadCrumbs', [
                'gallery.index'
            ]);

            this.$http.get('/galleries/main').then(response => {
                this.gallery = response.data.data;
                this.$forceUpdate();
            });


        }

        save() {

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
