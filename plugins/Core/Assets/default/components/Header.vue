<template>
    <v-toolbar app flat dark
               :color="toolbarColor"
               scroll-off-screen
               :scroll-threshold="800"
               v-scroll="onScroll"

    >
        <v-content>
            <v-container>
                <v-layout row wrap>
                    <v-flex xl2 lg2 md2>
                        <v-toolbar-title>
                            <img src="/images/logo.png" height="50px">
                        </v-toolbar-title>
                    </v-flex>
                    <v-flex xl6 lg6 md6>
                        <v-btn flat :to="{name: 'home.index'}" exact>الرئيسية</v-btn>
                        <span class="divider"></span>
                        <v-btn flat :to="{name: 'pages.index', params: {page: 'about-us'}}" exact>من نحن</v-btn>
                        <span class="divider"></span>
                        <v-btn flat :to="{name: 'pages.index', params: {page: 'our-services'}}" exact>خدماتنا</v-btn>
                        <span class="divider"></span>
                        <v-btn flat :to="{name: 'gallery.index'}" exact>معرض الصور</v-btn>
                        <span class="divider"></span>
                        <v-btn flat :to="{name: 'contact_us'}">إتصل بنا</v-btn>

                    </v-flex>
                    <v-flex xl4 lg4 md4 class="pull-left text-xs-left">
                        <v-btn v-if="!isAuth" small color="white" light class="custom-btn" :to="{name: 'auth.login'}">
                            تسجيل
                            الدخول
                        </v-btn>
                        <v-btn v-if="!isAuth" outline color="white" class="custom-btn" :to="{name: 'auth.register'}">
                            تسجيل
                            جديد
                        </v-btn>
                        <v-menu v-if="isAuth" offset-y min-width="300">
                            <v-btn
                                    slot="activator" flat
                            >
                                مرحبا,
                                {{user.full_name}}
                                &nbsp; &nbsp;
                                <v-avatar>
                                    <img :src="user.avatar ? user.avatar : '/images/avatar.png'">
                                </v-avatar>
                            </v-btn>
                            <v-list>
                                <v-list-tile exact router :to="{name: 'orders.index'}">
                                    <v-list-tile-title> قائمة الطلبات</v-list-tile-title>
                                    <v-list-tile-action>
                                        <v-icon>list_alt</v-icon>
                                    </v-list-tile-action>
                                </v-list-tile>
                                <v-list-tile exact router :to="{name: 'invoices.index'}">
                                    <v-list-tile-title>قائمة الفواتير</v-list-tile-title>
                                    <v-list-tile-action>
                                        <v-icon>find_in_page</v-icon>
                                    </v-list-tile-action>
                                </v-list-tile>
                                <v-divider></v-divider>
                                <v-list-tile exact router :to="{name: 'profile.index'}">
                                    <v-list-tile-title>الملف الشخصي</v-list-tile-title>
                                    <v-list-tile-action>
                                        <v-icon>person</v-icon>
                                    </v-list-tile-action>
                                </v-list-tile>
                                <v-list-tile exact router :to="{name: 'profile.change_password'}">
                                    <v-list-tile-title>تغيير كلمة السر</v-list-tile-title>
                                    <v-list-tile-action>
                                        <v-icon>lock</v-icon>
                                    </v-list-tile-action>
                                </v-list-tile>
                                <v-divider></v-divider>

                                <v-list-tile @click="logout()">
                                    <v-list-tile-title>تسجيل الخروج</v-list-tile-title>
                                    <v-list-tile-action>
                                        <v-icon>exit_to_app</v-icon>
                                    </v-list-tile-action>
                                </v-list-tile>
                            </v-list>
                        </v-menu>
                    </v-flex>
                </v-layout>

            </v-container>
        </v-content>
    </v-toolbar>
</template>

<script>
    import Vue from 'vue';
    import Component from 'vue-class-component';
    import {mapGetters} from 'vuex';

    @Component({
        computed: mapGetters(['isAuth', 'user']),
    })
    export default class Header extends Vue {
        offsetTop = 0;

        get toolbarColor() {
            return (this.offsetTop < 50) ? 'transparent' : 'gradient';
        }

        onScroll(e) {
            this.offsetTop = window.pageYOffset || document.documentElement.scrollTop
        }

        logout() {
            this.$store.dispatch('logout');
            this.dialog = false;
            this.$router.push({name: 'auth.login'});
        }
    }
</script>

<style scoped>
    .v-toolbar__items {
        margin: 0 15px;
    }

    .custom-btn {
        height: 35px;
        padding: 0 25px;
        margin: 13px;
    }

    .divider {
        width: 5px;
        height: 5px;
        background-color: #add692;
        /*margin: 28px 23px;*/
    }

    .gradient {
        background: #4dc4d1; /* Old browsers */
        background: -moz-linear-gradient(left, #4dc4d1 40%, #7883ac 100%); /* FF3.6-15 */
        background: -webkit-linear-gradient(left, #4dc4d1 40%, #7883ac 100%); /* Chrome10-25,Safari5.1-6 */
        background: linear-gradient(to right, #4dc4d1 40%, #7883ac 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#4dc4d1', endColorstr='#7883ac', GradientType=1); /* IE6-9 */
        height: 110px;
        -webkit-box-shadow: 0px 2px 1px -1px rgba(0, 0, 0, 0.2), 0px 1px 1px 0px rgba(0, 0, 0, 0.14), 0px 1px 3px 0px rgba(0, 0, 0, 0.12) !important;
        box-shadow: 0px 2px 1px -1px rgba(0, 0, 0, 0.2), 0px 1px 1px 0px rgba(0, 0, 0, 0.14), 0px 1px 3px 0px rgba(0, 0, 0, 0.12) !important;
    }

    @media only screen and (max-width: 1540px) {
        .divider {
            margin: 0;
        }
    }
</style>