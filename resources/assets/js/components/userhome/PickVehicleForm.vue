<template>
    <form id="vehicle_form" role="form">
        <fieldset class="form-group">
            <select class="form-control input-sm"
                    v-model='type'
                    @change='typeToggle'
            >
                <option v-for="type in types | orderBy 'type'"
                        v-bind:value="type.type"
                >
                    {{ type.type }}
                </option>
            </select>
        </fieldset>

        <fieldset class="form-group">
            <select class="form-control input-sm"
                    v-model='brand'
                    @change='brandToggle'
            >
                <option v-for="brand in brands | orderBy 'brand' | filterBy type in 'type'"
                        v-bind:value='brand.brand'
                >
                    {{ brand.brand }}
                </option>
            </select>
        </fieldset>

        <fieldset class="form-group">
            <select class="form-control input-sm"
                    v-model='model'
                    :disabled='toggle.model'
                    @change='modelToggle'
            >
                <option v-for="model in models | orderBy 'model' | filterBy brand in 'brand'"
                        v-bind:value='model.model'
                >
                    {{ model.model }}
                </option>
            </select>
        </fieldset>

        <fieldset class="form-group">
            <select class="form-control input-sm"
                    v-model='year.id'
                    :disabled='toggle.year'
                    @change='notifyAboutVehicleId(year.id)'
            >
                <option v-for="year in years | orderBy 'produced' | filterBy model in 'model'"
                        v-bind:value='year.id'
                >
                    {{ year.produced }}
                </option>
            </select>
        </fieldset>
    </form>
</template>


<script>

export default {

    data() {
        return {
            vehicleList: '',
            type: 'Car',
            types: '',
            brands: '',
            models: '',
            years: '',
            allVeh: '',
            vehicleId: '',
            toggle: {
                model: true,
                year: true
            }
        };
    },

    created() {
        this.fetchVehiclesList();
    },

    methods: {
        fetchVehiclesList() {
            this.$http.get('vehicles').then((response) => {
                if (typeof response.body !== "undefined") {
                    this.vehicleList = JSON.parse(response.body);
                    this.types = this.vehicleList.types;
                    this.brands = this.vehicleList.brands;
                    this.models = this.vehicleList.models;
                    this.years = this.vehicleList.years;
                }
            }, (response) => {
                console.log('Connect');
            });
        },

        typeToggle() {
            if(!this.toggle.model) this.toggle.model = true;
            if(!this.toggle.year) this.toggle.year = true;
            this.notifyAboutVehicleId();
        },

        brandToggle() {
            if(this.toggle.model) this.toggle.model = false;
            if(!this.toggle.year) this.toggle.year = true;
            this.notifyAboutVehicleId();
        },

        modelToggle() {
            if(this.toggle.year) this.toggle.year = false;
            this.notifyAboutVehicleId();
        },

        notifyAboutVehicleId(id = '') {
            console.log(id);
            this.$dispatch('vehicle-id', id);
        }
    }
};


</script>

<style lang="stylus">
#vehicle_form
    margin-top: 30px
    min-width: 200px
    fieldset.form-group
        border: none
        margin-bottom: 0
        padding-top: 0
        padding-bottom: 15px
        text-align: left
        select
            cursor: pointer
</style>
