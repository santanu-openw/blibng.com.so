import Translations from './Translations'
import TranslateManager from './TranslateManager'

export default [
    {
        name: 'translations.index',
        path: '/translations',
        component: Translations,
        meta: {
            order: 10,
            requiresAuth: true,
            icon: 'g_translate',
            menu: true,
            permission: 'view_translations'
        },

    },
    {
        name: 'translations.create',
        path: '/translations/create',
        component: TranslateManager,
        meta: {requiresAuth: true, permission: 'create_translations'},
    },
    {
        name: 'translations.edit',
        path: '/translations/:translate/edit',
        component: TranslateManager,
        meta: {requiresAuth: true, permission: 'update_translations'},
    },


]
