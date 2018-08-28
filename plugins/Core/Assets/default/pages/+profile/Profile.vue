<template>
    <v-container>
        <v-layout row wrap>
            <v-flex sm5>
                <div class="title">
                    <h2>اعدادات الملف الشخصي</h2>
                    <hr>
                </div>
                <form @submit.prevent="updateProfile()" class="pt-4">
                    <v-text-field
                            name="first_name"
                            :label="$t('table.full_name')"
                            v-model="user.full_name"
                            :rules="messages.validation.full_name"
                            outline
                            required
                            minlength="3"
                            maxlength="255"
                    ></v-text-field>

                    <v-text-field
                            name="email"
                            type="email"
                            :label="$t('table.email')"
                            v-model="user.email"
                            :rules="messages.validation.email"
                            outline
                            required
                            minlength="3"
                            maxlength="255"
                    ></v-text-field>
                    <v-text-field
                            name="phone_number"
                            :label="$t('table.phone_number')"
                            v-model="user.phone_number"
                            :rules="messages.validation.phone_number"
                            outline
                            required
                            minlength="3"
                            maxlength="255"
                    ></v-text-field>

                    <v-btn color="primary" :loading="$store.state.fetching" type="submit">
                        تحديث
                    </v-btn>
                    <v-btn color="default" router :to="{name: 'accounts.users.index'}" type="reset">
                        {{ $t('form.cancel') }}
                    </v-btn>
                    <br><br><br>
                </form>
            </v-flex>
            <v-flex sm2></v-flex>
            <v-flex sm5>
                <div class="title">
                    <h2>تغيير الصورة الرمزية</h2>
                    <hr>
                </div>
                <form @submit.prevent="uploadUserAvatar()" class="pt-4">
                    <file-upload @input="setUserAvatar"></file-upload>
                    <v-btn color="primary" :loading="$store.state.fetching" type="submit">
                        تغيير
                    </v-btn>
                </form>
                <v-avatar v-if="user.avatar"
                          size="240"
                          color="grey lighten-4"
                >
                    <img :src="user.avatar" alt="avatar">
                </v-avatar>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script type="text/babel">
    import Vue from 'vue';
    import Component from 'vue-class-component';
    import {mapState} from 'vuex';
    import FileUpload from "../../libraries/FileUpload";

    @Component({
        computed: mapState(['messages']),
        components: {
            FileUpload
        }
    })
    export default class Profile extends Vue {
        avatar_form = {};
        user = {};
        password = {};
        roles = [];
        genders = ['Men', 'Women'];
        langs = ['en', 'fr'];
        image = null;

        mounted() {
            /*
             * Set Page BreadCrumb
             */
            this.$store.dispatch('setBreadCrumbs', [
                'profile.index'
            ]);
            this.$http.get('user').then(response => this.user = response.data.data);

        }

        updatePassword() {
            this.$http.post('user/update-password', this.password)
                .then(response => {
                    this.$events.$emit('notify', {
                        type: 'success',
                        title: 'Success !',
                        message: "Your password was update successfully"
                    });
                    this.password = {};
                });
        }

        updateProfile() {
            this.$http.post('user', this.user)
                .then(response => {
                    this.$events.$emit('notify', {
                        type: 'success',
                        title: 'Success !',
                        message: "Your profile was update successfully"
                    });
                });
        }

        setUserAvatar(files) {
            let file = files[0];
            let reader = new FileReader();
            let vm = this;
            reader.onload = (e) => {
                vm.user.avatar = e.target.result;
            };
            reader.readAsDataURL(file);
        }

        uploadUserAvatar() {
            this.$http.put('user/update-avatar', {avatar: this.user.avatar})
                .then(response => {
                    this.$events.$emit('notify', {
                        type: 'success',
                        title: 'Success !',
                        message: "Your Avatar was updated successfully"
                    });
                });
        }


    }
</script>

<style scoped type="text/css">
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
</style>
