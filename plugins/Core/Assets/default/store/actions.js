// https://vuex.vuejs.org/en/actions.html
import * as TYPES from './types';
import {localStorageGetItem, localStorageSetItem} from "../plugins/local";
import {http} from './../plugins/http';
import router from "../router";

export default {

    setFetching({commit}, obj = {fetching: true}) {
        commit(TYPES.MAIN_SET_FETCHING, obj);
    },

    setMessage({commit}, obj) {
        commit(TYPES.MAIN_SET_MESSAGE, obj);
    },

    resetMessages({commit}) {
        commit(TYPES.MAIN_SET_MESSAGE, {type: 'success', message: ''});
        commit(TYPES.MAIN_SET_MESSAGE, {type: 'error', message: []});
        commit(TYPES.MAIN_SET_MESSAGE, {type: 'warning', message: ''});
        commit(TYPES.MAIN_SET_MESSAGE, {type: 'validation', message: {}});
    },

    toggleSidebar({commit}) {
        commit(TYPES.TOGGLE_SIDEBAR);
    },
    toggleSidebarClipped({commit}) {
        commit(TYPES.TOGGLE_SIDEBAR_CLIPPED);
    },
    toggleSidebarMiniVariant({commit}) {
        commit(TYPES.TOGGLE_SIDEBAR_MINI_VARIANT);
    },


    setBreadCrumbs({commit}, items = []) {
        let routes = ['home.index'];
        items.map(item => routes.push(item));

        commit(TYPES.SET_BREADCRUMBS, routes);
    },
    setLang({commit}, lang = 'en') {
        commit(TYPES.SET_LANG, lang);
    },

    // Authentication
    getUser: ({commit, dispatch}) => {
        http.defaults.headers.common.Authorization = `Bearer ${localStorageGetItem('token')}`;
        http.get('user').then(res => {
            let permissions = res.data.data.role.permissions;
            if(collect(permissions).pluck('name').search("view_admin@dashboard")) {
                // 1. set user data
                commit(TYPES.SET_USER, res.data.data);
                // 2. set user info
                // commit(TYPES.SET_USER_INFO, res.data.info);
                // 3. set user permissions
                commit(TYPES.SET_PERMISSIONS, permissions);
            } else {
                dispatch('logout');
                router.push({name: 'auth.login'});
            }

        }).catch(error => {

        })
    },

    setToken: ({commit}, token) => {
        localStorageSetItem('token', token);
        commit(TYPES.SET_TOKEN, token);
    },

    logout: ({commit, dispatch}) => {
        localStorage.removeItem('token');
        commit(TYPES.SET_TOKEN, null);
        commit(TYPES.SET_PERMISSIONS, []);
        commit(TYPES.SET_USER, {});
    },
    getUserData({commit, dispatch}) {
        // get user data (permissions/info/data)
        dispatch('getUser');


    },
    setUserInfo: ({commit}, data) => {
        commit(TYPES.SET_USER_INFO, data);
    },
    setUser: ({commit}, data) => {
        commit(TYPES.SET_USER, data);
    }
}
