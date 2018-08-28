import Contacts from './Contacts'
import ContactManager from './ContactManager'

export default [
    {
        name: 'contacts.index',
        path: '/contacts',
        component: Contacts,
        meta: {
            order: 6,
            requiresAuth: true,
            icon: 'contact_phone',
            menu: true,
            permission: 'view_contacts'
        },

    },
    {
        name: 'contacts.create',
        path: '/contacts/create',
        component: ContactManager,
        meta: {requiresAuth: true, permission: 'create_contacts'},
    },
    {
        name: 'contacts.edit',
        path: '/contacts/:contact/edit',
        component: ContactManager,
        meta: {requiresAuth: true, permission: 'update_contacts'},
    },


]
