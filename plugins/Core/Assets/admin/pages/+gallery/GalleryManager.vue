<template>
    <form @submit.prevent="save()">
        <v-card class="mb-3">
            <v-card-text>

                <v-text-field
                        name="title"
                        :label="$t('table.title')"
                        v-model="gallery.title"
                        :rules="messages.validation.title"
                        minlength="3"
                        maxlength="255"
                ></v-text-field>
                <v-text-field
                        name="type"
                        :label="$t('table.type')"
                        v-model="gallery.type"
                        :rules="messages.validation.type"
                        minlength="3"
                        maxlength="255"
                ></v-text-field>

                <div v-if="edit">
                    <v-layout row wrap>
                        <vue-gallery :images="images" :index="index" @close="index = null"></vue-gallery>
                        <v-flex xl3 lg3 md4 sm6 xs12
                                class="pa-3"
                                v-for="image of gallery.images"
                                :key="image.url"
                        >
                            <v-btn fab color="red" icon small dark @click.prevent="deleteImage(image)">
                                <v-icon>remove</v-icon>
                            </v-btn>
                            <v-btn fab color="primary" icon small dark @click.prevent="editImageText(image)">
                                <v-icon>text_fields</v-icon>
                            </v-btn>
                            <div @click="index = image.url" class="image"
                                 :style="{ background: 'url(' + image.url + ')',backgroundSize: 'cover', width: '100%', height: '365px' }">
                                <div class="layer">
                                    <img src="/images/rectangle-icon.png">
                                    <h3>{{image.title}}</h3>
                                </div>
                            </div>
                        </v-flex>

                    </v-layout>
                    <multiple-file-uploader
                            headerMessage="إضافة الصور"
                            :postURL="`api/admin/galleries/${$route.params.gallery}/upload-images`"
                            successMessagePath="تم تحميل الصورة بنجاح"
                            errorMessagePath="هناك خطأ ما"
                            :postHeader="postHeader"
                            @uploaded="fileUploaded"
                    ></multiple-file-uploader>
                    <v-dialog
                            v-model="dialog"
                            width="500"
                    >
                        <v-card>
                            <v-card-text>
                                <v-text-field
                                        :label="$t('table.title')"
                                        v-model="selected_image.title"
                                ></v-text-field>
                            </v-card-text>

                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn
                                        color="primary"
                                        @click="updateImageText()"
                                >
                                    {{$t('form.edit')}}
                                </v-btn>
                            </v-card-actions>
                        </v-card>
                    </v-dialog>
                </div>


            </v-card-text>
        </v-card>

        <v-btn color="primary" :loading="$store.state.fetching" type="submit">
            <i v-if="$store.state.fetching" class="fa fa-spinner fa-pulse"></i>
            {{ edit ? $t('form.edit') : $t('form.create') }}
        </v-btn>
        <v-btn color="default" router :to="{name: 'galleries.index'}" type="reset">
            {{ $t('form.cancel') }}
        </v-btn>
    </form>
</template>

<script type="text/babel">
    import Vue from 'vue';
    import Component from 'vue-class-component';
    import {mapState} from 'vuex';
    import MultipleFileUploader from '@zix-core/admin/libraries/MultipleFileUploader'
    import {localStorageGetItem, localStorageSetItem} from "@zix-core/admin/plugins/local";
    import VueGallery from 'vue-gallery';

    @Component({
        computed: mapState(['messages']),
        components: {
            MultipleFileUploader, VueGallery
        }
    })
    export default class GalleryManager extends Vue {
        gallery = {images: []};
        index = null;
        postHeader = {
            'X-Requested-With': 'XMLHttpRequest',
            'Authorization': `Bearer ${localStorageGetItem('token')}`
        };
        selected_image = {};
        dialog = false;

        mounted() {
            console.info(this.$route);
            /*
             * Set Page BreadCrumb
             */
            this.$store.dispatch('setBreadCrumbs', [
                'galleries.index',
                'galleries.' + (this.edit ? 'edit' : 'create')
            ]);
            if (this.edit) {
                this.$http.get('admin/galleries/' + this.$route.params.gallery).then(response => this.gallery = response.data.data);
            }

        }

        get edit() {
            return !!this.$route.params.gallery;
        }

        get images() {
            return this.gallery.images.map(image => image.url)
        }

        save() {
            // if form for create
            return this.edit ? this.update() : this.create();
        }

        create() {
            this.$http.post(`admin/galleries`, this.gallery)
                .then(response => {
                    this.$events.$emit('notify', {
                        type: 'info',
                        title: 'Success !',
                        message: this.$t('notifications.data.created_successfully')
                    });
                    console.info(response)
                    this.$router.push({name: 'galleries.edit', params: {gallery: response.data.data.id}});
                });
        }

        update() {
            this.$http.put(`admin/galleries/${this.$route.params.gallery}`, this.gallery)
                .then(response => {
                    this.$events.$emit('notify', {
                        type: 'info',
                        title: 'Success !',
                        message: this.$t('notifications.data.updated_successfully')
                    });
                    this.$router.push({name: 'galleries.index'});
                });
        }

        fileUploaded(response) {
            console.info('===>', response)
            this.gallery = response.data.data;
            this.$forceUpdate();
            // this.session.medias = response.data.data.medias
        }

        getImages(images) {
            return images.map(image => image.url);
        }

        deleteImage(image) {
            this.$http.delete(`admin/galleries/${this.$route.params.gallery}/upload-images/${image.id}`)
                .then(response => {
                    this.gallery = response.data.data;
                    this.$forceUpdate();
                    console.info('Deleted :: ', response.data.data)
                });
        }

        editImageText(image) {
            this.selected_image = image;
            this.dialog = true;
        }

        updateImageText() {
            this.$http.put(`admin/galleries/${this.$route.params.gallery}/upload-images/${this.selected_image.id}`, this.selected_image)
                .then(response => {
                    this.selected_image = {};
                    this.dialog = false;
                    this.gallery = response.data.data;
                    this.$forceUpdate();
                })
        }


    }
</script>
<style scoped>
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