<template>
    <form @submit.prevent="save()">
        <v-layout row wrap>
            <v-flex :xl6="edit" :lg6="edit" :md6="edit"
                    :xl12="!edit" :lg12="!edit" :md12="!edit"
            >
                <v-card class="ma-3">
                    <v-card-text>

                        <v-text-field
                                name="first_name"
                                :label="$t('table.first_name')"
                                v-model="user.first_name"
                                :rules="messages.validation.first_name"
                                required
                                minlength="3"
                                maxlength="255"
                        ></v-text-field>
                        <v-text-field
                                name="last_name"
                                :label="$t('table.last_name')"
                                v-model="user.last_name"
                                :rules="messages.validation.last_name"
                                required
                                minlength="3"
                                maxlength="255"
                        ></v-text-field>
                        <v-text-field
                                name="email"
                                type="email"
                                :label="$t('table.email')"
                                v-model="user.email"
                                :rules="messages.validation.email"
                                required
                                minlength="3"
                                maxlength="255"
                        ></v-text-field>
                        <v-select
                                :items="genders"
                                v-model="user.gender"
                                :label="$t('table.gender')"
                                class="input-group--focused"></v-select>
                        <v-select
                                :items="langs"
                                v-model="user.lang"
                                :label="$t('table.lang')"
                                class="input-group--focused"></v-select>

                        <v-select
                                :items="roles"
                                v-model="user.roles"
                                :label="$t('table.user_roles')"
                                class="input-group--focused"
                                item-text="name"
                                item-value="id"
                                return-object
                                multiple
                                chips
                                deletable-chips
                        ></v-select>
                        <div v-if="!edit">
                            <v-text-field
                                    name="password"
                                    type="password"
                                    :label="$t('table.password')"
                                    v-model="user.password"
                                    :rules="messages.validation.password"
                                    :required="!edit"
                                    minlength="3"
                                    maxlength="255"
                            ></v-text-field>
                        </div>
                        <div v-if="!edit">
                            <v-text-field
                                    name="password_confirmation"
                                    type="password"
                                    :label="$t('table.password_confirmation')"
                                    v-model="user.password_confirmation"
                                    :rules="messages.validation.password_confirmation"
                                    :required="!edit"
                                    minlength="3"
                                    maxlength="255"
                            ></v-text-field>
                        </div>
                    </v-card-text>
                </v-card>
            </v-flex>

            <v-flex xl6 lg6 md6 v-if="edit"
                    text-xs-center
                    layout
                    align-center
                    justify-center>
                <v-card class="ma-3">
                    <v-card-text>
                        <v-avatar
                                size="240"
                                color="grey lighten-4"
                        >
                            <img :src="user.avatar" alt="avatar">
                        </v-avatar>
                        <avatar-cropper
                                trigger="#pick-avatar"
                                :labels="{
                                    submit: $t('form.change_avatar'),
                                    cancel: $t('form.cancel')
                                }"
                                upload-form-name="avatar"
                                :upload-url="`/api/admin/users/${$route.params.id}/update-avatar`"
                                @uploaded="handleUploaded"
                        ></avatar-cropper>
                    </v-card-text>
                    <v-card-actions>
                        <v-btn flat id="pick-avatar">
                            {{$t('form.change_avatar')}}
                        </v-btn>
                    </v-card-actions>
                </v-card>
            </v-flex>
        </v-layout>


        <v-btn color="primary" :loading="$store.state.fetching" type="submit">
            <i v-if="$store.state.fetching" class="fa fa-spinner fa-pulse"></i>
            {{ edit ? $t('form.edit') : $t('form.create') }}
        </v-btn>
        <v-btn color="default" router :to="{name: 'accounts.users.index'}" type="reset">
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
    export default class UserManager extends Vue {
        user = {};
        roles = [];
        genders = ['Men', 'Women'];
        langs = ['en', 'fr'];

        mounted() {
            /*
             * Set Page BreadCrumb
             */
            this.$store.dispatch('setBreadCrumbs', [
                'accounts.users.index',
                'accounts.users.' + (this.edit ? 'edit' : 'add')
            ]);
            if (this.edit) {
                this.$http.get('admin/users/' + this.$route.params.id).then(response => this.user = response.data.data);
            }

            this.$http.get('admin/roles').then(response => this.roles = response.data.data);
        }

        get edit() {
            return !!this.$route.params.id;
        }

        save() {
            // if form for create
            return this.edit ? this.update() : this.create();
        }

        update() {
            this.$http.put('admin/users/' + this.$route.params.id, this.user)
                .then(response => {
                    this.$events.$emit('notify', {
                        type: 'info',
                        title: 'Success !',
                        message: this.$t('notifications.data.updated_successfully')
                    });

                    this.$router.push({name: 'accounts.users.index', params: {id: response.data.data.id}});
                });
        }

        create() {
            return this.$http.post('admin/users', this.user).then(response => {
                this.$events.$emit('notify', {
                    type: 'success',
                    title: 'Success !',
                    message: this.$t('notifications.data.created_successfully')
                });
                this.$router.push({name: 'accounts.users.index'});
            });
        }

        handleUploaded(response) {
            this.user = response.data;
        }
    }
</script>
