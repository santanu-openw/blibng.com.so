import Component from 'vue-class-component';
import DataTable from '@zix-core/admin/libraries/tablage/table';
import Vue from "vue";

@Component
export default class Roles extends Vue {

    render(h) {
        return h(DataTable, {
            props: {
                apiRoute: 'admin/roles',
                route: 'accounts.roles',
                actions: [
                    {
                        text: 'accounts.roles.edit',
                        color: 'primary',
                        fab: true,
                        icon: 'edit',
                        callback: (item) => this.$router.push({name: 'accounts.roles.edit', params: {id: item.id}})
                    },
                    {
                        text: 'accounts.roles.permissions',
                        color: 'default',
                        fab: true,
                        icon: 'settings_input_component',
                        callback: (item) => this.$router.push({name: 'accounts.roles.permissions', params: {id: item.id}})
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
                        text: this.$t('table.guard_name'),
                        value: 'guard_name',
                        align: 'right',
                        searchable: true,
                        sortable: true,
                    },
                    {
                        text: this.$t('table.total_permissions'),
                        callback: data => data.permissions.length,
                        align: 'right',
                        searchable: false,
                        sortable: false,
                    },
                    {
                        text: this.$t('table.actions'),
                        value: 'actions',
                        align: 'right',
                    }
                ]
            }
        })
    }

    mounted() {
        this.$store.dispatch('setBreadCrumbs', [
            'accounts.roles.index'
        ]);
    }
}