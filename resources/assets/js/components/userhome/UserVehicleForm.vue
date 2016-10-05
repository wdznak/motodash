<template>
    <div>
        <form id="details-form"
              class="vehicle-detail-form"
              :action="url"
              method="POST"
              enctype="multipart/form-data"
        >

            <input id="vehicle_hidden_id"
                   type="hidden"
                   name="vehicle_id"
                   :value="vehicleId"
            >

            <div class="form-group">
                <input class="form-control input-sm"
                       type="text"
                       name="version"
                       placeholder="Specify model version"
                       v-model="form.version"
                >
            </div>

            <div class="form-group">
                <input class="form-control input-sm"
                       type="number"
                       name="mileage"
                       placeholder="Specify mileage"
                       v-model="form.mileage"
                >
            </div>

            <div class="form-group">
                <input class="form-control input-sm"
                       type="number"
                       name="engine_size"
                       placeholder="Specify engine size"
                       v-model="form.engine_size"
                >
            </div>

            <div class="form-group">
                <input class="form-control input-sm"
                       type="number"
                       min="1900"
                       max="2016"
                       name="production_date"
                       placeholder="Specify production year"
                       v-model="form.production_date"
                >
            </div>

            <div class="form-group">
                <label class="file-label">
                    <input type="file"
                           name="thumbnail"
                           accept=".png,.jpg,.jpeg,.gif,image/png,image/jpeg"
                           @change="loadFile"
                    >
                    <span>Cover Photo</span>
                </label>
            </div>
        </form>
        <button class="btn btn-info"
                type="submit"
                form="details-form"
                :disabled="vehicleId ? false : true"
                @click="sendForm"
        >
            Create
        </button>
    </div>
</template>


<script>

export default {

    props: [
        'url',
        'vehicleId'
    ],

    data() {
        return {
            form: {
                vehicle_id: '',
                version: '',
                mileage: '',
                engine_size: '',
                production_date: '',
                thumbnail: '',
            }
        };
    },

    created() {
    },

    methods: {
        loadFile(e) {
            let files = e.target.files || e.dataTransfer.files;
            this.form.thumbnail = files[0];
        },

        prepareFormData() {
            this.form.vehicle_id = this.vehicleId;
            let formData = new FormData();

            for(let value in this.form) {
                formData.append(value, this.form[value]);
            }

            return formData;
        },

        sendForm(e) {
            e.preventDefault();

            this.$http.post(this.url, this.prepareFormData())
                .then((response) => {
                    response = JSON.parse(response.body);
                    this.dispatchNewVehicle(response['vehicle']);
                }, () => {
                    alert('Something went really wrong... poor you ¬_¬');
                });
        },

        dispatchNewVehicle(vehicle) {
            this.$dispatch('new-vehicle-object', vehicle);
        }
    }
};


</script>

<style lang="stylus">
.add-vehicle-form
    display: flex
    justify-content: space-around
    flex-flow: row wrap
    max-width: 500px
    .vehicle-detail-form
        margin: 30px 10px
    button
        order: 3
        margin: 10px
        min-width: 150px

    @media (max-width: 640px)
        flex-flow: column
        .vehicle-form
            order: 2
        .vehicle-detail-form
            margin: 10px

label.file-label input[type="file"]
    position: fixed
    top: -1000px

.file-label
    border-radius: 4px
    padding: 7px 20px
    margin: 2px
    background: #5bc0de
    display: inline-block
    cursor: pointer

.file-label:hover
    background: #46b8da

.file-label:active
    background: #5bc0de

.file-label :invalid + span
    color: black

.file-label :valid + span
    color: white

</style>
