import Vue from 'vue';
import Component from 'vue-class-component';
import {mapState} from 'vuex';
import {isEmpty} from 'lodash';
import toastr from "toastr";

@Component({
    computed: mapState(['messages'])
})
export default class Notifications extends Vue {

    render(h) {
        return (
            <v-snackbar bottom value={this.snackbar} onInput={(snackbar) => this.snackbar = snackbar}>
                {this.snackbar_message}
                <v-btn flat dark onClick={() => this.snackbar = false}>Close</v-btn>
            </v-snackbar>
        );
    }

    get snackbar() {
        return !!(this.hasSuccessMessage || this.hasErrorMessages || this.hasValidationMessages);
    }

    set snackbar(snackbar) {
        this.$store.dispatch('resetMessages');
    }

    // @TODO:: make this translable
    get snackbar_message() {
        if (this.hasSuccessMessage) return this.messages.success;
        if (this.hasErrorMessages) return 'Oops looks like something went wrong please check again later!';
        if (this.hasValidationMessages) return 'Please Check your inputs '
    }

    mounted() {
        this.$events.$on('notify', (data) => {
            this.notifyViaToaster(data);
            console.info('new notification', data)
        });
    }

    notifyViaToaster(data) {

        //set the options
        toastr.options.closeButton = true;
        toastr.options.escapeHtml = true;
        toastr.options.progressBar = true;
        toastr.options.rtl = false;

        toastr[data.type](data.message, data.title);
    }

    get hasSuccessMessage() {
        return this.messages.success !== ''
    }

    get hasErrorMessages() {
        return this.messages.error.length > 0
    }

    get hasValidationMessages() {
        return !isEmpty(this.messages.validation)
    }
}