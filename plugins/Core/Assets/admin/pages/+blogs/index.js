import Blog from './Blog'
import BlogManager from './BlogManager'

export default [
    {
        name: 'blogs.index',
        path: '/blogs',
        component: Blog,
        meta: {
            order: 4,
            requiresAuth: true,
            icon: 'book',
            menu: true,
            permission: 'view_blogs'
        },

    },
    {
        name: 'blogs.create',
        path: '/blogs/create',
        component: BlogManager,
        meta: {requiresAuth: true, permission: 'create_blogs'},
    },
    {
        name: 'blogs.edit',
        path: '/blogs/:blog/edit',
        component: BlogManager,
        meta: {requiresAuth: true, permission: 'update_blogs'},
    },


]
