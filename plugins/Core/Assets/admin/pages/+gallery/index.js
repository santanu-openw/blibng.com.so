import Gallery from './Gallery'
import GalleryManager from './GalleryManager'

export default [
    {
        name: 'galleries.index',
        path: '/galleries',
        component: Gallery,
        meta: {
            order: 4,
            requiresAuth: true,
            icon: 'book',
            menu: true,
            permission: 'view_galleries'
        },

    },
    {
        name: 'galleries.create',
        path: '/galleries/create',
        component: GalleryManager,
        meta: {requiresAuth: true, permission: 'create_galleries'},
    },
    {
        name: 'galleries.edit',
        path: '/galleries/:gallery/edit',
        component: GalleryManager,
        meta: {requiresAuth: true, permission: 'update_galleries'},
    },


]
