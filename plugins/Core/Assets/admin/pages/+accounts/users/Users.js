import Component from 'vue-class-component';
import DataTable from '@zix-core/admin/libraries/tablage/table';
import Vue from "vue";

@Component
export default class Users extends Vue {

    render(h) {
        return h(DataTable, {
            props: {
                apiRoute: 'admin/users',
                route: 'accounts.users',
                actions: [
                    {
                        text: 'accounts.users.edit',
                        color: 'primary',
                        fab: true,
                        icon: 'edit',
                        callback: (item) => this.$router.push({name: 'accounts.users.edit', params: {id: item.id}})
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
                        text: this.$t('table.avatar'),
                        value: 'avatar',
                        callback: user => user.avatar ?`<img width="40px" class="avatar-img" src="${user.avatar}">` : 'N/A',
                        align: 'right',
                        searchable: true,
                        sortable: true,
                    },
                    {
                        text: this.$t('table.user_id'),
                        value: 'user_id',
                        align: 'right',
                        searchable: true,
                        sortable: true,
                    },
                    {
                        text: this.$t('table.first_name'),
                        value: 'first_name',
                        align: 'right',
                        searchable: true,
                        sortable: true,
                    },
                    {
                        text: this.$t('table.last_name'),
                        value: 'last_name',
                        align: 'right',
                        searchable: true,
                        sortable: true,
                    },
                    {
                        text: this.$t('table.email'),
                        value: 'email',
                        align: 'right',
                        searchable: true,
                        sortable: true,
                    },

                    {
                        text: this.$t('table.role'),
                        callback: user => user.roles.map(role => role.name).join(', '),
                        align: 'right',
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
            'accounts.users.index'
        ]);
    }
}