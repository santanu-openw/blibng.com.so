import Testimonials from './Testimonials'
import TestimonialManager from './TestimonialManager'

export default [
    {
        name: 'testimonials.index',
        path: '/testimonials',
        component: Testimonials,
        meta: {
            order: 7,
            requiresAuth: true,
            icon: 'feedback',
            menu: true,
            permission: 'view_testimonials'
        },

    },
    {
        name: 'testimonials.create',
        path: '/testimonials/create',
        component: TestimonialManager,
        meta: {requiresAuth: true, permission: 'create_testimonials'},
    },
    {
        name: 'testimonials.edit',
        path: '/testimonials/:testimonial/edit',
        component: TestimonialManager,
        meta: {requiresAuth: true, permission: 'update_testimonials'},
    },


]
