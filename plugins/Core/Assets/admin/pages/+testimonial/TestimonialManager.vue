<template>
    <form @submit.prevent="save()">
        <v-card class="mb-3">
            <v-card-text>
                <v-text-field
                        name="customer_name"
                        :label="$t('table.customer_name')"
                        v-model="testimonial.customer_name"
                        :rules="messages.validation.customer_name"
                        minlength="3"
                        maxlength="255"
                ></v-text-field>
                <v-text-field
                        name="customer_avatar"
                        :label="$t('table.customer_avatar')"
                        v-model="testimonial.customer_avatar"
                        :rules="messages.validation.customer_avatar"
                        minlength="3"
                        maxlength="255"
                ></v-text-field>
                <v-switch
                        :label="$t('table.like')"
                        v-model="testimonial.like"
                ></v-switch>

                <mavon-editor
                        :label="$t('table.comment')"
                        language="en"
                        v-model="testimonial.comment"
                ></mavon-editor>


            </v-card-text>
        </v-card>

        <v-btn color="primary" :loading="$store.state.fetching" type="submit">
            <i v-if="$store.state.fetching" class="fa fa-spinner fa-pulse"></i>
            {{ edit ? $t('form.edit') : $t('form.create') }}
        </v-btn>
        <v-btn color="default" router :to="{name: 'testimonials.index'}" type="reset">
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
        testimonial = {};

        mounted() {
            /*
             * Set Page BreadCrumb
             */
            this.$store.dispatch('setBreadCrumbs', [
                'testimonials.index',
                'testimonials.' + (this.edit ? 'edit' : 'add')
            ]);
            if (this.edit) {
                this.$http.get('admin/testimonials/' + this.$route.params.testimonial).then(response => this.testimonial = response.data.data);
            }

        }

        get edit() {
            return !!this.$route.params.testimonial;
        }

        save() {
            // if form for create
            return this.edit ? this.update() : this.create();
        }

        create() {
            this.$http.post(`admin/testimonials`, this.testimonial)
                .then(response => {
                    this.$events.$emit('notify', {
                        type: 'info',
                        title: 'Success !',
                        message: this.$t('notifications.data.created_successfully')
                    });
                    this.$router.push({name: 'testimonials.index'});
                });
        }

        update() {
            this.$http.put(`admin/testimonials/${this.$route.params.testimonial}`, this.testimonial)
                .then(response => {
                    this.$events.$emit('notify', {
                        type: 'info',
                        title: 'Success !',
                        message: this.$t('notifications.data.updated_successfully')
                    });
                    this.$router.push({name: 'testimonials.index'});
                });
        }


    }
</script>
