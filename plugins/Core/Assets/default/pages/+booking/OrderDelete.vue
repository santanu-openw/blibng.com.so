<template>
    <div class="contact-page">
        <v-container>
            <v-alert
                    :value="true"
                    type="error"
            >
                هل أنت متأكد من أنك تريد حذف هذا الطلب

                <v-btn small class="red--text pull-left" @click.prevent="remove()">نعم</v-btn>
                <v-btn small class="green--text pull-left" router :to="{name: 'orders.index'}">لا</v-btn>
            </v-alert>
            <v-expansion-panel class="selected_pack" v-if="order.id">
                <v-expansion-panel-content
                        expand-icon="far fa-plus-square"
                        collapse-icon="far fa-minus-square"
                >
                    <div slot="header" class="selected_pack--header">
                        <v-layout row wrap>
                            <v-flex sm8 class="title text-xs-right">
                                <h3>{{order.package.name}}</h3>
                                <span>{{order.package.description}} </span>
                            </v-flex>
                            <v-flex sm4 class="price text-xs-center">
                                <strong>{{service_price}}</strong>
                                <span>/ ريال</span>
                            </v-flex>
                        </v-layout>
                    </div>
                    <div class="pack__details">
                        <v-layout row wrap class="pack__details--header text-xs-right">
                            <v-flex sm3 class="title">
                                الخدمات
                            </v-flex>
                            <v-flex sm3 class="title">
                                المواعيد في الأسبوع
                            </v-flex>
                            <v-flex sm2 class="title">
                                التاريخ
                            </v-flex>
                            <v-flex sm2 class="title">
                                الساعة
                            </v-flex>
                            <v-flex sm2 class="title">
                                المدة
                            </v-flex>
                        </v-layout>

                        <v-layout row wrap class="pack__details--content text-xs-right">
                            <v-flex sm3 class="content">
                                <ul>
                                    <li v-for="service of order.services" :key="service.id">
                                        {{service.name}}
                                    </li>
                                </ul>
                            </v-flex>
                            <v-flex sm3 class="content">
                                <div class="content__item" v-for="(appointment, i) of order.appointments">
                                    <b>المرة {{times[i]}}</b>
                                </div>
                            </v-flex>
                            <v-flex sm2 class="content">
                                <div class="content__item" v-for="appointment of order.appointments">
                                    {{appointment.month.padStart(2, '0')}}/{{appointment.day.padStart(2,
                                    '0')}}/{{appointment.year}}
                                </div>
                            </v-flex>
                            <v-flex sm2 class="content">
                                <div class="content__item" v-for="appointment of order.appointments">
                                    {{appointment.hour}}
                                </div>
                            </v-flex>
                            <v-flex sm2 class="content">
                                <div class="content__item" v-for="appointment of order.appointments">

                                    {{service_time}}
                                    minutes
                                </div>
                            </v-flex>
                        </v-layout>
                    </div>
                </v-expansion-panel-content>
            </v-expansion-panel>
        </v-container>
    </div>
</template>

<script type="text/babel">
    import Vue from 'vue';
    import Component from 'vue-class-component';

    @Component
    export default class OrderDelete extends Vue {
        order = {};
        times = ["الأولى", "الثانية", "الثالثة", "الرابعة", "الخامسة", "السادسة"];

        mounted() {
            this.$store.dispatch('setBreadCrumbs', [
                'orders.index',
                'orders.delete'
            ]);

            this.$http.get(`/order/${this.$route.params.order}`).then(response => this.order = response.data.data)
        }

        remove() {
            this.$http.delete(`/order/${this.$route.params.order}`).then(response => this.$router.push({name: 'orders.index'}));
        }


        get service_price() {
            let price = 0;
            this.order.services.map(service => price += service.price);
            if (this.order.id) {
                price += this.order.package.m_price;
                price += this.order.plan.m_price;
            }

            return price;
        }

        get service_time() {
            let time = 0;
            this.order.services.map(service => time += service.service_time);
            return time;
        }

    }
</script>

<style scoped type="text/css">
    .selected_pack {
        border: 1px solid #c6c8cc;
        background-color: #fff;
    }

    .selected_pack--header {
        padding: 10px 0;
    }

    .selected_pack--header .title h3 {
        font-size: 23px;
        font-family: 'FFKhallab', serif !important;
        font-weight: normal;
        color: #4b5462;
        padding-bottom: 5px;
    }

    .selected_pack--header .title span {
        font-size: 17px;
        font-family: 'DroidArabicKufiRegular', serif;
        color: #199cdb;
    }

    .selected_pack--header .price {
        color: #199cdb;
        font-size: 17px;
        font-weight: normal;
        font-family: sans-serif;
    }

    .selected_pack--header .price strong {
        font-size: 42px;
        font-weight: bolder;
    }

    .selected_pack--header .price span {
        padding-top: 15px;
        margin-top: 15px;
    }

    .pack__details--header {
        border-top: 1px solid #c6c8cc;
        border-bottom: 1px solid #c6c8cc;
        background-color: #e2e4e6;
        height: 57px;
    }

    .pack__details--header .title {
        padding: 15px;
        font-size: 18px;
        color: #4b5462;
        border-left: 1px solid #c6c8cc;
    }

    .pack__details--content .content {
        border-left: 1px solid #c6c8cc;
    }

    .pack__details--content ul {
        padding-top: 15px;
        padding-right: 30px;
        list-style-image: url('/images/ul-styler.png');
    }

    .pack__details--content .content__item {
        padding: 15px;
        border-bottom: 1px solid #c6c8cc;
    }

</style>
