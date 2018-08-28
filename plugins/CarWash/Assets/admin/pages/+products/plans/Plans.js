import Component from 'vue-class-component';
import DataTable from '@zix-core/admin/libraries/tablage/table';
import Vue from "vue";

@Component
export default class Plans extends Vue {

    render(h) {
        return h('div', {}, [
            h(DataTable, {
                props: {
                    apiRoute: 'admin/plans',
                    route: 'plans',
                    actions: [
                        {
                            text: 'plans.edit',
                            color: 'primary',
                            fab: true,
                            icon: 'edit',
                            callback: (item) => this.$router.push({
                                name: 'plans.edit',
                                params: {plan: item.id}
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
                            text: this.$t('table.order'),
                            value: 'order',
                            align: 'right',
                            searchable: false,
                            sortable: true,
                        },
                        {
                            text: this.$t('table.name'),
                            value: `name`,
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
            'plans.index'
        ]);
    }
}