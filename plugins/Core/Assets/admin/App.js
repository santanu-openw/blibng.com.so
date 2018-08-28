import Vue from 'vue';
import Component from 'vue-class-component';
import {mapGetters} from 'vuex';
import AppHeader from "@zix-core/admin/components/Header";
import AppBreadcrumbs from "@zix-core/admin/components/Breadcrumbs";
import AppNotifications from "@zix-core/admin/components/Notifications";
import AppSideBar from "@zix-core/admin/components/Sidebar";
import AppFooter from "@zix-core/admin/components/Footer";
import {localStorageGetItem} from "./plugins/local";

@Component({
    computed: mapGetters(['isAuth']),
})
export default class App extends Vue {

    render(h) {
        return (
            <v-app light class="lang-ar">
                {this.isAuth ? h(AppSideBar) : ''}
                {this.isAuth ? h(AppHeader) : ''}
                <v-content>
                    <v-container fluid class={'l-main'}>
                        {this.isAuth ? h(AppBreadcrumbs) : ''}
                        <transition name="fade" mode="out-in">
                            <router-view></router-view>
                        </transition>
                    </v-container>
                </v-content>
                {h(AppNotifications)}
                {this.isAuth ? h(AppFooter) : ''}
            </v-app>
        );
    }

    created() {
        if (localStorageGetItem('token')) {
            this.$store.dispatch('getUserData');
        }
    }
}