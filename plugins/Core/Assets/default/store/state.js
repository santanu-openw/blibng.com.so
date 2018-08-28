// https://vuex.vuejs.org/en/state.html
export default {
    token: null,
    user: {},
    permissions: [],
    messages: {
        success: '',
        error: [],
        warning: '',
        validation: {}
    },
    fetching: false,
    sidebar: {
        show: true,
        clipped: true,
        mini_variant: false
    },
    app_name: 'بيلنق',

    lang: {
        supported_languages: ['ar', 'en'],
        default_lang: 'ar',
        fallback_lang: 'en'
    },

    breadcrumbs: ['home.index']
};
