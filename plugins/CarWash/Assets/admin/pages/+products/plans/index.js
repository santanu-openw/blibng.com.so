import Plans from './Plans'
import PlanManager from './PlanManager'

export default [
    {
        name: 'plans.index',
        path: '/plans',
        component: Plans,
        meta: {
            requiresAuth: true,
            menu: true,
            permission: 'view_plans'
        },

    },
    {
        name: 'plans.create',
        path: '/plans/create',
        component: PlanManager,
        meta: {requiresAuth: true, permission: 'create_plans'},
    },
    {
        name: 'plans.edit',
        path: '/plans/:plan/edit',
        component: PlanManager,
        meta: {requiresAuth: true, permission: 'update_plans'},
    },


]
