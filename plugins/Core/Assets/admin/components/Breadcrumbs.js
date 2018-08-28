import Vue from 'vue';
import Component from 'vue-class-component';
import {mapGetters} from 'vuex';

@Component({
    computed: mapGetters(['breadcrumbs'])
})
export default class Breadcrumbs extends Vue {
    render(h) {
        return (
            <v-card class={'mb-4'}>
                <v-breadcrumbs divider={'/'}>
                    {this.breadcrumbs.map(breadcrumb => (
                        <v-breadcrumbs-item exact key={breadcrumb} to={{name: breadcrumb}}>
                            {this.$t(breadcrumb)}
                        </v-breadcrumbs-item>
                    ))}
                </v-breadcrumbs>
            </v-card>
        );
    }
}