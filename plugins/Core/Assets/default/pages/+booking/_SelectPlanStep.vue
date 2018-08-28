<template>
    <div>
        <v-layout row wrap class="items text-xl-center">
            <v-flex sm2 v-for="plan of plans"
                    :key="plan.id"
                    :class="{'items__box': true, 'active': (plan.id === selected_plan.id)}"
                    @click="() => selected_plan = plan">
                <img class="img-blank" :src="plan.img_blank">
                <img class="img-active" :src="plan.img_active">
                <h3>{{plan.name}}</h3>
            </v-flex>
        </v-layout>
        <div class="item_services">
            <v-expansion-panel>
                <v-radio-group v-model="selected_package">
                    <v-expansion-panel-content
                            v-for="item of selected_plan.packages"
                            :key="item.id"
                            expand-icon="far fa-plus-square"
                            collapse-icon="far fa-minus-square"
                            style="padding: 40px 20px 40px 20px;"
                    >
                        <div slot="header" class="text-xs-right item_services--header "
                             style="display: inline-flex; height: auto;">
                            <v-radio color="blue"
                                     :value="item.id"
                            ></v-radio>
                            <div class="title">
                                <h3>{{item.name}}</h3> <br>
                                <span>{{item.description}}</span>
                            </div>
                        </div>
                        <v-card class="item_services--content">
                            <v-card-text class="text-xs-right">
                                <ul>
                                    <li v-for="service of item.services" :key="service.id">
                                        {{service.name}}
                                    </li>

                                </ul>
                            </v-card-text>
                        </v-card>
                    </v-expansion-panel-content>
                </v-radio-group>

            </v-expansion-panel>
        </div>
        <div class="stepper_buttons">
            <v-btn :disabled="!selected_package" dark color="blue" @click="next()">
                التالي
                <img src="/images/chev-left.png" alt="">
            </v-btn>

        </div>
    </div>
</template>

<script type="text/babel">
    import Vue from 'vue';
    import Component from 'vue-class-component';

    @Component
    export default class PackageType extends Vue {
        index = null;
        selected_package = null;
        selected_plan = {packages: []};
        order = {};
        plans = [];

        get completed() {
            return (this.selected_package && this.selected_plan.id && this.order.id)
        }

        mounted() {
            this.$http.get('/booking/plans').then(response => {
                this.plans = response.data.data;
                if (!this.selected_plan.id) {
                    this.selected_plan = this.plans[0];
                }
            });

            this.$events.$on('booking:update-order', order => {
                this.order = order;
                this.selected_plan = order.plan;
                this.selected_package = order.package.id;
            });
        }

        next() {
            this.$route.params.order ? this.update() : this.create();
        }

        update() {
            this.$http.put(`/order/${this.$route.params.order}`, {
                package_id: this.selected_package,
                plan_id: this.selected_plan.id
            }).then(response => {
                this.$events.$emit('booking:update-order', response.data.data);
                this.$emit('completed');
                this.$emit('next');
            });
        }

        create() {
            this.$http.post('/order', {
                package_id: this.selected_package,
                plan_id: this.selected_plan.id
            }).then(response => {
                this.$router.push({name: 'orders.edit', params: {order: response.data.data.id}, query: {step: 2}});
                this.$events.$emit('booking:update-order', response.data.data);
                this.$emit('completed');
                this.$emit('next');
            });
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

    .items__box.flex.sm2 {
        flex-basis: 20%;
        max-width: 20%;

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

    .item_services--header .title h3 {
        font-size: 23px;
        font-family: 'FFKhallab', serif !important;
        font-weight: normal;
        color: #4b5462;
    }

    .item_services--header .title span {
        font-size: 17px;
        font-family: 'DroidArabicKufiRegular', serif;
        color: #199cdb;
    }

    .item_services--content {
        padding-right: 110px;
    }

    .item_services--content ul {
        list-style-image: url('/images/ul-styler.png');
    }

    .item_services--content ul li {
        padding-bottom: 10px;
    }

    .stepper_buttons {
        margin-top: 25px;
    }

    .stepper_buttons .v-btn {
        box-shadow: none;
        padding: 8px 35px;
        height: auto;
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
