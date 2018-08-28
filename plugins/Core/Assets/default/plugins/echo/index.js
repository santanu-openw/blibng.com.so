import Echo from "laravel-echo";
import {localStorageGetItem} from "../local";

export const echo = new Echo({
    broadcaster: 'socket.io',
    host: window.location.hostname + ':6001',
    auth: {
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Authorization': 'Bearer ' + localStorageGetItem('token')
        }
    }
});

// https://vuejs.org/v2/guide/plugins.html
export default function install(Vue) {
    // https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Object/defineProperty
    Object.defineProperty(Vue.prototype, '$echo', {
        get() {
            return echo
        }
    })
}
