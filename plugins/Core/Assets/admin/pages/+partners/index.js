import Partners from './Partners'
import PartnerManager from './PartnerManager'

export default [
    {
        name: 'partners.index',
        path: '/partners',
        component: Partners,
        meta: {
            order: 4,
            requiresAuth: true,
            icon: 'business',
            menu: true,
            permission: 'view_partners'
        },

    },
    {
        name: 'partners.create',
        path: '/partners/create',
        component: PartnerManager,
        meta: {requiresAuth: true, permission: 'create_partners'},
    },
    {
        name: 'partners.edit',
        path: '/partners/:partner/edit',
        component: PartnerManager,
        meta: {requiresAuth: true, permission: 'update_partners'},
    },


]
