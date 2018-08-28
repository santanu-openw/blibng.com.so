<template>
    <form @submit.prevent="save()">
        <v-card class="mb-3">
            <v-card-title>
                <v-spacer></v-spacer>
                <v-btn-toggle mandatory v-model="selected_lang">
                    <v-btn flat v-for="lang of $store.state.lang.supported_languages"
                           :value="lang" :key="lang">
                        {{lang}}
                    </v-btn>

                </v-btn-toggle>
            </v-card-title>
            <v-card-text>
                <v-text-field
                        name="name"
                        :label="$t('table.name')"
                        v-model="partner.name[selected_lang]"
                        :rules="messages.validation.name"
                        minlength="3"
                        maxlength="255"
                ></v-text-field>
                <v-text-field
                        name="website_url"
                        :label="$t('table.website_url')"
                        v-model="partner.website_url"
                        :rules="messages.validation.website_url"
                        minlength="3"
                        maxlength="255"
                ></v-text-field>

                <div v-if="edit">
                    <v-avatar
                            v-if="partner.logo"
                            size="150"
                            color="grey lighten-4"
                    >
                        <img :src="partner.logo" alt="avatar">
                    </v-avatar>
                    <v-btn color="success" id="pick-avatar">
                        {{$t('form.change_avatar')}}
                    </v-btn>
                    <avatar-cropper
                            trigger="#pick-avatar"
                            :labels="{
                                    submit: $t('form.change_avatar'),
                                    cancel: $t('form.cancel')
                                }"
                            upload-form-name="logo"
                            :upload-url="`/api/admin/partners/${$route.params.partner}/update-logo`"
                            @uploaded="handleUploaded"
                    ></avatar-cropper>
                </div>


            </v-card-text>
        </v-card>

        <v-btn color="primary" :loading="$store.state.fetching" type="submit">
            <i v-if="$store.state.fetching" class="fa fa-spinner fa-pulse"></i>
            {{ edit ? $t('form.edit') : $t('form.create') }}
        </v-btn>
        <v-btn color="default" router :to="{name: 'partners.index'}" type="reset">
            {{ $t('form.cancel') }}
        </v-btn>
    </form>
</template>

<script type="text/babel">
    import Vue from 'vue';
    import Component from 'vue-class-component';
    import {mapState} from 'vuex';
    import AvatarCropper from "@zix-core/admin/components/AvatarCropper"

    @Component({
        computed: mapState(['messages']),
        components: {
            AvatarCropper
        }
    })
    export default class PartnerManager extends Vue {
        partner = {name: {}};
        selected_lang = 'ar';

        mounted() {
            /*
             * Set Page BreadCrumb
             */
            this.$store.dispatch('setBreadCrumbs', [
                'partners.index',
                'partners.' + (this.edit ? 'edit' : 'add')
            ]);
            if (this.edit) {
                this.$http.get('admin/partners/' + this.$route.params.partner).then(response => this.partner = response.data.data);
            }

        }

        get edit() {
            return !!this.$route.params.partner;
        }

        save() {
            // if form for create
            return this.edit ? this.update() : this.create();
        }

        create() {
            this.$http.post(`admin/partners`, this.partner)
                .then(response => {
                    this.$events.$emit('notify', {
                        type: 'info',
                        title: 'Success !',
                        message: this.$t('notifications.data.created_successfully')
                    });
                    this.$router.push({name: 'partners.edit', params: {partner: response.data.data.id}});
                });
        }

        update() {
            this.$http.put(`admin/partners/${this.$route.params.partner}`, this.partner)
                .then(response => {
                    this.$events.$emit('notify', {
                        type: 'info',
                        title: 'Success !',
                        message: this.$t('notifications.data.updated_successfully')
                    });
                    this.$router.push({name: 'partners.index'});
                });
        }

        handleUploaded(response) {
            this.partner = response.data;
        }


    }
</script>
