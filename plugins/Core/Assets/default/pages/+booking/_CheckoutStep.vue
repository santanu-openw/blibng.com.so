<template>
    <div>
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
                            <div class="content__item" v-for="(appointment, i) of first_week_appointments">
                                <b>المرة {{times[i]}}</b>
                            </div>
                        </v-flex>
                        <v-flex sm2 class="content">
                            <div class="content__item" v-for="appointment of first_week_appointments">
                                {{String(appointment.month).padStart(2, '0')}}/{{String(appointment.day).padStart(2,
                                '0')}}/{{appointment.year}}
                            </div>
                        </v-flex>
                        <v-flex sm2 class="content">
                            <div class="content__item" v-for="appointment of first_week_appointments">
                                {{appointment.hour}}
                            </div>
                        </v-flex>
                        <v-flex sm2 class="content">
                            <div class="content__item" v-for="appointment of first_week_appointments">
                                {{service_time}}
                                minutes
                            </div>
                        </v-flex>
                    </v-layout>
                </div>
            </v-expansion-panel-content>
        </v-expansion-panel>
        <form @submit.prevent="proceed()">
            <v-layout row wrap>
                <v-flex sm6>
                    <div class="client__details">
                        <h2>تفاصيل الزبون</h2>

                        <v-text-field
                                name="full_name"
                                label="الأسم الكامل"
                                type="text"
                                v-model="client_detail.full_name"
                                required
                                :rules="messages.validation.full_name"
                                outline
                        ></v-text-field>

                        <v-text-field
                                name="email"
                                label="البريد الألكتروني"
                                type="email"
                                v-model="client_detail.email"
                                required
                                :rules="messages.validation.email"
                                outline
                        ></v-text-field>

                        <v-text-field
                                name="phone_number"
                                label="الهاتف"
                                type="text"
                                v-model="client_detail.phone_number"
                                required
                                :rules="messages.validation.phone_number"
                                outline
                        ></v-text-field>

                        <v-select
                                :items="countries"
                                v-model="client_detail.country"
                                label="الدولة"
                        ></v-select>

                        <v-select
                                v-if="states.length"
                                :items="states"
                                v-model="client_detail.city"
                                label="المدينة"
                        ></v-select>

                        <v-text-field
                                name="address"
                                label="العنوان"
                                type="text"
                                v-model="client_detail.address"
                                required
                                :rules="messages.validation.address"
                                outline
                        ></v-text-field>

                        <v-text-field
                                name="code_postal"
                                label="الرمز البريدي"
                                type="text"
                                v-model="client_detail.code_postal"
                                required
                                :rules="messages.validation.code_postal"
                                outline
                        ></v-text-field>
                    </div>
                    <div>
                        <v-btn type="submit" block color="blue" dark large>تأكيد الحجز</v-btn>
                    </div>
                </v-flex>
                <v-flex sm1></v-flex>
                <v-flex sm5>

                </v-flex>
            </v-layout>
        </form>


    </div>

</template>

<script type="text/babel">
    import Vue from 'vue';
    import Component from 'vue-class-component';
    import {mapState} from 'vuex';
    import OrderHelper from "../../libraries/OrderHelper";

    @Component({
        computed: mapState(['messages'])
    })
    export default class CheckoutStep extends Vue {

        times = ["الأولى", "الثانية", "الثالثة", "الرابعة", "الخامسة", "السادسة"];
        countries = [];
        states = [];
        client_detail = {};

        order = {user: {}};
        first_week_appointments = [];

        mounted() {
            this.$events.$on('booking:update-order', order => {
                this.order = order;
                let groups = this.groupBy(this.sortByKey(this.order.appointments, 'month'), 'month');
                let group = groups[Object.keys(groups)[0]];
                group = this.groupBy(this.sortByKey(group, 'week'), 'week');
                this.first_week_appointments = group[Object.keys(group)[0]];
            });

            this.$http.get('countries').then(response => this.countries = response.data);

            this.$http.get('user').then(response => this.client_detail = response.data.data);

            this.$watch('client_detail.country', data => {
                this.$http.get('countries/' + data).then(response => this.states = response.data);
            })
        }

        groupBy(xs, key) {
            return xs.reduce(function (rv, x) {
                (rv[x[key]] = rv[x[key]] || []).push(x);
                return rv;
            }, {});
        }

        sortByKey(array, key) {
            return array.sort(function (a, b) {
                let x = a[key];
                let y = b[key];
                return ((x < y) ? -1 : ((x > y) ? 1 : 0));
            });
        }

        proceed() {
            this.$http.post(`order/${this.order.id}/proceed`, this.client_detail).then(response => {
                console.info('proceed ::', response.data);
                window.location.href = response.data.payment_url;
            });
        }

        get service_price() {
            return OrderHelper.calculateOrderPrice(this.order);
        }

        get service_time() {
            return OrderHelper.calculateServiceTime(this.order);
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

    .client__details {
        padding-top: 50px;
    }

    .client__details h2, .credit__card h2 {
        font-size: 23px;
        font-family: 'FFKhallab', serif !important;
        font-weight: normal;
        padding-bottom: 40px;
        color: #4b5462;
    }

    .client__details .v-text-field {

    }

    .client__details .v-text-field .v-input__slot {
        background-color: #ffffff;
    }

    .credit__card {
        background-color: #e9eaeb;
        padding: 20px;
        margin-top: 35px;
    }

    .credit__card .ccv__text {
        padding: 15px 0;
    }

</style>
