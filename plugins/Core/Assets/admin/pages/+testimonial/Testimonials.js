import Component from 'vue-class-component';
import DataTable from '@zix-core/admin/libraries/tablage/table';
import Vue from "vue";

@Component
export default class Testimonials extends Vue {

    render(h) {
        return h('div', {}, [
            h(DataTable, {
                props: {
                    apiRoute: 'admin/testimonials',
                    route: 'testimonials',
                    actions: [
                        {
                            text: 'testimonials.edit',
                            color: 'primary',
                            fab: true,
                            icon: 'edit',
                            callback: (item) => this.$router.push({
                                name: 'testimonials.edit',
                                params: {testimonial: item.id}
                            })
                        },

                        {
                            text: 'table.delete',
                            color: 'red',
                            dark: true,
                            fab: true,
                            icon: 'delete',
                            callback: (item) => this.$events.$emit('table.delete-data', item.id)
                        }
                    ],
                    headers: [
                        {
                            text: this.$t('table.customer_name'),
                            value: 'customer_name',
                            align: 'right',
                            searchable: true,
                            sortable: true,
                        },
                        {
                            text: this.$t('table.customer_avatar'),
                            value: 'customer_avatar',
                            callback: testimonial => `<img class="avatar-img" src="${testimonial.customer_avatar}">`,
                            align: 'right',
                            searchable: true,
                            sortable: true,
                        },

                        {
                            text: this.$t('table.actions'),
                            value: 'actions',
                            align: 'right',
                        }
                    ]
                }
            })
        ])
    }

    mounted() {
        this.$store.dispatch('setBreadCrumbs', [
            'testimonials.index'
        ]);
    }
}