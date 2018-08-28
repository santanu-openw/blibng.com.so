import Component from 'vue-class-component';
import DataTable from '@zix-core/admin/libraries/tablage/table';
import Vue from "vue";

@Component
export default class Resources extends Vue {

    render(h) {
        return h('div', {}, [
            h(DataTable, {
                props: {
                    apiRoute: 'admin/pages',
                    route: 'pages',
                    actions: [
                        {
                            text: 'pages.edit',
                            color: 'primary',
                            fab: true,
                            icon: 'edit',
                            callback: (item) => this.$router.push({name: 'pages.edit', params: {page: item.id}})
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
                            text: this.$t('table.title'),
                            value: `title->${this.$store.state.lang.default_lang}`,
                            align: 'right',
                            searchable: true,
                            sortable: true,
                        },

                        {
                            text: this.$t('table.slug'),
                            value: `slug`,
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
            'pages.index'
        ]);
    }
}