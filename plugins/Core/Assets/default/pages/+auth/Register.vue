<template>
    <auth-layout>
        <div class="title">
            <h2>
                تسجيل جديد
            </h2>
            <hr>
        </div>
        <form @submit.prevent="submit()">
            <v-text-field
                    name="first_name"
                    :label="$t('table.first_name')"
                    type="text"
                    v-model="user.first_name"
                    append-icon="person"
                    :rules="messages.validation.first_name"
                    required
                    outline
            ></v-text-field>
            <v-text-field
                    name="last_name"
                    :label="$t('table.last_name')"
                    type="text"
                    v-model="user.last_name"
                    append-icon="person"
                    :rules="messages.validation.last_name"
                    required
                    outline
            ></v-text-field>
            <v-text-field
                    name="email"
                    :label="$t('table.email')"
                    type="email"
                    v-model="user.email"
                    append-icon="email"
                    :rules="messages.validation.email"
                    required
                    outline
            ></v-text-field>
            <v-text-field
                    name="password"
                    :label="$t('table.password')"
                    type="password"
                    append-icon="lock"
                    v-model="user.password"
                    :rules="messages.validation.password"
                    required
                    outline
            ></v-text-field>
            <v-text-field
                    name="password_confirmation"
                    :label="$t('table.password_confirmation')"
                    type="password"
                    append-icon="lock"
                    v-model="user.password_confirmation"
                    required
                    outline
            ></v-text-field>
            <v-checkbox
                    :label="$t('table.accept_terms')"
                    v-model="user.accept_terms"
                    primary
                    :rules="messages.validation.accept_terms"
            ></v-checkbox>
            <v-btn color="primary" type="submit" v-bind:loading="$store.state.fetching">

                {{$t('auth.sign_up')}}
            </v-btn>
            <v-btn router :to="{name: 'auth.login'}">

                {{$t('auth.already_have_an_account')}}
            </v-btn>
        </form>
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
    export default class Register extends Vue {
        user = {email: '', password: '', accept_terms: false};

        mounted() {
            this.user.email = this.$route.query.email;
        }

        submit() {
            this.$http.post('register', this.user)
                .then(res => {
                    this.$store.dispatch('setToken', res.data.token);
                    this.$store.dispatch('getUserData');
                    if (this.$route.query.redirectTo) {
                        return this.$router.push(this.$route.query.redirectTo);
                    }
                    this.$router.push({name: 'orders.index'});
                });

        }
    }
</script>

<style type="text/sass" scoped>
    .l-auth__user-icon {
        font-size: 8rem; }
</style>
