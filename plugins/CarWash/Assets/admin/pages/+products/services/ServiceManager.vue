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
                        v-model="service.name[selected_lang]"
                        :rules="messages.validation.name"
                        minlength="3"
                        maxlength="255"
                ></v-text-field>
                <v-text-field
                        type="number"
                        name="price"
                        :label="$t('table.price')"
                        v-model="service.price"
                        :rules="messages.validation.price"
                ></v-text-field>
                <v-text-field
                        type="number"
                        name="service_time"
                        :label="$t('table.service_time')"
                        v-model="service.service_time"
                        :rules="messages.validation.service_time"
                ></v-text-field>


                <mavon-editor
                        placeholder="Resource Description"
                        language="en"
                        v-model="service.description[selected_lang]"
                ></mavon-editor>


            </v-card-text>
        </v-card>

        <v-btn color="primary" :loading="$store.state.fetching" type="submit">
            <i v-if="$store.state.fetching" class="fa fa-spinner fa-pulse"></i>
            {{ edit ? $t('form.edit') : $t('form.create') }}
        </v-btn>
        <v-btn color="default" router :to="{name: 'services.index'}" type="reset">
            {{ $t('form.cancel') }}
        </v-btn>
    </form>
</template>

<script type="text/babel">
    import Vue from 'vue';
    import Component from 'vue-class-component';
    import {mapState} from 'vuex';

    @Component({
        computed: mapState(['messages'])
    })
    export default class ServiceManager extends Vue {
        service = {name: {}, description: {}};
        selected_lang = 'ar';

        mounted() {
            /*
             * Set Page BreadCrumb
             */
            this.$store.dispatch('setBreadCrumbs', [
                'services.index',
                'services.' + (this.edit ? 'edit' : 'add')
            ]);
            if (this.edit) {
                this.$http.get('admin/services/' + this.$route.params.service).then(response => this.service = response.data.data);
            }

        }

        get edit() {
            return !!this.$route.params.service;
        }

        save() {
            // if form for create
            return this.edit ? this.update() : this.create();
        }

        create() {
            this.$http.post(`admin/services`, this.service)
                .then(response => {
                    this.$events.$emit('notify', {
                        type: 'info',
                        title: 'Success !',
                        message: this.$t('notifications.data.created_successfully')
                    });
                    this.$router.push({name: 'services.index'});
                });
        }

        update() {
            this.$http.put(`admin/services/${this.$route.params.service}`, this.service)
                .then(response => {
                    this.$events.$emit('notify', {
                        type: 'info',
                        title: 'Success !',
                        message: this.$t('notifications.data.updated_successfully')
                    });
                    this.$router.push({name: 'services.index'});
                });
        }


    }
</script>
