<template>
    <v-layout row wrap class="about-us text-xs-center">
        <v-flex sm6 class="box">
            <div class="box-img">
                <img src="/images/clean-car-icon.png">
            </div>
            <h3 class="box-title">
                تلميع السيارات من الخارج
            </h3>
            <div class="box-content">
                يتعرض الجزء الخارجي للسيارة باستمرار للتغيرات الخارجية، سواء أكانت درجة الحرارة عالية أم منخفضة،
                تعمل هذه التغيرات على تلف المظهر الخارجي للسيارة بعد مدة طويلة، وذلك تحتاج السيارة الى حماية خارجية
                من التغيرات الجوية، وهذه ما يقدمه بيلنق من خلال إستخدام البخار في حماية المظهر الخارجي للسيارة
                وبالتالي منع تأثير العوامل الجوية والحفاظ على اللمعان والمظهر الأصلي للسيارة.
            </div>
            <hr>
        </v-flex>
        <v-flex sm6>
            <img src="/images/service-1.png" class="img-responsive fluid-img">
        </v-flex>


        <v-flex sm6>
            <img src="/images/service-2.png" class="img-responsive fluid-img">
        </v-flex>
        <v-flex sm6 class="box">
            <div class="box-img">
                <img src="/images/wash-car-icon.png">
            </div>
            <h3 class="box-title">
                غسيل السيارات
            </h3>
            <div class="box-content">
                يتصف الطقس في المملكة العربية السعودية بأنه شديد الحرارة وخصوصاً في فصل الصيف؛ مما يفقد السيارات لونها
                ولمعانها الخارجي، حيث تؤثر أشعة الشمس على طلاء السيارة، كما أن الرياح الرملية والأمطار لها تأثير. للحفاظ
                على المنظر البراق لطلاء السيارة يجب الاعتناء بها من خلال التلميع وإزالة الخدوش العميقة والسطحية من
                السيارة.
            </div>
            <hr>
        </v-flex>


        <v-flex sm6 class="box">
            <div class="box-img">
                <img src="/images/inter-car-wash-icon.png">
            </div>
            <h3 class="box-title">
                تنظيف السيارات من الداخل
            </h3>
            <div class="box-content">
                إذا كنت تمتلك سيارة فأنت بحاجة إلى تنظيفها باستمرار من الداخل والخارج، وخصوصاً إذا كان لديك أطفال فقد
                تحتاج أحيانا إلى تغيير فرش السيارة من الأكل أو الشراب، ولكن يمكنك الآن مع بيلنق تنظيف فرش السيارة
                بالكامل ليصبح أقرب ما يكون إلى الشكل الأصلي. يعمل الفريق على تنظيف فرش السيارة بكامل تفاصيله من جلد أو
                نسيج ليعطي الفرش مظهراً رائعاً ورائحة نظيفة.
            </div>
            <hr>
        </v-flex>
        <v-flex sm6>
            <img src="/images/service-3.png" class="img-responsive fluid-img">
        </v-flex>
    </v-layout>
</template>

<script type="text/babel">
    import Vue from 'vue';
    import Component from 'vue-class-component';

    @Component({})
    export default class Services extends Vue {


    }
</script>

<style scoped type="text/css">
    .fluid-img {
        width: 100%;
        margin-bottom: -5px;
        min-height: 696px;
    }

    .box {
        background-color: #f1f2f0;
        padding: 50px;
    }

    .box hr {
        width: 130px;
        margin: 50px auto 0;
    }

    .box-img {
        padding-bottom: 5px;
    }

    .box-title {
        font-size: 31px;
        font-family: 'FFKhallab', serif !important;
    }

    .box-content {
        padding: 20px;
        font-size: 14px;
        line-height: 2.5;
    }
</style>
