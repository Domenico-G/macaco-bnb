/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import axios from "axios";
import Vue from "vue";
window.Vue = Vue;
require("./bootstrap");
import Chart from "chart.js/auto";
import { method } from "lodash";
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component(
    "map-tom-tom",
    require("./components/MapTomTom.vue").default
);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: "#app",
    data: {
        address: "",
        roomsNumber: "1",
        bedsNumber: "1",
        distanceKm: "20",
        flatsArr: [],
        checkedServices:[]

    },

    mounted() {},

    methods: {
        getFlats: function() {
            const self = this;
            axios
                .get(
                    "http://127.0.0.1:8000/api/search?address=" +
                        this.address +
                        "&distanceKm=" +
                        this.distanceKm +
                        "&roomsNumber=" +
                        this.roomsNumber +
                        "&bedsNumber=" +
                        this.bedsNumber +
                        "&checkedServices=" +
                        String(this.checkedServices)

                    //     address: this.address,
                    //     roomsNumber: this.roomsNumber,
                    //     bedsNumber: this.bedsNumber,
                    //     distanceKm: this.distanceKm
                )
                .then(function(resp) {
                    self.flatsArr = resp.data;
                });
        }
    }
});
