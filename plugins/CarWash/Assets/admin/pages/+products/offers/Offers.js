import Component from 'vue-class-component';
import DataTable from '@zix-core/admin/libraries/tablage/table';
import Vue from "vue";

@Component
export default class Offers extends Vue {

    render(h) {
        return h('div', {}, [
            h(DataTable, {
                props: {
                    apiRoute: 'admin/offers',
                    route: 'offers',
                    actions: [
                        {
                            text: 'offers.edit',
                            color: 'primary',
                            fab: true,
                            icon: 'edit',
                            callback: (item) => this.$router.push({name: 'offers.edit', params: {offer: item.id}})
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
                            text: this.$t('table.name'),
                            value: 'name',
                           align: 'right',
                            searchable: true,
                            sortable: true,
                        },
                        {
                            text: this.$t('table.number_of_free_washes'),
                            value: 'number_of_free_washes',
                           align: 'right',
                            searchable: true,
                            sortable: true,
                        },
                        {
                            text: this.$t('table.starts_at'),
                            value: 'starts_at',
                           align: 'right',
                            searchable: true,
                            sortable: true,
                        },
                        {
                            text: this.$t('table.ends_at'),
                            value: 'ends_at',
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
            'offers.index'
        ]);
    }
}