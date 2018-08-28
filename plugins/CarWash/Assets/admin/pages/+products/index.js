import Services from './services/Services';
import services from './services';
import packages from './packages';
import plans from './plans';
import offers from './offers';

export default [
    {
        name: 'services.index',
        path: '/services',
        component: Services,
        meta: {requiresAuth: true, permission: 'view_services', icon: 'local_offer', menu: true, order: 3},
        children: [
            ...plans,
            ...packages,
            ...services,
            ...offers
        ]
    }
];