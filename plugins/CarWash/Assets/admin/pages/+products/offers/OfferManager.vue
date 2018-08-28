<template>
    <form @submit.prevent="save()">
        <v-card class="mb-3">
            <v-card-text>
                <v-select
                        :items="packages"
                        v-model="offer.package_id"
                        :label="$t('table.package')"
                        class="input-group--focused"
                        item-text="name"
                        item-value="id"
                        chips
                        deletable-chips
                ></v-select>

                <v-text-field
                        name="name"
                        :label="$t('table.name')"
                        v-model="offer.name"
                        :rules="messages.validation.name"
                        minlength="3"
                        maxlength="255"
                ></v-text-field>
                <v-text-field
                        name="number_of_free_washes"
                        :label="$t('table.number_of_free_washes')"
                        v-model="offer.number_of_free_washes"
                        :rules="messages.validation.number_of_free_washes"
                        type="number"
                ></v-text-field>

                <v-menu
                        ref="start_date_menu"
                        :close-on-content-click="false"
                        v-model="start_date_menu"
                        :nudge-right="40"
                        lazy
                        transition="scale-transition"
                        offset-y
                        full-width
                        max-width="290px"
                        min-width="290px"
                >
                    <v-text-field
                            slot="activator"
                            v-model="offer.starts_at"
                            :label="$t('table.starts_at')"
                            hint="MM/DD/YYYY"
                            persistent-hint
                    ></v-text-field>
                    <v-date-picker v-model="offer.starts_at" no-title @input="start_date_menu = false"></v-date-picker>
                </v-menu>
                <v-menu
                        ref="end_date_menu"
                        :close-on-content-click="false"
                        v-model="end_date_menu"
                        :nudge-right="40"
                        lazy
                        transition="scale-transition"
                        offset-y
                        full-width
                        max-width="290px"
                        min-width="290px"
                >
                    <v-text-field
                            slot="activator"
                            v-model="offer.ends_at"
                            :label="$t('table.ends_at')"
                            hint="MM/DD/YYYY"
                            persistent-hint
                    ></v-text-field>
                    <v-date-picker v-model="offer.ends_at" no-title @input="end_date_menu = false"></v-date-picker>
                </v-menu>




            </v-card-text>
        </v-card>

        <v-btn color="primary" :loading="$store.state.fetching" type="submit">
            <i v-if="$store.state.fetching" class="fa fa-spinner fa-pulse"></i>
            {{ edit ? $t('form.edit') : $t('form.create') }}
        </v-btn>
        <v-btn color="default" router :to="{name: 'offers.index'}" type="reset">
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
    export default class OfferManager extends Vue {
        start_date_menu = false;
       end_date_menu = false;
        offer = {};
        packages = [];

        mounted() {
            /*
             * Set Page BreadCrumb
             */
            this.$store.dispatch('setBreadCrumbs', [
                'offers.index',
                'offers.' + (this.edit ? 'edit' : 'add')
            ]);
            if (this.edit) {
                this.$http.get('admin/offers/' + this.$route.params.offer).then(response => this.offer = response.data.data);
            }

            this.$http.get('admin/packages').then(response => this.packages = response.data.data);

        }

        get edit() {
            return !!this.$route.params.offer;
        }

        save() {
            // if form for create
            return this.edit ? this.update() : this.create();
        }

        create() {
            this.$http.post(`admin/offers`, this.offer)
                .then(response => {
                    this.$events.$emit('notify', {
                        type: 'info',
                        title: 'Success !',
                        message: this.$t('notifications.data.created_successfully')
                    });
                    this.$router.push({name: 'offers.index'});
                });
        }

        update() {
            this.$http.put(`admin/offers/${this.$route.params.offer}`, this.offer)
                .then(response => {
                    this.$events.$emit('notify', {
                        type: 'info',
                        title: 'Success !',
                        message: this.$t('notifications.data.updated_successfully')
                    });
                    this.$router.push({name: 'offers.index'});
                });
        }


    }
</script>
