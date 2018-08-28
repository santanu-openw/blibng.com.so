import Profile from './Profile';
import ChangePassword from './ChangePassword';

export default [
    {
        name: 'profile.index',
        path: '/profile',
        component: Profile,
        meta: {
            requiresAuth: true
        }
    },
    {
        name: 'profile.change_password',
        path: '/profile/change-password',
        component: ChangePassword,
        meta: {
            requiresAuth: true
        }
    }
]
