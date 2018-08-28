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
                        v-model="package.name[selected_lang]"
                        :rules="messages.validation.name"
                        minlength="3"
                        maxlength="255"
                ></v-text-field>
                <v-text-field
                        name="number_of_washes_per_week"
                        type="number"
                        :label="$t('table.number_of_washes_per_week')"
                        v-model="package.number_of_washes_per_week"
                        :rules="messages.validation.number_of_washes_per_week"
                ></v-text-field>

                <mavon-editor
                        placeholder="Resource Description"
                        language="en"
                        v-model="package.description[selected_lang]"
                ></mavon-editor>
                <br>
                <b>{{$t('table.price_calculator')}}</b>
                <v-select
                        :items="['+', '*', '/', '-']"
                        v-model="package.m_operation"
                        :label="$t('table.mathematical_operation')"
                ></v-select>
                <v-text-field
                        name="name"
                        :label="$t('table.m_price')"
                        v-model="package.m_price"
                        :rules="messages.validation.m_price"
                ></v-text-field>


            </v-card-text>
        </v-card>

        <v-btn color="primary" :loading="$store.state.fetching" type="submit">
            <i v-if="$store.state.fetching" class="fa fa-spinner fa-pulse"></i>
            {{ edit ? $t('form.edit') : $t('form.create') }}
        </v-btn>
        <v-btn color="default" router :to="{name: 'packages.index'}" type="reset">
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
    export default class PackageManager extends Vue {
        package = {name: {}, description: {}, services: []};
        selected_lang = 'ar';

        mounted() {
            /*
             * Set Page BreadCrumb
             */
            this.$store.dispatch('setBreadCrumbs', [
                'packages.index',
                'packages.' + (this.edit ? 'edit' : 'add')
            ]);
            if (this.edit) {
                this.$http.get('admin/packages/' + this.$route.params.package).then(response => this.package = response.data.data);
            }


        }

        get edit() {
            return !!this.$route.params.package;
        }



        save() {
            // if form for create
            return this.edit ? this.update() : this.create();
        }

        create() {
            this.$http.post(`admin/packages`, this.package)
                .then(response => {
                    this.$events.$emit('notify', {
                        type: 'info',
                        title: 'Success !',
                        message: this.$t('notifications.data.created_successfully')
                    });
                    this.$router.push({name: 'packages.index'});
                });
        }

        update() {
            this.$http.put(`admin/packages/${this.$route.params.package}`, this.package)
                .then(response => {
                    this.$events.$emit('notify', {
                        type: 'info',
                        title: 'Success !',
                        message: this.$t('notifications.data.updated_successfully')
                    });
                    this.$router.push({name: 'packages.index'});
                });
        }


    }
</script>
