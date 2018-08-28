<template>
    <div class="contact-page">
        <v-container>
            <v-btn color="blue" class="mb-3" dark router :to="{name: 'orders.create'}">
                إنشاء طلب جديد
            </v-btn>
            <v-expansion-panel class="selected_pack">
                <v-expansion-panel-content
                        expand-icon="far fa-plus-square"
                        collapse-icon="far fa-minus-square"
                        v-for="order of orders" :key="order.id"
                >
                    <div slot="header" class="selected_pack--header">
                        <v-layout row wrap>
                            <v-flex sm2 class="pl-5">
                                <v-btn color="blue" router :to="{name: 'orders.edit', params: {order: order.id}}" fab small dark><v-icon>edit</v-icon></v-btn>
                                <v-btn color="red" v-if="order.status !== 'Paid'" router :to="{name: 'orders.delete', params: {order: order.id}}" fab small dark><v-icon>delete</v-icon></v-btn>
                            </v-flex>
                            <v-flex sm4 class="title text-xs-right">
                                <h3>{{order.package.name}}</h3>
                                <span>{{order.package.description}} </span>
                            </v-flex>
                            <v-flex sm2 class="order_status">
                                {{orderStatus(order)}} <br>
                                <small class="grey--text" v-if="order.payment_reference">إشارة دفع: {{order.payment_reference}}</small>
                                <br>
                                <small class="grey--text" v-if="order.bill_number">رقم الفاتوره: {{order.bill_number}}</small>
                            </v-flex>
                            <v-flex sm4 class="price text-xs-center">
                                <strong>{{service_price(order)}}</strong>
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
                                    {{String(appointment.month).padStart(2, '0')}}/{{String(appointment.day).padStart(2,
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

                                    {{service_time(order)}}
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
    import OrderHelper from "../../libraries/OrderHelper";

    @Component
    export default class Orders extends Vue {
        orders = [];
        times = ["الأولى", "الثانية", "الثالثة", "الرابعة", "الخامسة", "السادسة"];

        mounted() {
            this.$store.dispatch('setBreadCrumbs', [
                'orders.index'
            ]);

            this.$http.get('/order/all').then(response => {
                this.orders = response.data.data;
                if(!this.orders.length) {
                    this.$router.push({name: 'orders.create'});
                }
            });
        }

        orderStatus(order) {
            switch (order.status) {
                case 'Paid':
                    return 'مدفوع';
                case 'Not Paid':
                    return 'لم تدفع بعد';
                case 'Pending':
                    return 'قيد الانتظار';
            }
        }


        service_price(order) {
            return OrderHelper.calculateOrderPrice(order);
        }

        service_time(order) {
            let time = 0;
            order.services.map(service => time += service.service_time);
            return time;
        }
    }
</script>

<style scoped type="text/css">
    .selected_pack {
        border: 1px solid #c6c8cc;
        border-bottom: none;
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

    .selected_pack--header .price,
    .selected_pack--header .order_status {
        color: #199cdb;
        font-size: 17px;
        font-weight: normal;
        font-family: sans-serif;
    }

    .selected_pack--header .v-btn {
        box-shadow: none;
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
