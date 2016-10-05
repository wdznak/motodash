<template>
    <div class="user-panel">
            <div class="panel-header">
            {{ counter | pluralize 'Refuel' }}
            <span class="badge">
                {{ counter }}
            </span>
        </div>

        <div class="scrollable">
            <table class="table table-condensed">

                <tbody v-for="ref in refuels">
                    <tr>
                        <td class="divider">
                            <em>
                                {{
                                    ref.petrolStation + ' ' +
                                    ref.fuelType + ' '
                                }}
                                {{ ref.price | currency '$' }}
                            </em>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Distance: {{ ref.distance }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Amount: {{ ref.amount }}
                        </td>
                    </tr>
                </tbody>

            </table>
        </div>
    </div>
</template>



<script>

export default {

    props: [
        'refuels',
        'counter'
    ],

    data() {
        return {
        };
    },

    created() {
        this.refuels = JSON.parse(this.refuels);
    }
};
</script>



<style lang="stylus">
span.badge
    margin-left: 20px
    padding-left: 10px
    padding-right: 10px
</style>
