import Packages from './Packages'
import PackageManager from './PackageManager'

export default [
    {
        name: 'packages.index',
        path: '/packages',
        component: Packages,
        meta: {
            requiresAuth: true,
            menu: true,
            permission: 'view_packages'
        },

    },
    {
        name: 'packages.create',
        path: '/packages/create',
        component: PackageManager,
        meta: {requiresAuth: true, permission: 'create_packages'},
    },
    {
        name: 'packages.edit',
        path: '/packages/:package/edit',
        component: PackageManager,
        meta: {requiresAuth: true, permission: 'update_packages'},
    },


]
