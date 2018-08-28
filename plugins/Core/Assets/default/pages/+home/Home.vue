<template>
    <div class="home-page">
        <v-container>
            <v-layout row wrap>
                <v-flex sm12>
                    <h2 class="text-xs-center">عن بلينق</h2>
                </v-flex>
                <v-flex sm12>
                    <p class="text-xs-center">
                        يجمع فريق بيلنق بين الخبرة الفنية والعملية من أجل تقديم أفضل الخدمات والتي تهدف إلى تحقيق نتائج
                        أكثر من
                        رائعة. مهمتنا تقديم خدمات متميزة وبأسعار في متناول الجميع. بالإضافة إلى ذلك، نقوم باستخدام مواد
                        عالية
                        الجودة في حماية طلاء السيارة من الخدوش وتلميعها لكي تحافظ على لونها في ظل التقلبات المناخية .
                        هدفنا هو
                        بناء الثقة مع عملائنا، حيث نوفر لهم الاهتمام بكافة التفاصيل الدقيقة؛ للحصول على رضى العميل. نقدم
                        العديد
                        من الخيارات في جميع مجالات تنظيف وتلميع السيارات وتقديم خدمات لا مثيل لها من بيلنق. كما نتطلع
                        الى التوسع
                        ليشمل أسواقاً جديدة – بأذن الله -
                    </p>
                </v-flex>
                <v-flex sm12>
                    <about-us-section></about-us-section>
                </v-flex>
            </v-layout>
        </v-container>
        <services-section></services-section>
        <v-container>
            <team-section></team-section>
        </v-container>
    </div>
</template>

<script type="text/babel">
    import Vue from 'vue';
    import Component from 'vue-class-component';
    import AboutUsSection from './_AboutUs'
    import ServicesSection from './_Services'
    import TeamSection from './_Team'

    @Component({
        components: {
            AboutUsSection, ServicesSection, TeamSection
        }
    })
    export default class Home extends Vue {


        mounted() {
            this.$store.dispatch('setBreadCrumbs', []);


        }

    }
</script>

<style scoped type="text/css">
    .home-page {
        color: #4b5462;
    }

    h2 {
        font-size: 58px;
        font-family: 'FFKhallab', serif !important;
        font-weight: normal;
        padding-bottom: 35px;
    }

    p {
        font-size: 14px;
        font-family: 'DroidArabicKufiRegular', serif;
        line-height: 1.8;
    }


</style>
