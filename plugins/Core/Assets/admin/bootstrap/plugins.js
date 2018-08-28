import Vue from 'vue'
import Vuetify from 'vuetify'
import VueEvents from 'vue-events';
import VueChatScroll from "vue-chat-scroll";
import VueScrollTo from "vue-scrollto";
import MavonEditor from 'mavon-editor';
import 'mavon-editor/dist/css/index.css';

/**
 * Vuetify UI
 */
Vue.use(Vuetify, {
    rtl: true,
    theme: {
        primary: '#3fc2d7',
        secondary: '#424242',
        accent: '#82B1FF',
        error: '#FF5252',
        info: '#2196F3',
        success: '#4CAF50',
        warning: '#FFC107'
    }
});
Vue.use(VueEvents);
Vue.use(VueChatScroll);
Vue.use(VueScrollTo);
Vue.use(MavonEditor);