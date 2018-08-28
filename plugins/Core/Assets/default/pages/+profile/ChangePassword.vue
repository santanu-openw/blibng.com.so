<template>
    <v-container>
        <v-layout row wrap>
            <v-flex xl6 lg6 md6>
                <v-layout row wrap>
                    <v-flex xl12 lg12 md12>
                        <div class="title">
                            <h2>تغيير كلمة السر</h2>
                            <hr>
                        </div>
                        <form @submit.prevent="updatePassword()" class="pt-4">
                            <v-text-field
                                    name="old_password"
                                    type="password"
                                    :label="$t('table.old_password')"
                                    v-model="password.old_password"
                                    :rules="messages.validation.old_password"
                                    outline
                                    required
                                    minlength="3"
                                    maxlength="255"
                            ></v-text-field>
                            <v-text-field
                                    name="password"
                                    type="password"
                                    :label="$t('table.password')"
                                    v-model="password.password"
                                    :rules="messages.validation.password"
                                    outline
                                    required
                                    minlength="3"
                                    maxlength="255"
                            ></v-text-field>
                            <v-text-field
                                    name="password_confirmation"
                                    type="password"
                                    :label="$t('table.password_confirmation')"
                                    v-model="password.password_confirmation"
                                    :rules="messages.validation.password_confirmation"
                                    outline
                                    required
                                    minlength="3"
                                    maxlength="255"
                            ></v-text-field>
                            <v-btn color="primary" :loading="$store.state.fetching" type="submit">
                                تغيير
                            </v-btn>
                        </form>
                    </v-flex>
                </v-layout>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script type="text/babel">
    import Vue from 'vue';
    import Component from 'vue-class-component';
    import {mapState} from 'vuex';

    @Component({
        computed: mapState(['messages'])
    })
    export default class ChangePassword extends Vue {
        password = {};

        mounted() {
            /*
             * Set Page BreadCrumb
             */
            this.$store.dispatch('setBreadCrumbs', [
                'profile.change_password'
            ]);

        }

        updatePassword() {
            this.$http.post('user/update-password', this.password)
                .then(response => {
                    this.$events.$emit('notify', {
                        type: 'success',
                        title: 'Success !',
                        message: "Your password was update successfully"
                    });
                    this.password = {};
                });
        }
    }
</script>
<style scoped type="text/css">
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
</style>
