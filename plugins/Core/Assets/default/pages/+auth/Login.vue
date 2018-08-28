<template>
    <auth-layout>
        <div class="title">
            <h2>            تسجيل الدخول
            </h2>
            <hr>
        </div>
        <form @submit.prevent="submit()">
            <v-text-field
                    name="email"
                    :label="$t('table.email')"
                    type="email"
                    v-model="user.email"
                    append-icon="email"
                    required
                    :rules="messages.validation.email"
                    outline
            ></v-text-field>
            <v-text-field
                    name="password"
                    :label="$t('table.password')"
                    type="password"
                    append-icon="lock"
                    v-model="user.password"
                    required
                    outline
            ></v-text-field>
            <v-btn color="primary" type="submit" :loading="$store.state.fetching">
                {{$t('auth.sign_in')}}
            </v-btn>
            <v-btn router :to="{name: 'auth.password.forgot'}">
                {{$t('auth.forgot_password')}}
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
    export default class Login extends Vue {
        user = {email: '', password: ''};

        mounted() {
            if (this.$route.query.email) {
                // check if the user email exists
                this.checkAccountExists(this.$route.query.email);
                this.user.email = this.$route.query.email;
            }
        }

        submit() {
            this.$http.post('login', this.user).then(res => {
                this.$store.dispatch('setToken', res.data.data.token);
                this.$store.dispatch('getUserData');

                if (this.$route.query.redirectTo) {
                    return this.$router.push(this.$route.query.redirectTo);
                }
                this.$router.push({name: 'orders.index'});
            }).catch(error => {
                this.$events.$emit('notify', {
                    type: 'warning',
                    title: 'Warning !',
                    message: 'Oops, please check you input'
                });
            })
        }

        checkAccountExists(email) {
            this.$http.get(`check-user/${email}`).then(res => {
                if (!res.data.id) {
                    this.$router.push({
                        name: 'auth.register',
                        query: {
                            email: this.$route.query.email,
                            redirectTo: this.$route.query.redirectTo
                        }
                    })
                }
            })
        }
    }
</script>
<style type="text/sass" scoped>
    .l-auth__user-icon {
        font-size: 8rem; }
</style>
