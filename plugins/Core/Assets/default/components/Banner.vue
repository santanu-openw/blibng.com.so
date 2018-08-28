<template>
    <div>
        <v-parallax v-show="$route.name === 'home.index'" src="/images/banner-bg.png" height="880">
            <v-layout
                    column
                    align-center
                    justify-center
                    class="white--text"
            >
                <h1 class="white--text mb-2 display-3 text-xs-center">
                    بلينق لغسيل السيارات
                </h1>
                <b class="subheading mb-3 text-xs-center">
                    المملكة العربية السعودية
                </b>
                <div style="display: inline-flex" class="mt-5">
                    <v-btn
                            dark
                            outline
                            large
                    >
                        <img src="/images/play-icon.png" class="pl-2">
                        شاهد الفيديو

                    </v-btn>
                    <v-btn
                            :to="{name: 'orders.index'}" exact
                            dark
                            class="gradient-btn"
                            large
                    >
                        <img src="/images/clock-icon.png" class="pl-2">
                        إحجز موعدك ألأن
                    </v-btn>
                </div>
            </v-layout>
        </v-parallax>
        <v-parallax v-show="$route.name !== 'home.index'"
                    src="/images/small-banner-bg.png" height="130"></v-parallax>
    </div>
</template>

<script>
    import Vue from 'vue';
    import Component from 'vue-class-component';

    @Component
    export default class Banner extends Vue {
    }
</script>

<style scoped>
    h1.display-3 {
        font-size: 66px !important;
        font-family: 'FFKhallab', serif !important;
    }

    .subheading {
        padding-top: 15px;
        font-size: 25px !important;
        font-weight: bold;
    }

    .gradient-btn {
        border: 1px solid #5c7b8d;
        background: #4dc4d1; /* Old browsers */
        background: -moz-linear-gradient(left, #4dc4d1 40%, #7883ac 100%); /* FF3.6-15 */
        background: -webkit-linear-gradient(left, #4dc4d1 40%, #7883ac 100%); /* Chrome10-25,Safari5.1-6 */
        background: linear-gradient(to right, #4dc4d1 40%, #7883ac 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#4dc4d1', endColorstr='#7883ac', GradientType=1); /* IE6-9 */
        box-shadow: none;
    }
</style>