<template>
    <div class="user-panel">
        <div class="panel-header">
            {{ counter | pluralize 'Modification'}}
            <span class="badge">
                {{ counter }}
            </span>
        </div>


        <div class="scrollable">
            <table class="table table-condensed">

                <tbody v-for="mod in modifications">
                    <tr>
                        <td class="divider">
                            <em>{{ mod.name }}</em>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Description: {{ mod.description }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Price: {{ mod.price | currency '$' }}
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
        'modifications',
        'counter'
    ],

    data() {
        return {

        };
    },

    created() {
        this.modifications = JSON.parse(this.modifications);
    }
};
</script>

<style lang="stylus">
span.badge
    color: #312c32
    background-color: white
    margin-left: 20px
    padding-left: 10px
    padding-right: 10px
</style>
