import Offers from './Offers'
import OfferManager from './OfferManager'

export default [
    {
        name: 'offers.index',
        path: '/offers',
        component: Offers,
        meta: {
            requiresAuth: true,
            menu: true,
            permission: 'view_offers'
        },

    },
    {
        name: 'offers.create',
        path: '/offers/create',
        component: OfferManager,
        meta: {requiresAuth: true, permission: 'create_offers'},
    },
    {
        name: 'offers.edit',
        path: '/offers/:offer/edit',
        component: OfferManager,
        meta: {requiresAuth: true, permission: 'update_offers'},
    },


]
