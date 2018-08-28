import Vue from 'vue';
import Component from 'vue-class-component'
import {mapGetters} from 'vuex';

@Component({
    computed: mapGetters(['sidebar', 'app_name']),
})
export default class Footer extends Vue {
    render(h) {
        return (
            <v-footer class={'l-footer elevation-1'} fixed={this.sidebar.clipped} app>
                <v-container fluid>
                    <v-layout class="l-footer__copy_write">
                        <v-flex md6 domPropsInnerHTML={this.rights}>
                            &copy; {this.year} {this.app_name} All right reserved
                        </v-flex>
                        <v-flex md6 class="text-sm-right">
                            Powered By: <a href="https://zixdev.com/" target="_blank">zixdev.com</a>
                        </v-flex>
                    </v-layout>
                </v-container>
            </v-footer>
        );
    }

    get year() {
        let d = new Date();
        return d.getFullYear();
    }

}