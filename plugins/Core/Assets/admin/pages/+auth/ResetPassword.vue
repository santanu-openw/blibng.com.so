<template>
    <auth-layout>
        <v-card>
            <v-card-text>
                <form @submit.prevent="submit()" class="text-xs-center">
                    <img src="/images/logo.png" class="img-responsive logo" @click.prevent="() => $router.push({name: 'auth.login'})">

                    <v-alert v-if="message" color="success" icon="check_circle" value="true">
                        {{ message }}
                    </v-alert>
                    <div v-else>
                        <v-text-field
                                name="email"
                                :label="$t('table.email')"
                                type="email"
                                v-model="user.email"
                                append-icon="email"
                                :rules="messages.validation.message"
                                required
                        ></v-text-field>

                        <v-btn block color="primary" type="submit" :loading="$store.state.fetching">
                            {{$t('auth.send_password_reset_link')}}
                        </v-btn>

                    </div>
                </form>
            </v-card-text>
        </v-card>
    </auth-layout>

</template>

<script type="text/babel">
    import Vue from 'vue';
    import Component from 'vue-class-component';
    import {mapState} from 'vuex';
    import AuthLayout from './AuthLayout';

    @Component({
        components: {AuthLayout},
        computed: mapState(['messages'])
    })
    export default class ResetPassword extends Vue {
        user = {};
        message = false;

        submit() {
            this.$http.post('forgot-password', this.user)
                .then(res => this.message = res.data);
        }
    }
</script>
