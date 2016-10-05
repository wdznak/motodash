const Vue = require('vue');
const VueResource = require('vue-resource');

import UserVehicles from './components/userhome/UserVehicles.vue';
import PickVehicleForm from './components/userhome/PickVehicleForm.vue';
import UserVehicleForm from './components/userhome/UserVehicleForm.vue';
import ajax from './directives/ajax.js';

Vue.use(VueResource);
Vue.config.devtools = true;

Vue.http.options.root = '/motodash/public';
Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').content;

new Vue({
    el: 'body',

    components: {
        UserVehicles,
        UserVehicleForm,
        PickVehicleForm
    },

    data: {
        vehicleId: ''
    },

    events: {
        'vehicle-id'(msg) {
            this.vehicleId = msg;
        },

        'new-vehicle-object'(msg) {
            this.$broadcast('push-new-vehicle', msg);
        }
    }
});
