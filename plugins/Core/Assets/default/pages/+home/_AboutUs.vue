<template>
    <v-layout row wrap class="about-us">
        <v-flex sm3>
            <div class="box text-xs-center">
                <div class="box-img">
                    <img src="/images/24h-icon.png" alt="">
                </div>
                <h3 class="box-title">
                    خدمة طول ألأسبوع
                </h3>
                <div class="box-content">
                    هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل
                    الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها
                    تعطي توزيعاَ طبيعياَ -إلى حد ما- للأحرف عوضاً عن استخدام "هنا يوجد محتوى نصي
                </div>
                <a href="#" class="box-link">
                    مزيد من المعلومات
                </a>
            </div>

            <v-flex sm12>
                <br><br><br><br><br>
            </v-flex>
        </v-flex>
        <v-flex sm1></v-flex>
        <v-flex sm3>
            <div class="box text-xs-center">
                <div class="box-img">
                    <img src="/images/medal-icon.png" alt="">
                </div>
                <h3 class="box-title">
                    أجود الخدمات
                </h3>
                <div class="box-content">
                    هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل
                    الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها
                    تعطي توزيعاَ طبيعياَ -إلى حد ما- للأحرف عوضاً عن استخدام هنا يوجد محتوى نصي
                </div>
                <a href="#" class="box-link">
                    مزيد من المعلومات
                </a>
            </div>

            <v-flex sm12>
                <br><br><br><br><br>
            </v-flex>
        </v-flex>
        <v-flex sm1></v-flex>
        <v-flex sm3>
            <div class="box text-xs-center">
                <div class="box-img">
                    <img src="/images/price-icon.png" alt="">
                </div>
                <h3 class="box-title">
                    أسعار في المتناول
                </h3>
                <div class="box-content">
                    هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل
                    الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها
                    تعطي توزيعاَ طبيعياَ -إلى حد ما- للأحرف عوضاً عن استخدام هنا يوجد محتوى نصي
                </div>
                <a href="#" class="box-link">
                    مزيد من المعلومات
                </a>
            </div>

            <v-flex sm12>
                <br><br><br><br><br>
            </v-flex>
        </v-flex>

    </v-layout>
</template>

<script type="text/babel">
    import Vue from 'vue';
    import Component from 'vue-class-component';

    @Component({})
    export default class AboutUs extends Vue {

    }
</script>

<style scoped type="text/css">

    .box {
        padding: 15px 0;
    }

    .box-img {
        padding-bottom: 35px;
    }

    .box-title {
        font-size: 21px;
    }

    .box-content {
        padding: 20px 0 10px;
    }
</style>
