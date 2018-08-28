<template>
    <div class="contact-page">
        <v-container>
            <v-stepper v-model="step" class="booking__stepper">
                <v-stepper-header class="booking__stepper--header">
                    <v-stepper-step :complete="select_plan_completed" step="1">
                        <div class="pack__box" @click.prevent="goToStep('1', select_plan_completed)">
                            <div v-if="!select_plan_completed" class="pack__box--step">
                                <strong>1</strong>/4
                            </div>
                            <div v-else class="pack__box--step">
                                <img src="/images/check.png">
                            </div>
                            <div class="pack__box--info">
                                <h2>نوع الباقة</h2>
                                <p>ماهي الباقة المفضلة لسيارتك ?</p>
                            </div>
                        </div>
                    </v-stepper-step>

                    <v-stepper-step :complete="car_size_completed" step="2">
                        <div class="pack__box" @click.prevent="goToStep('2', car_size_completed)">
                            <div v-if="!car_size_completed" class="pack__box--step">
                                <strong>2</strong>/4
                            </div>
                            <div v-else class="pack__box--step">
                                <img src="/images/check.png">
                            </div>
                            <div class="pack__box--info">
                                <h2>حجم السيارة</h2>
                                <p>ماهو الحجم لسيارتك ?</p>
                            </div>
                        </div>
                    </v-stepper-step>

                    <v-stepper-step :complete="appointments_step_completed" step="3">
                        <div class="pack__box" @click.prevent="goToStep('3', appointments_step_completed)">
                            <div v-if="!appointments_step_completed" class="pack__box--step">
                                <strong>3</strong>/4
                            </div>
                            <div v-else class="pack__box--step">
                                <img src="/images/check.png">
                            </div>

                            <div class="pack__box--info">
                                <h2>المواعيد</h2>
                                <p>ماهي الموعيد المناسبة ?</p>
                            </div>
                        </div>
                    </v-stepper-step>

                    <v-stepper-step step="4">
                        <div class="pack__box" @click.prevent="goToStep('4', (appointments_step_completed && car_size_completed && !select_plan_completed))">
                            <div class="pack__box--step">
                                <strong>4</strong>/4
                            </div>
                            <div class="pack__box--info">
                                <h2>تفاصيل الحجز</h2>
                                <p>بيانات العميل ?</p>
                            </div>
                        </div>
                    </v-stepper-step>


                </v-stepper-header>

                <v-stepper-items>
                    <v-stepper-content step="1">
                        <select-plan-step @next="next()"></select-plan-step>
                    </v-stepper-content>
                    <v-stepper-content step="2">
                        <car-size-step @next="next()" @prev="prev()"></car-size-step>
                    </v-stepper-content>
                    <v-stepper-content step="3">
                        <calendar-step @next="next()" @prev="prev()"></calendar-step>
                    </v-stepper-content>
                    <v-stepper-content step="4">
                        <checkout-step></checkout-step>
                    </v-stepper-content>

                </v-stepper-items>
            </v-stepper>

        </v-container>
    </div>
</template>

<script type="text/babel">
    import Vue from 'vue';
    import Component from 'vue-class-component';
    import SelectPlanStep from './_SelectPlanStep';
    import CarSizeStep from './_CarSizeStep';
    import CalendarStep from './_CalendarStep'
    import CheckoutStep from './_CheckoutStep'

    @Component({
        components: {
            SelectPlanStep,
            CarSizeStep,
            CalendarStep,
            CheckoutStep
        }
    })
    export default class Booking extends Vue {
        page = {};
        index = null;
        step = 1;
        order = {services: [], appointments: []};

        get select_plan_completed() {
            return !!(this.order.package_id && this.order.plan_id);
        }

        get car_size_completed() {
            return !!(this.order.car_size_id && this.order.services.length);
        }

        get appointments_step_completed() {
            return !!(this.order.appointments.length)
        }

        mounted() {
            this.$store.dispatch('setBreadCrumbs', [
                'orders.index',
                'orders.edit',
            ]);

            if (this.$route.query.step) {
                this.$nextTick(() => {
                    this.step = this.$route.query.step;
                });
            }

            if (this.$route.params.order) {
                this.$http.get(`/order/${this.$route.params.order}`).then(response => {
                    this.order = response.data.data;
                    this.$events.$emit('booking:update-order', response.data.data);
                })
            }

            this.$events.$on('booking:update-order', order => this.order = order);

        }

        goToStep(step, completed) {
            if (completed) {
                this.$router.push({query: {step: step}});
                this.step = step;
            }
        }

        next() {
            this.step++;
            this.$router.push({query: {step: this.step}});
            this.$route.query.step = this.step;
        }

        prev() {
            this.step--;
            this.$router.push({query: {step: this.step}});
            this.$route.query.step = this.step;
        }


    }
</script>

<style scoped type="text/css">

    .v-stepper {
        background: transparent;
        box-shadow: none;
    }

    .v-stepper__header {
        height: auto;
    }

    .v-stepper__step__step {
        display: none;
    }

    .v-stepper__content {
        padding: 0;
    }

    .booking__stepper--header {
        padding-bottom: 40px;
    }

    .pack__box {
        display: inline-flex;
    }

    .pack__box--step {
        width: 55px;
        height: 55px;
        border-radius: 50%;
        background-color: #a8b1b6;
        border: 1px solid #a8b1b6;
        text-align: center;
        color: #FFF;
        font-size: 12px;
        font-family: monospace;
        padding-top: 5px;
    }

    .pack__box--info {
        padding: 10px 15px 0 0;
        color: #a8b1b6;
        font-size: 12px;
        text-align: right;

    }

    .pack__box--info h2 {
        font-family: 'FFKhallab', serif !important;
        font-weight: normal;
        font-size: 23px;
    }

    .pack__box--step strong {
        font-size: 26px;
    }

    .pack__box:hover {
        cursor: pointer;
    }

    .pack__box:hover .pack__box--step, .v-stepper__step--active .pack__box .pack__box--step {
        background-color: #199cdb;
        border: 1px solid #1785ba;
    }

    .pack__box:hover .pack__box--info, .v-stepper__step--active .pack__box .pack__box--info {
        color: #199cdb;
    }

    .v-stepper__step--complete .pack__box .pack__box--info {
        color: #709d66;
    }

    .v-stepper__step--complete .pack__box .pack__box--step {
        background-color: #709d66;
        border: 1px solid #5f8955;
    }

    .v-stepper__step--complete .pack__box .pack__box--step img {
        padding-top: 7px;
    }

    .stepper_buttons {
        width: 100%;
        padding-top: 15px;
        display: inline-flex;
    }

    .stepper_buttons .v-btn {
        box-shadow: none;
        padding: 8px 35px;
        height: auto;
    }

    .stepper_buttons .v-btn.grey img {
        padding-left: 15px;
    }

    .stepper_buttons .v-btn.blue img {
        padding-right: 15px;
    }

    .stepper_buttons .v-btn.grey {
        color: #87898d;
        background-color: #d4d6da !important;
        border: 1px solid #a8aaad;
    }

    .stepper_buttons .v-btn.blue {
        background-color: #199cdb !important;
        border: 1px solid #1085be;
    }


</style>
