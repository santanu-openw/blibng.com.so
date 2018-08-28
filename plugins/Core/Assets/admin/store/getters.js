import {isEmpty} from 'lodash';

export default {
    validator: () => {},
    app_name: state => state.app_name,
    sidebar: state => state.sidebar,
    user: state => state.user,
    permissions: state => state.permissions,
    breadcrumbs: state => state.breadcrumbs,
    isAuth: (state) => {
        return !isEmpty(state.token);
    }
}