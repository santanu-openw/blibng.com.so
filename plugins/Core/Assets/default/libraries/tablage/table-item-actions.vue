<template>
    <td v-if="eloquent_status == 'active'" class="text-xs-right">
        <v-btn v-for="(action, index) in actions"
               :key="index"
               :color="action.color"
               :dark="action.dark"
               :title="$t(action.text)"
               @click="action.callback(item)"
               :disabled="action.disabled && action.disabled(item)"
               small
               :fab="action.fab"
               :loading="$store.state.fetching"
        >
            <span v-if="!action.fab">
                {{ $t(action.text) }}
            </span>
            <v-icon :right="!action.fab"
                    v-if="action.icon">
                {{action.icon}}
            </v-icon>

        </v-btn>
    </td>
    <td v-else>
        <v-btn small dark error outline v-on:click.native="$events.$emit('table.force-delete-data', item.id)">
            {{$t('table.force-delete')}}
        </v-btn>
        <v-btn small dark default outline v-on:click.native="$events.$emit('table.restore-data', item.id)">
            {{$t('table.restore')}}
        </v-btn>
    </td>
</template>

<script>

    import Component from "vue-class-component";
    import Vue from "vue";

    @Component({
        props: {
            route: {
                required: true,
                type: String
            },
            item: {
                type: Object,
                required: true
            },
            actions: {
                required: true,
                type: Array,
                default: () => [
                    {
                        text: 'table.edit',
                        color: 'primary',
                        dark: false,
                        callback: (item) => {
                            console.info(item)
                        },
                        disabled: (item) => {
                            return false;
                        }
                    }
                ],

            }
        }
    })
    export default class TableItemActions extends Vue {
        eloquent_status = 'active';
    }
</script>
