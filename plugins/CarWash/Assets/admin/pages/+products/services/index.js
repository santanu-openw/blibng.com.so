import Services from './Services'
import ServiceManager from './ServiceManager'

export default [
    {
        name: 'services.index',
        path: '/services',
        component: Services,
        meta: {
            requiresAuth: true,
            menu: true,
            permission: 'view_services'
        },

    },
    {
        name: 'services.create',
        path: '/services/create',
        component: ServiceManager,
        meta: {requiresAuth: true, permission: 'create_services'},
    },
    {
        name: 'services.edit',
        path: '/services/:service/edit',
        component: ServiceManager,
        meta: {requiresAuth: true, permission: 'update_services'},
    },


]
