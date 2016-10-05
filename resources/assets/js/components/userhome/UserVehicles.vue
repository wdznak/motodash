<template>
    <div class="scrollable"
        v-show="show">
        <ul class="list-group">
            <li class="list-group-item"
                v-for="vehicle in vehiclesList">
                <div class="item-container">
                    <div class="item-pic">
                        <a :href="vehicle.links.vehicle">
                            <img class="media-object"
                                 :src="vehicle.links.thumbnail"
                                 :alt="vehicle.model" />
                        </a>
                    </div>
                    <div class="item-data">
                        <h5>{{ vehicle.brand + ' ' + vehicle.model }}</h5>
                        Mileage - {{ vehicle.mileage }}
                    </div>
                </div>
            </li>
        </ul>
    </div>
</template>



<script>
export default {

    props: ['baseUrl'],

    data() {
        return {
            vehiclesList: [],
            show: true
        };
    },

    created() {
        this.fetchVehiclesList();

        this.$on('push-new-vehicle', (msg) => {
            console.log(msg);
            this.vehiclesList.push(msg);
        });
    },

    methods: {
        fetchVehiclesList() {
            this.$http.get(this.baseUrl).then((response) => {
                if (typeof response.body !== "undefined") {
                    this.vehiclesList = JSON.parse(response.body);
                }
            }, (response) => {
                console.log('Connection Error' + response.body);
            });
        }
    }
};
</script>



<style lang="stylus">
.scrollable
    max-height: 160px
    overflow-y: hidden
    &:hover
        overflow-y: auto
    .list-group
        margin: 0
    .list-group-item
        border: none
        padding: 5px 0

.item-container
    display: flex
    justify-content: flex-start
    flex-flow: row wrap

.item-pic
    padding-left: 5px
    img
        max-width: 55px
        max-height: 55px

.item-data
    padding-left: 5px
</style>
