import Component from 'vue-class-component';
import DataTable from '@zix-core/admin/libraries/tablage/table';
import Vue from "vue";

@Component
export default class Packages extends Vue {

    render(h) {
        return h('div', {}, [
            h(DataTable, {
                props: {
                    apiRoute: 'admin/packages',
                    route: 'packages',
                    actions: [
                        {
                            text: 'packages.edit',
                            color: 'primary',
                            fab: true,
                            icon: 'edit',
                            callback: (item) => this.$router.push({name: 'packages.edit', params: {package: item.id}})
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
                            value: `name->${this.$store.state.lang.default_lang}`,
                            align: 'right',
                            searchable: true,
                            sortable: true,
                        },
                        {
                            text: this.$t('table.number_of_washes_per_week'),
                            value: 'number_of_washes_per_week',
                            align: 'right',
                            searchable: false,
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
            'packages.index'
        ]);
    }
}