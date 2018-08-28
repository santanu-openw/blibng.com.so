import Component from 'vue-class-component';
import DataTable from '@zix-core/admin/libraries/tablage/table';
import Vue from "vue";

@Component
export default class Partners extends Vue {

    render(h) {
        return h('div', {}, [
            h(DataTable, {
                props: {
                    apiRoute: 'admin/partners',
                    route: 'partners',
                    actions: [
                        {
                            text: 'partners.edit',
                            color: 'primary',
                            fab: true,
                            icon: 'edit',
                            callback: (item) => this.$router.push({name: 'partners.edit', params: {partner: item.id}})
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
                            text: this.$t('table.logo'),
                            value: 'logo',
                            callback: partner => `<img width="40px" class="avatar-img" src="${partner.logo}">`,
                            align: 'right',
                            searchable: false,
                            sortable: false,
                        },
                        {
                            text: this.$t('table.name'),
                            value: `name->${this.$store.state.lang.default_lang}`,
                            align: 'right',
                            searchable: true,
                            sortable: true,
                        },
                        {
                            text: this.$t('table.website_url'),
                            value: 'website_url',
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
            'partners.index'
        ]);
    }
}