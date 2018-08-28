import Vue from 'vue';
import Component from 'vue-class-component';
import {mapGetters} from 'vuex';

@Component({
    computed: mapGetters(['sidebar', 'permissions'])
})
export default class Sidebar extends Vue {

    render(h) {
        return (
            <v-navigation-drawer class={'l-sidebar'} fixed app right
                                 mini-variant={this.sidebar.mini_variant}
                                 clipped={this.sidebar.clipped}
                                 value={this.sidebar.show}
            >
                <v-list dense>
                    {this.valid(this.router).map(route => this.can(route.meta.permission) ? (route.children ? this.getListGroup(h, route) : this.getLisTile(h, route)) : '')}
                </v-list>
            </v-navigation-drawer>
        );
    }

    getListGroup(h, route) {
        return (
            <v-list-group no-action>
                <v-list-tile ripple slot="activator">
                    <v-list-tile-action>
                        <v-icon>{route.meta.icon}</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-content>
                        <v-list-tile-title>{this.$t(route.name)}</v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>
                {this.valid(route.children).map(r => this.getLisTile(h, r))}
            </v-list-group>
        );
    }

    getLisTile(h, route) {
        return (
            <v-list-tile ripple router to={{name: route.name}}>
                {route.meta.icon ? <v-list-tile-action>
                    <v-icon>{route.meta.icon}</v-icon>
                </v-list-tile-action> : ''}

                <v-list-tile-content>
                    <v-list-tile-title>{this.$t(route.name)}</v-list-tile-title>
                </v-list-tile-content>
            </v-list-tile>
        );
    }


    get router() {
        return this.valid(Zexus.routes);
    }


    mounted() {
        // console.info(this.valid(this.router))
    }

    valid(routes) {
        return collect(routes).sortBy(route => route.meta.order).filter(route => route.meta.menu).toArray();
    }

    can(permission) {
        return true; // TODO: remove this on production
        return permission ? collect(this.permissions).pluck('name').search(permission) : true;
    }

}