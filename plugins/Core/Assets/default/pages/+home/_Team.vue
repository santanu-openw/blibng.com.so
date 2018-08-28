<template>
    <v-layout row wrap class="team text-xs-center">
        <v-flex sm12>
            <h2>فريق العمل </h2>
        </v-flex>
        <v-flex sm12>
            <p>
                هدفنا إرضاء الزبناء
            </p>
        </v-flex>
        <v-flex sm3 class="box">
            <div class="box-img">
                <img src="/images/team-4.png">
            </div>
            <div class="box-title">
                <h3>مروان لعسير</h3>
                <span>مسؤول مبيعات</span>
            </div>
            <div class="box-social">
                <a href="#">
                    <img src="/images/phone-icon.png" alt="">
                </a>
                <a href="#">
                    <img src="/images/twitter-icon.png" alt="">
                </a>
                <a href="#">
                    <img src="/images/fb-icon.png" alt="">
                </a>
            </div>
        </v-flex>
        <v-flex sm3 class="box">
            <div class="box-img">
                <img src="/images/team-3.png">
            </div>
            <div class="box-title">
                <h3>هناء الصفا</h3>
                <span>خدمات العملاء</span>
            </div>
            <div class="box-social">
                <a href="#">
                    <img src="/images/phone-icon.png" alt="">
                </a>
                <a href="#">
                    <img src="/images/twitter-icon.png" alt="">
                </a>
                <a href="#">
                    <img src="/images/fb-icon.png" alt="">
                </a>
            </div>
        </v-flex>
        <v-flex sm3 class="box">
            <div class="box-img">
                <img src="/images/team-2.png">
            </div>
            <div class="box-title">
                <h3>نزار حكيمي</h3>
                <span>تسويق و إعلان</span>
            </div>
            <div class="box-social">
                <a href="#">
                    <img src="/images/phone-icon.png" alt="">
                </a>
                <a href="#">
                    <img src="/images/twitter-icon.png" alt="">
                </a>
                <a href="#">
                    <img src="/images/fb-icon.png" alt="">
                </a>
            </div>
        </v-flex>
        <v-flex sm3 class="box">
            <div class="box-img">
                <img src="/images/team-1.png">
            </div>
            <div class="box-title">
                <h3>بهاء تركي</h3>
                <span>خدمات العملاء</span>
            </div>
            <div class="box-social">
                <a href="#">
                    <img src="/images/phone-icon.png" alt="">
                </a>
                <a href="#">
                    <img src="/images/twitter-icon.png" alt="">
                </a>
                <a href="#">
                    <img src="/images/fb-icon.png" alt="">
                </a>
            </div>
        </v-flex>
    </v-layout>
</template>

<script type="text/babel">
    import Vue from 'vue';
    import Component from 'vue-class-component';

    @Component({})
    export default class Team extends Vue {

    }
</script>

<style scoped type="text/css">
    h2 {
        font-size: 35px;
        font-family: 'FFKhallab', serif !important;
        padding: 70px 0 20px;
    }

    p {
        font-size: 16px;
        padding-bottom: 20px;
    }

    .box-title h3 {
        padding-top: 10px;
        font-size: 19px;
    }

    .box-title span {
        font-size: 14px;
    }

    .box-social a img {
        padding: 15px 10px;
    }

</style>
