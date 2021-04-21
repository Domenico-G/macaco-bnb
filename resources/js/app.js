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
        checkedServices: [],
        classDropdownSection: "",
        titleFlag: false,
        titleSearchedInput: "",
        titleNoResultsFlag: false

    },

    mounted() {
        //TODO: chiamata API sponsorizzate
    },
    methods: {
        getFlats: function () {
            const self = this;
            axios
                .get("http://127.0.0.1:8000/api/search", {
                    params: {
                        address: this.address,
                        roomsNumber: this.roomsNumber,
                        bedsNumber: this.bedsNumber,
                        distanceKm: this.distanceKm,
                        checkedServices: String(this.checkedServices)
                    }
                })
                .then(function (resp) {
                    self.titleSearchedInput = self.address;

                    if (resp.data.length === 0) {
                        self.titleNoResultsFlag = true;

                        self.titleFlag = false;
                    } else {
                        self.titleFlag = true;

                        self.titleNoResultsFlag = false;
                    }

                    self.flatsArr = resp.data;
                });
        },
        toggleDropdownSection: function () {
            if (this.classDropdownSection === "") {
                return this.classDropdownSection = "active"
            }

            if (this.classDropdownSection === "active") {
                return this.classDropdownSection = ""
            }
        }
    },
});
