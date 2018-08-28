// https://vuex.vuejs.org/en/mutations.html
import * as TYPES from './types';

/* eslint-disable no-param-reassign */
export default {
    [TYPES.MAIN_SET_FETCHING](state, obj) {
        state.fetching = obj.fetching;
    },
    [TYPES.MAIN_SET_MESSAGE](state, obj) {
        state.messages[obj.type] = obj.message;
    },
    [TYPES.TOGGLE_SIDEBAR](state) {
        state.sidebar.show = !state.sidebar.show;
    },
    [TYPES.TOGGLE_SIDEBAR_CLIPPED](state) {
        state.sidebar.show = true;
        state.sidebar.clipped = !state.sidebar.clipped;
    },
    [TYPES.TOGGLE_SIDEBAR_MINI_VARIANT](state) {
        state.sidebar.show = true;
        state.sidebar.mini_variant = !state.sidebar.mini_variant;
    },
    [TYPES.SET_BREADCRUMBS](state, items) {
        state.breadcrumbs = items;
    },
    [TYPES.SET_TOKEN](state, token) {
        state.token = token;
    },

    [TYPES.SET_PERMISSIONS](state, payload) {
        state.permissions = payload;
    },

    [TYPES.SET_USER](state, payload) {
        state.user = {...state.user, ...payload};
    },
    [TYPES.SET_LANG](state, lang) {
        state.lang.default_lang = lang;
    }
}
