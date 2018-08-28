import Pages from './Pages'
import PageManager from './PageManager'

export default [
    {
        name: 'pages.index',
        path: '/pages',
        component: Pages,
        meta: {
            order: 4,
            requiresAuth: true,
            icon: 'import_contacts',
            menu: true,
            permission: 'view_pages'
        },

    },
    {
        name: 'pages.create',
        path: '/pages/create',
        component: PageManager,
        meta: {requiresAuth: true, permission: 'create_pages'},
    },
    {
        name: 'pages.edit',
        path: '/pages/:page/edit',
        component: PageManager,
        meta: {requiresAuth: true, permission: 'update_pages'},
    },


]
