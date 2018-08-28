<template>
    <form @submit.prevent="save()">
        <v-card class="mb-3">
            <v-card-text>
                <v-text-field
                        name="name"
                        :label="$t('table.name')"
                        v-model="plan.name"
                        :rules="messages.validation.name"
                        minlength="3"
                        maxlength="255"
                ></v-text-field>

                <v-text-field
                        name="period_days"
                        :label="$t('table.period_days')"
                        v-model="plan.period_days"
                        :rules="messages.validation.period_days"
                        type="number"
                ></v-text-field>


                <mavon-editor
                        placeholder="Resource Description"
                        language="en"
                        v-model="plan.description"
                ></mavon-editor>

                <br>
                <b>{{$t('table.price_calculator')}}</b>
                <v-select
                        :items="['+', '*', '/', '-']"
                        v-model="plan.m_operation"
                        :label="$t('table.mathematical_operation')"
                ></v-select>
                <v-text-field
                        name="name"
                        :label="$t('table.m_price')"
                        v-model="plan.m_price"
                        :rules="messages.validation.m_price"
                ></v-text-field>


            </v-card-text>
        </v-card>

        <v-btn color="primary" :loading="$store.state.fetching" type="submit">
            <i v-if="$store.state.fetching" class="fa fa-spinner fa-pulse"></i>
            {{ edit ? $t('form.edit') : $t('form.create') }}
        </v-btn>
        <v-btn color="default" router :to="{name: 'plans.index'}" type="reset">
            {{ $t('form.cancel') }}
        </v-btn>
    </form>
</template>

<script type="text/babel">
    import Vue from 'vue';
    import Component from 'vue-class-component';
    import {mapState} from 'vuex';

    @Component({
        computed: mapState(['messages'])
    })
    export default class PlanManager extends Vue {
        plan = {name: {}, description: {}, package: {name: {}}};
        packages = [];

        mounted() {
            /*
             * Set Page BreadCrumb
             */
            this.$store.dispatch('setBreadCrumbs', [
                'plans.index',
                'plans.' + (this.edit ? 'edit' : 'add')
            ]);
            if (this.edit) {
                this.$http.get('admin/plans/' + this.$route.params.plan).then(response => this.plan = response.data.data);
            }

            this.$http.get('admin/packages').then(response => this.packages = response.data.data);

        }

        get edit() {
            return !!this.$route.params.plan;
        }


        save() {
            // if form for create
            return this.edit ? this.update() : this.create();
        }

        create() {
            this.$http.post(`admin/plans`, this.plan)
                .then(response => {
                    this.$events.$emit('notify', {
                        type: 'info',
                        title: 'Success !',
                        message: this.$t('notifications.data.created_successfully')
                    });
                    this.$router.push({name: 'plans.index'});
                });
        }

        update() {
            this.$http.put(`admin/plans/${this.$route.params.plan}`, this.plan)
                .then(response => {
                    this.$events.$emit('notify', {
                        type: 'info',
                        title: 'Success !',
                        message: this.$t('notifications.data.updated_successfully')
                    });
                    this.$router.push({name: 'plans.index'});
                });
        }


    }
</script>
