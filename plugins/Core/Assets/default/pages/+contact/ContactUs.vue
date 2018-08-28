<template>
    <div class="contact-page">
        <v-container>
            <v-layout row wrap>
                <v-flex sm5>
                    <div class="title">
                        <h2>معلومات التواصل</h2>
                        <hr>
                    </div>

                    <div class="contact-info">


                        <v-layout row wrap>
                            <v-flex sm1>
                                <img src="/images/earth-icon.png">
                            </v-flex>
                            <v-flex sm10>
                                يجمع فريق بيلنق بين الخبرة الفنية والعملية
                                الرياض المملكة العربية السعودية
                            </v-flex>
                        </v-layout>
                        <br>
                        <v-layout row wrap>
                            <v-flex sm1>
                                <img src="/images/mail-icon.png">
                            </v-flex>
                            <v-flex sm10 class="custom-font">
                                info@bling.com.sa
                            </v-flex>
                        </v-layout>
                        <br>
                        <v-layout row wrap>
                            <v-flex sm1>
                                <img src="/images/w-icon.png">
                            </v-flex>
                            <v-flex sm10 class="custom-font">
                                www.bling.com.sa
                            </v-flex>
                        </v-layout>

                        <div class="hot-box">
                            <v-layout row wrap>
                                <v-flex sm3>
                                    <img src="/images/emergency-phone-icon.png">
                                </v-flex>
                                <v-flex sm9 class="hot-box__text">
                                    <strong>الخط المباشر</strong>
                                    <br>
                                    <span>1.800.555.6789</span>
                                </v-flex>
                            </v-layout>
                        </div>
                    </div>

                </v-flex>
                <v-flex sm2></v-flex>
                <v-flex sm5>
                    <div class="title">
                        <h2>إتصل بنا</h2>
                        <hr>
                    </div>
                    <form @submit.prevent="save()" v-if="!contact_sent">
                        <v-text-field
                                v-model="contact.name"
                                outline
                                label="الأسم الكامل"
                        ></v-text-field>
                        <v-text-field
                                v-model="contact.mobile_number"
                                outline
                                label="الهاتف"
                        ></v-text-field>
                        <v-text-field
                                v-model="contact.message"
                                outline
                                label="الرسالة"
                                textarea
                        ></v-text-field>

                        <v-btn :loading="$store.state.fetching" large class="contact-btn" color="primary" type="submit">
                            إرسال
                        </v-btn>
                    </form>
                    <v-alert
                            class="mt-4"
                            v-else
                            :value="true"
                            type="success"
                    >
                        تم استلام طلب الاتصال الخاص بك بنجاح
                    </v-alert>

                </v-flex>

            </v-layout>
        </v-container>
    </div>
</template>

<script type="text/babel">
    import Vue from 'vue';
    import Component from 'vue-class-component';

    @Component({})
    export default class Home extends Vue {
        contact = {};
        contact_sent = false;

        mounted() {
            this.$store.dispatch('setBreadCrumbs', [
                'contact_us'
            ]);


        }

        save() {
            this.$http.post('contact', this.contact)
                .then(res => {
                    this.contact_sent = true;
                    console.info('Contact Us Form::', this.contact)
                    console.info(res)
                })

        }

    }
</script>

<style scoped type="text/css">
    .contact-page {
        color: #4b5462;
    }

    .title h2 {
        font-size: 36px;
        font-family: 'FFKhallab', serif !important;
        font-weight: normal;
        padding-bottom: 20px;
    }

    .title hr {
        width: 113px;
        border: 1px solid #45acb7;
    }

    .custom-font {
        font-family: "Roboto", "Helvetica Neue", Helvetica, Arial, sans-serif;
    }

    .contact-info {
        padding: 45px 0;
        font-size: 16px;
    }

    .hot-box {
        margin-top: 30px;
        height: 150px;
        width: 100%;

        background: #4dc4d1; /* Old browsers */
        background: -moz-linear-gradient(left, #7883ac 30%, #4dc4d1 100%); /* FF3.6-15 */
        background: -webkit-linear-gradient(left, #7883ac 30%, #4dc4d1 100%); /* Chrome10-25,Safari5.1-6 */
        background: linear-gradient(to right, #7883ac 30%, #4dc4d1 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#7883ac', endColorstr='#4dc4d1', GradientType=1); /* IE6-9 */
    }

    .hot-box img {
        padding: 32px 15px 0 0;
    }

    .hot-box__text {
        padding: 40px 0;
        color: #FFF;
    }

    .hot-box__text strong {
        font-size: 23px;
    }

    .hot-box__text span {
        font-size: 32px;
        font-weight: bold;
        font-family: "Roboto", "Helvetica Neue", Helvetica, Arial, sans-serif;
    }

    form {
        padding-top: 40px;
    }

    .contact-btn {
        border: 1px solid #737888 !important;
        background: #7e87a2 !important;
        box-shadow: none;
    }
</style>
