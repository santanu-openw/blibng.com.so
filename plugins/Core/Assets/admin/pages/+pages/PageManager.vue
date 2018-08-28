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
                        name="title"
                        :label="$t('table.title')"
                        v-model="page.title[selected_lang]"
                        :rules="messages.validation.title"
                        minlength="3"
                        maxlength="255"
                ></v-text-field>

                <v-text-field
                        name="slug"
                        :label="$t('table.slug')"
                        v-model="page.slug"
                        :rules="messages.validation.slug"
                        minlength="3"
                        maxlength="255"
                ></v-text-field>

                <mavon-editor
                        placeholder="Content"
                        :language="selected_lang"
                        v-model="page.content[selected_lang]"
                ></mavon-editor>

            </v-card-text>
        </v-card>

        <v-btn color="primary" :loading="$store.state.fetching" type="submit">
            {{ edit ? $t('form.edit') : $t('form.create') }}
        </v-btn>
        <v-btn color="default" router :to="{name: 'pages.index'}" type="reset">
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
    export default class PageManager extends Vue {
        page = {name: {}, title: {}, description: {}};
        selected_lang = 'ar';

        mounted() {
            /*
             * Set Page BreadCrumb
             */
            this.$store.dispatch('setBreadCrumbs', [
                'pages.index',
                'pages.' + (this.edit ? 'edit' : 'add')
            ]);
            if (this.edit) {
                this.$http.get('admin/pages/' + this.$route.params.page).then(response => this.page = response.data.data);
            }

        }

        get edit() {
            return !!this.$route.params.page;
        }

        save() {
            // if form for create
            return this.edit ? this.update() : this.create();
        }

        create() {
            this.$http.post(`admin/pages`, this.page)
                .then(response => {
                    this.$events.$emit('notify', {
                        type: 'info',
                        title: 'Success !',
                        message: this.$t('notifications.data.created_successfully')
                    });
                    this.$router.push({name: 'pages.index'});
                });
        }

        update() {
            this.$http.put(`admin/pages/${this.$route.params.page}`, this.page)
                .then(response => {
                    this.$events.$emit('notify', {
                        type: 'info',
                        title: 'Success !',
                        message: this.$t('notifications.data.updated_successfully')
                    });
                    this.$router.push({name: 'pages.index'});
                });
        }


    }
</script>
