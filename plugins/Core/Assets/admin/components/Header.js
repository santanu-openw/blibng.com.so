import Vue from 'vue';
import Component from 'vue-class-component';
import {mapGetters} from 'vuex';

@Component({
    computed: mapGetters(['sidebar', 'app_name']),
})
export default class Header extends Vue {
    dialog = false;

    render(h) {
        return (
            <v-toolbar class={'l-header__top primary'} app dark fixed clipped-left={this.sidebar.clipped}>
                <v-toolbar-side-icon onClick={() => this.$store.dispatch('toggleSidebar')}/>

                <v-toolbar-title>{this.app_name}</v-toolbar-title>
                <v-spacer />

                <v-toolbar-items>
                    {/*{this.renderLanguagesDropdown(h)}*/}
                    <v-spacer />
                    <v-btn icon onClick={() => this.dialog = true}>
                        <v-icon>exit_to_app</v-icon>
                    </v-btn>
                </v-toolbar-items>

                <v-dialog value={this.dialog} onInput={(dialog) => this.dialog = dialog} max-width="290">
                    <v-card class="text-center">
                        <v-card-text>
                            <v-icon x-large color="primary">exit_to_app</v-icon>
                            <h2>
                                Are you sure you want to logout {this.app_name}
                            </h2>
                        </v-card-text>
                        <v-card-actions>
                            <v-btn block color="primary" onClick={() => this.logout()} class="text-uppercase">
                                Yes, Logout
                            </v-btn>
                        </v-card-actions>
                    </v-card>
                </v-dialog>
            </v-toolbar>
        );
    }

    renderLanguagesDropdown(h) {
        return (<v-menu>
            <v-btn icon slot="activator" color="primary" dark>
                <v-icon>translate</v-icon>
            </v-btn>
            <v-list>
                {
                    this.$store.state.lang.supported_languages.map(lang => (
                        <v-list-tile onClick={() => this.$store.dispatch('setLang', lang)}>
                            <v-list-tile-title>{lang}</v-list-tile-title>
                        </v-list-tile>
                    ))
                }

            </v-list>
        </v-menu>);
    }

    logout() {
        this.$store.dispatch('logout');
        this.dialog = false;
        this.$router.push({name: 'auth.login'});
    }

}