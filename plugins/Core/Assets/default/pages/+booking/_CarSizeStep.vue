<template>
    <div>
        <v-layout row wrap class="items text-xl-center">
            <v-flex sm3 v-for="car of car_sizes"
                    :key="car.id"
                    :class="{'items__box': true, 'active': (car.id === order.car_size_id)}"
                    @click="() => {order.car_size_id = car.id; order.car_size = car}">
                <img class="img-blank" :src="car.img_blank">
                <img class="img-active" :src="car.img_active">
                <h3>{{car.name}}</h3>
            </v-flex>
        </v-layout>
        <div class="item_services" v-if="order.id && order.package">
            <v-expansion-panel>
                <v-expansion-panel-content
                        v-for="service of order.package.services"
                        :key="service.id"
                        expand-icon="far fa-plus-square"
                        collapse-icon="far fa-minus-square"
                        style="padding: 40px 20px 40px 20px;"
                >
                    <div slot="header" class="text-xs-right item_services--header "
                         style="display: inline-flex; height: auto;">

                        <v-layout row wrap>
                            <v-flex sm1>
                                <v-checkbox
                                        v-model="order.services"
                                        :value="service"
                                ></v-checkbox>
                            </v-flex>
                            <v-flex sm5 class="title">
                                <h3>{{service.name}}</h3> <br>
                                <span>مزيد من المعلومات</span>
                            </v-flex>
                            <v-flex sm3>
                                <div class="time" v-if="service.service_time">
                                    <v-icon>far fa-clock</v-icon>
                                    <div class="text">
                                        {{service.service_time}}
                                        دقائق لكل مرة
                                        <br>
                                        <b>
                                            في
                                            {{order.plan.name}}
                                        </b>
                                    </div>
                                </div>
                            </v-flex>
                            <v-flex sm3 class="price">
                                <strong>{{service.price}}</strong>
                                <span>/ ريال</span>
                            </v-flex>
                        </v-layout>
                    </div>
                    <v-card class="item_services--content">
                        <v-card-text class="text-xs-right">
                            {{service.description}}
                        </v-card-text>
                    </v-card>
                </v-expansion-panel-content>

            </v-expansion-panel>
            <div class="selected_pack">
                <v-layout row wrap>
                    <v-flex sm6 class="title">
                        <h3>تم إختيار {{order.package.name}}</h3> <br>
                        <span> {{order.package.description}} </span>
                    </v-flex>
                    <v-flex sm3 class="time">
                        <v-icon>far fa-clock</v-icon>
                        <div class="text">
                            {{service_time}}
                            دقائق لكل مرة
                            <br>
                            <b>في
                                {{order.plan.name}}</b>
                        </div>
                    </v-flex>
                    <v-flex sm3 class="price">
                        <strong>{{service_price}}</strong>
                        <span>/ ريال</span>
                    </v-flex>
                </v-layout>
            </div>
        </div>
        <v-alert
                :value="show_car_size_error"
                type="error"
        >
            يرجى تحديد حجم سيارتك
        </v-alert>
        <div class="stepper_buttons">
            <v-btn :disabled="!order.services.length && order.car_size_id == null" dark color="blue" @click="next()">
                التالي
                <img src="/images/chev-left.png">
            </v-btn>
            <v-spacer></v-spacer>
            <v-btn dark color="grey" @click="$emit('prev')">
                <img src="/images/chev-right.png" alt="">
                السابق
            </v-btn>

        </div>
    </div>
</template>

<script type="text/babel">
    import Vue from 'vue';
    import Component from 'vue-class-component';
    import OrderHelper from "../../libraries/OrderHelper";

    @Component
    export default class CarSizeStep extends Vue {
        page = {};
        index = null;
        car_sizes = [];
        order = {services: []};
        show_car_size_error = false;

        selected_package = {items: []};


        get service_price() {
            return OrderHelper.calculateOrderPrice(this.order);
        }

        get service_time() {
            let time = 0;
            this.order.services.map(service => time += service.service_time);
            return time;
        }

        mounted() {
            this.$http.get('/booking/car-sizes').then(response => this.car_sizes = response.data.data);
            this.$events.$on('booking:update-order', order => this.order = order);
        }

        next() {
            this.show_car_size_error = false;
            this.$http.put(`/order/${this.$route.params.order}`, {
                ...this.order,
                status: this.order.status ? this.order.status : 'Pending'
            }).then(response => {
                this.$events.$emit('booking:update-order', response.data.data);
                this.$emit('next');
            }).catch(error => {
                this.show_car_size_error = true;
            })
        }


    }
</script>

<style scoped type="text/css">
    .v-input--selection-controls {
        padding: 0;
        margin-top: 0;
        margin-bottom: 0;
    }

    .items {
        margin-bottom: -2px;
        border: 1px solid #c6c8cc;
        background-color: #e7e8ea;
    }

    .items__box {
        text-align: center;
        padding: 23px 0;
    }

    .items__box .img-active, .items__box:hover .img-blank, .items__box.active .img-blank {
        display: none;
    }

    .items__box:hover .img-active, .items__box.active .img-active {
        display: block;
        margin: 0 auto;
        padding-bottom: 5px;
    }

    .items__box:hover {
        cursor: pointer;
    }

    .items__box.active {
        margin-top: -2px;
        margin-right: -1px;
        border-top: 2px solid #199cdb;
        border-right: 1px solid #199cdb;
        border-left: 1px solid #199cdb;
        background-color: #fff;
        cursor: pointer;
    }

    .items__box:hover h3, .items__box.active h3 {
        color: #199cdb;
    }

    .items__box h3 {
        font-size: 23px;
        font-family: 'DroidArabicKufiRegular', serif;
        font-weight: bold;
        color: #afb2b7;
    }

    .item_services {
        border: 1px solid #199cdb;
    }

    .item_services--header .title {
        padding-right: 30px;
    }

    .item_services--header .title h3, .selected_pack .title h3 {
        font-size: 23px;
        font-family: 'FFKhallab', serif !important;
        font-weight: normal;
        color: #4b5462;
    }

    .item_services--header .title span, .selected_pack .title span {
        font-size: 17px;
        font-family: 'DroidArabicKufiRegular', serif;
        color: #199cdb;
    }

    .item_services--content {
        padding-right: 85px;
    }

    .item_services--content ul {
        list-style-image: url('/images/ul-styler.png');
    }

    .item_services--content ul li {
        padding-bottom: 10px;
    }

    .time, .price {
        display: inline-flex;
        padding: 5px 15px;
    }

    .time .text {
        padding-top: 10px;
        padding-right: 10px;
        color: #3d404e;
        font-family: 'DroidArabicKufiRegular', serif;
    }

    .price {
        color: #199cdb;
        font-size: 17px;
        font-weight: normal;
        font-family: sans-serif;
    }

    .price strong {
        font-size: 42px;
        font-weight: bolder;
    }

    .price span {
        padding-top: 15px;
        margin-top: 15px;
    }

    .selected_pack .title h3,
    .selected_pack .title span,
    .selected_pack .time .text,
    .selected_pack .price,
    .selected_pack .v-icon {
        color: #FFF;
    }

    .selected_pack {
        padding: 40px;
        background-color: #199cdb;
        color: #FFF;
    }

    .stepper_buttons {
        width: 100%;
        margin-top: 25px;
        display: inline-flex;
    }

    .stepper_buttons .v-btn {
        box-shadow: none;
        padding: 8px 35px;
        height: auto;
    }

    .stepper_buttons .v-btn.grey {
        color: #87898d;
        background-color: #d4d6da !important;
        border: 1px solid #a8aaad;
    }

    .stepper_buttons .v-btn.blue img {
        padding-right: 15px;
    }

    .stepper_buttons .v-btn.blue {
        background-color: #199cdb !important;
        border: 1px solid #1085be !important;
    }

    .theme--light .v-btn.v-btn--disabled:not(.v-btn--icon):not(.v-btn--flat), .application .theme--light.v-btn.v-btn--disabled:not(.v-btn--icon):not(.v-btn--flat) {
        background-color: #24b0ff !important;
        border: 1px solid #16b3ff !important;
    }
</style>
