<template>
    <v-footer
            dark
            height="auto"
    >
        <v-card
                flat
                tile
                class="footer-bg white--text text-xs-center"
        >
            <v-card-text>
                <img src="/images/logo.png" class="footer-logo">
                <br>
                <span class="footer-rights">
                        2018  © المصمم الألكتروني |  جميع الحقوقوق محفوضة
                </span>
            </v-card-text>
            <v-card-text>
                <v-btn
                        v-for="icon in icons"
                        :key="icon"
                        class="mx-3 footer-fab white--text"
                        fab
                >
                    <v-icon size="24px">{{ icon }}</v-icon>
                </v-btn>
            </v-card-text>

            <v-card-text class="white--text pt-0">
                <img src="/images/cards-icon.png" alt="">
            </v-card-text>

            <v-divider></v-divider>

            <v-card-text class="white--text">
                <v-layout
                        justify-center
                        row
                        wrap
                >
                    <v-btn
                            color="white"
                            flat
                            round
                            :to="{name: 'home.index'}" exact
                    >
                        الرئيسية
                    </v-btn>
                   <span class="divider">|</span>
                    <v-btn
                            color="white"
                            flat
                            round
                    >
                        من نحن
                    </v-btn>
                    <span class="divider">|</span>
                    <v-btn
                            color="white"
                            flat
                            round
                    >
                        خدماتنا
                    </v-btn>
                    <span class="divider">|</span>
                    <v-btn
                            color="white"
                            flat
                            round
                    >
                        معرض الصور
                    </v-btn>
                    <span class="divider">|</span>
                    <v-btn
                            color="white"
                            flat
                            round
                            :to="{name: 'contact_us'}"
                    >
                        إتصل بنا
                    </v-btn>
                    <span class="divider">|</span>
                    <v-btn
                            color="white"
                            flat
                            round
                            :to="{name: 'auth.login'}"
                    >
                        تسجيل الدخول
                    </v-btn>
                    <span class="divider">|</span>
                    <v-btn
                            color="white"
                            flat
                            round
                            :to="{name: 'auth.register'}"
                    >
                        تسجيل جديد
                    </v-btn>
                </v-layout>
            </v-card-text>
        </v-card>
    </v-footer>
</template>

<script>
    import Vue from 'vue';
    import Component from 'vue-class-component';

    @Component
    export default class Footer extends Vue {
        icons = [
            'fab fa-facebook',
            'fab fa-twitter',
            'fab fa-google-plus',
            'fab fa-linkedin',
            'fab fa-instagram'
        ];

    }
</script>

<style scoped>
    .footer-logo {
        padding: 60px 0 30px;
    }

    .footer-bg {
        width: 100%;
        background-color: #4c5166 !important;
        border-color: #4c5166 !important;
    }

    .footer-rights {
        color: #858a9f;
        font-size: 14px;
    }

    .footer-fab {
        background-color: #5a617a !important;
        border-color: #5a617a !important;
        box-shadow: none;
    }

    span.divider {
        padding: 10px 0;
        font-size: 20px;
    }
</style>