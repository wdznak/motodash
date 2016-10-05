const Vue = require('vue');
const VueResource = require('vue-resource');

import UserVehicleModifications from './components/uservehicle/UserVehicleModifications.vue';
import UserVehicleRefuels from './components/uservehicle/UserVehicleRefuels.vue';
import RefuelForm from './components/uservehicle/RefuelForm.vue';
import ModificationForm from './components/uservehicle/ModificationForm.vue';
import ajax from './directives/ajax.js';

Vue.use(VueResource);
Vue.config.devtools = true;

Vue.http.options.root = '/motodash/public';
Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').content;


new Vue({
    el: '.body-container',

    components: {
        UserVehicleModifications,
        UserVehicleRefuels,
        RefuelForm,
        ModificationForm

    },

    data: {
    },

    methods: {
        toggleRefuelForm() {
            this.$broadcast('toggle-refuel-form');
        },

        toggleModificationForm() {
            this.$broadcast('toggle-modification-form');
        }
    }
});
