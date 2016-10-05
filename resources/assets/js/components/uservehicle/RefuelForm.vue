<template>
    <div class="user-panel user-form"
         v-if="show"
    >

        <div class="panel-header">
            New Refuel<br>
            <span class="glyphicon glyphicon-remove"
                  @click="show = false"
            >
            </span>
        </div>

        <form id="refuel"
              class="refuel"
              :action="action"
              method="post"
              v-ajax="fields"
        >

            <div class="form-group">
                <input class="form-control"
                       type="number"
                       name="fuel_amount"
                       v-model="fields.fuel_amount"
                       placeholder="Fuel Amount"
                >
            </div>
            <div class="form-group">
                <input class="form-control"
                       type="number"
                       name="distance"
                       v-model="fields.distance"
                       placeholder="Distance"
                >
            </div>
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">$</span>
                    <input class="form-control"
                           type="number"
                           name="price"
                           v-model="fields.price"
                           placeholder="Price">
                </div>
            </div>
            <div class="form-group">
                <select class="form-control"
                        name="petrol"
                        v-model="fields.petrol_station_id"
                >
                    <option v-for="brand in selectFields.petrolStations"
                            v-bind:value="brand.id"
                    >
                        {{ brand.petrolStation }}
                    </option>
                </select>
            </div>
            <div class="form-group">
                <select class="form-control"
                        name="fuel"
                        v-model="fields.fuel_type_id"
                >
                    <option v-for="type in selectFields.fuelTypes"
                            v-bind:value="type.id"
                    >
                        {{ type.fuelType }}
                    </option>
                </select>
            </div>

        </form>

        <button class="btn btn-primary btn-sm"
                form="refuel"
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
                fuel_amount: '',
                distance: '',
                price: '',
                petrol_station_id: 1,
                fuel_type_id: 1
            },
            selectFields: {
                petrolStations: [],
                fuelTypes: []
            }
        };
    },

    computed: {
    },

    created() {
        this.$on('toggle-refuel-form', this.toggleForm);

        this.fetchData();
    },

    methods: {
        toggleForm() {
            if(!this.show) this.show = true;
        },

        fetchData() {
            this.$http.get('petrol-station?fuelType=true').then((response) => {
                let temp = JSON.parse(response.body);
                this.selectFields.petrolStations = temp.petrolStations;
                this.selectFields.fuelTypes = temp.fuelTypes;
            }, (response) => {
                console.log('ERROR' + response.body);
            });
        }
    }
};
</script>



<style lang="stylus">
.user-form
    button
        margin: 10px
</style>
