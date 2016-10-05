<template>
    <div class="user-panel user-form"
         v-if="show"
    >

        <div class="panel-header">
            New Modification<br>
            <span class="glyphicon glyphicon-remove"
                  @click="show = false"
            >
            </span>
        </div>

        <form id="modification"
              class="modification"
              :action="action"
              method="post"
              v-ajax="fields"
        >

            <div class="form-group">
                <input class="form-control"
                       type="text"
                       name="mod_name"
                       v-model="fields.mod_name"
                       placeholder="Modification"
                >
            </div>
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">$</span>
                    <input class="form-control"
                           type="number"
                           name="price"
                           v-model="fields.price"
                           placeholder="Price"
                    >
                </div>
            </div>
            <div class="form-group">
                <label for="comment">Description:</label>
                <textarea class="form-control"
                          rows="5" id="comment"
                          v-model="fields.value"
                >
                </textarea>
            </div>

        </form>

        <button class="btn btn-primary btn-sm"
                form="modification"
                type="submit"
        >
            Add New
        </button>

    </div>
</template>



<script>

export default {
    props: ['action'],

    data() {
        return {
            action: '',
            show: false,
            fields: {
                mod_name: '',
                value: '',
                price: ''
            }
        };
    },

    created() {
        this.$on('toggle-modification-form', this.toggleForm);
    },

    methods: {
        toggleForm() {
            if(!this.show) this.show = true;
        }
    }
};
</script>



<style lang="stylus">
.user-form
    button
        margin: 10px
</style>
