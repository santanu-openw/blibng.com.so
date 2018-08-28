<template>
    <div>
        <div class="calendar">
            <v-layout row wrap class="calendar__header">
                <v-flex sm3>
                    <v-btn fab @click="moveNextWeek()">
                        <img src="/images/prev.png">
                    </v-btn>
                </v-flex>
                <v-flex sm6 class="text-sm-center calendar__header--date">
                    {{ header.label }}
                </v-flex>
                <v-flex sm3 class="text-sm-left">
                    <v-spacer></v-spacer>
                    <v-btn fab @click="movePreviousWeek()">
                        <img src="/images/next.png">
                    </v-btn>
                </v-flex>
            </v-layout>
            <div class="calendar__days">
                <div class="day" v-for='day in week' :key="day.label+day.name">
                    <div class="disabled__layer" v-if="!day.label"></div>
                    <div class="day__title">
                        <div class="day__title--name">
                            {{day.name}}
                        </div>
                        <br>
                        <div class="day__title--number">{{day.label}}</div>
                    </div>
                    <div class="day__hours" v-if="day_working_hours_show_more[day.label]">
                        <v-btn outline round
                               :class="{'active': isBookingHourActive(day, working_hour)}"
                               v-for="working_hour of  working_hours"
                               :key="day.name+day.label+working_hour.id"
                               @click.native="selectBookingHours(day, working_hour)"
                               :disabled="canAddBooking(day)"
                        >
                            {{working_hour.name}}
                        </v-btn>

                        <v-btn outline round @click.native="dayShowLess(day)">
                            أقل...
                        </v-btn>
                    </div>
                    <div class="day__hours" v-else>
                        <v-btn outline round
                               :class="{'active': isBookingHourActive(day, working_hour)}"
                               v-for="working_hour of  working_hours.slice(0, 6)"
                               :key="day.name+day.label+working_hour.id"
                               @click.native="selectBookingHours(day, working_hour)"
                               :disabled="canAddBooking(day)"
                        >
                            {{working_hour.name}}
                        </v-btn>

                        <v-btn outline round @click.native="dayShowMore(day)">
                            المزيد...
                        </v-btn>
                    </div>
                </div>
            </div>
        </div>

        <div class="pt-3 pb-3">
            <h3>عدد الغسلات في الإشتراك :
                {{number_of_washes_per_plan}} / {{appointments.length}}
            </h3> <br>
            <h3>عدد الغسلات في الإسبوع :
                {{number_of_washes_per_week}} / {{current_week_appointments.length}}
            </h3> <br>

            <v-btn color="primary" @click.prevent="applyForOtherWeek()"
                   v-if="current_week_appointments.length">
                تطبيق
            </v-btn>

        </div>

        <v-data-table
                :headers="appointment_table_headers"
                :items="current_week_appointments"
                hide-actions
                class="elevation-1 mt-3"
        >
            <template slot="items" slot-scope="props">
                <td>
                    <ul>
                        <li v-for="service of order.services" :key="service.id">
                            {{service.name}}
                        </li>
                    </ul>
                </td>
                <td class="text-xs-right">
                    {{String(props.item.month).padStart(2, '0')}}/{{String(props.item.day).padStart(2,
                    '0')}}/{{props.item.year}}
                </td>
                <td class="text-xs-right">{{ props.item.hour}}</td>
                <td class="text-xs-right">{{ service_time }} minutes</td>
            </template>
        </v-data-table>

        <div class="stepper_buttons">
            <v-btn :disabled="!order.services.length" dark color="blue" @click="next()">
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
    import Component from 'vue-class-component';
    import CalendarHelper from './CalendarHelper'
    import OrderHelper from "../../libraries/OrderHelper";

    @Component
    export default class CalendarStep extends CalendarHelper {
        day_working_hours_show_more = [];
        appointments = [];
        order = {services: [], package: {}, plan: {}, appointments: []};
        appointment_table_headers = [
            {
                text: 'الخدمات',
                align: 'right',
                sortable: false,
                value: 'name'
            },
            {
                text: 'التاريخ',
                align: 'right',
                sortable: true,
                value: 'day'
            },
            {
                text: 'الساعة',
                align: 'right',
                sortable: false,
                value: 'name'
            },
            {
                text: 'المدة',
                align: 'right',
                sortable: false,
                value: 'name'
            },
        ];

        mounted() {
            this.$events.$on('booking:update-order', order => {
                this.order = order;
                this.appointments = order.appointments;
            });

            this.current_week = parseInt(this.today.day / 7);
        }


        get number_of_plan_weeks() {
            return parseInt(this.order.plan.period_days / 7);
        }

        get number_of_washes_per_plan() {
            return (this.number_of_plan_weeks * this.number_of_washes_per_week);
        }

        get number_of_washes_per_week() {
            return this.order.package.number_of_washes_per_week;
        }

        get current_week_appointments() {
            let day = this.week[0];
            return this.appointments.filter(appointment => (appointment.week === day.weekNumber && appointment.month === day.month));
        }

        get service_time() {
            return OrderHelper.calculateServiceTime(this.order);
        }

        canAddBooking(day) {
            return (this.month <= this.today.month && day.number <= this.today.day);
        }

        next() {
            this.$http.put(`/order/${this.$route.params.order}`, {
                ...this.order,
                appointments: this.appointments
            }).then(response => {
                this.$events.$emit('booking:update-order', response.data.data);
                this.$emit('next');
            });
        }

        selectBookingHours(day, working_hour) {
            if (this.isBookingHourActive(day, working_hour)) {
                this.appointments = this.appointments.filter(appointment => !(appointment.day === parseInt(day.label) && appointment.hour === working_hour.name))
            } else if (this.canAddBooking(day)) {
                return;
            } else if (this.isHittingTheWeeklyLimit(day)) {
                return;
            } else if (this.isHittingTheMountlyLimit()) {
                return;
            } else {
                this.appointments.push({
                    day: (parseInt(day.label) ? parseInt(day.label) : 1),
                    week: day.weekNumber,
                    weekdayNumber: day.weekdayNumber,
                    hour: working_hour.name,
                    month: day.month,
                    year: this.year,
                    car_numbers: '',
                });
            }

            this.$nextTick(() => {
                this.$forceUpdate();
            });

        }

        applyForOtherWeek() {
            let current_week_appointments = this.current_week_appointments;
            for (let i = 1; i <= this.number_of_plan_weeks; i++) {
                this.moveNextWeek();
                current_week_appointments.map(appointment => {
                    let day = this.week.filter(_day => _day.weekdayNumber === appointment.weekdayNumber)[0];
                    if (day) {
                        this.selectBookingHours(day, {
                            name: appointment.hour
                        });
                    }
                });
            }
        }

        isHittingTheWeeklyLimit(day) {
            let current_week_appointments = this.appointments.filter(appointment => appointment.week === day.weekNumber);
            return (
                (current_week_appointments.length >= this.number_of_washes_per_week) &&
                (this.appointments.length <= this.number_of_washes_per_plan)
            );
        }

        isHittingTheMountlyLimit() {
            return (this.appointments.length >= this.number_of_washes_per_plan);
        }

        isBookingHourActive(day, working_hour) {
            return !!this.appointments.filter(appointment => (appointment.day == day.label && appointment.hour == working_hour.name && appointment.month == day.month)).length
        }

        dayShowMore(day) {
            this.day_working_hours_show_more[day.label] = 'show';
            this.$forceUpdate();
        }

        dayShowLess(day) {
            this.day_working_hours_show_more[day.label] = null;
            this.$forceUpdate();
        }
    }
</script>

<style scoped type="text/css">
    .calendar {
        border: 1px solid #aeafb1;
        background: #FFF;
    }

    .calendar__header {
        border-bottom: 1px solid #aeafb1;
    }

    .calendar__header--date {
        color: #00000a;
        padding: 13px;
        font-size: 30px;
    }

    .calendar__header .v-btn--floating {
        box-shadow: none;
        background-color: transparent !important;
    }

    .calendar__days {
        display: inline-flex;
    }

    .day {
        width: 14.29%;
        border-left: 1px solid #aeafb1;
        position: relative;
    }

    .day .disabled__layer {
        position: absolute;
        bottom: 0;
        background-color: rgba(99, 107, 111, 0.3);
        width: 100%;
        height: 100%;
    }

    .day__title {
        padding: 10px;
        background-color: #efeff1;
        height: 105px;
        border-bottom: 1px solid #aeafb1;
    }

    .day__title--name {
        color: #7a8489;
        float: right;
        font-size: 16px;
        margin-bottom: 5px;
        width: 100%;
    }

    .day__title--number {
        border: 1px solid #aeafb1;
        border-radius: 50%;
        background: #FFF;
        padding: 5px 12px;
        font-size: 20px;
        width: 45px;
        height: 45px;
        float: left;
    }

    .day__hours {
        /*height: 500px;*/
        background-color: #fff;
        text-align: center;
        padding-top: 15px;
    }

    .day__hours .v-btn {
        margin: 10px auto;
        border-color: #aeafb1;
        color: #19212d;
        width: 125px;
        height: 42px;
    }

    .day__hours .v-btn.v-btn--outline.active, .day__hours .v-btn:hover {
        background-color: #199cdb !important;
        border-color: #199cdb !important;
        color: #ffffff;
    }

    .day__hours .v-btn.v-btn--disabled.v-btn--outline.v-btn--depressed.v-btn--round {
        opacity: 0.8;
        background-color: #fff !important;
        border-color: #aeafb1 !important;
        color: #19212d;
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
