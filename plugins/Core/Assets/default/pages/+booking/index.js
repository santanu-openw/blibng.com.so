import Booking from './Booking'
import Orders from './Orders'
import OrderDelete from './OrderDelete'

export default [
    {
        name: 'orders.index',
        path: '/orders',
        component: Orders,
        meta: {
            requiresAuth: true
        }
    },
    {
        name: 'orders.create',
        path: '/orders/create',
        component: Booking,
        meta: {
            requiresAuth: true
        }
    },
    {
        name: 'orders.edit',
        path: '/orders/:order',
        component: Booking,
        meta: {
            requiresAuth: true
        }
    },
    {
        name: 'orders.delete',
        path: '/orders/:order/delete',
        component: OrderDelete,
        meta: {
            requiresAuth: true
        }
    },

]
