/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import Chart from "chart.js/auto/auto.js";
import axios from "axios";
import Vue from "vue";
window.Vue = Vue;
require("./bootstrap");
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

Vue.prototype.$userId = document
    .querySelector("meta[name='user-id']")
    .getAttribute("content");

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: "#app",
    data: {
        count: 0,
        address: "",
        roomsNumber: "1",
        bedsNumber: "1",
        distanceKm: "20",
        flatsArr: [],
        chartViewInstce: null,
        viewsArr: []
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
                        this.bedsNumber
                )
                .then(function(resp) {
                    self.flatsArr = resp.data;
                });
        },

        getChar: function(id) {
            console.log(id);
            const self = this;
            axios
                .get("http://127.0.0.1:8000/api/views?id=" + this.$userId)
                .then(function(resp) {
                    self.viewsArr = resp.data;
                    if (self.count > 1) {
                        self.chartViewInstce.destroy();
                    }

                    const chart = document.getElementById("chartView");
                    self.chartViewInstce = new Chart(chart, {
                        type: "bar",
                        data: {
                            labels: [
                                "Red",
                                "Blue",
                                "Yellow",
                                "Green",
                                "Purple",
                                "Orange"
                            ],
                            datasets: [
                                {
                                    label: "# of Votes",
                                    data: [self.count, 19, 3, 5, 2, 3],
                                    backgroundColor: [
                                        "rgba(255, 99, 132, 0.2)",
                                        "rgba(54, 162, 235, 0.2)",
                                        "rgba(255, 206, 86, 0.2)",
                                        "rgba(75, 192, 192, 0.2)",
                                        "rgba(153, 102, 255, 0.2)",
                                        "rgba(255, 159, 64, 0.2)"
                                    ],
                                    borderColor: [
                                        "rgba(255, 99, 132, 1)",
                                        "rgba(54, 162, 235, 1)",
                                        "rgba(255, 206, 86, 1)",
                                        "rgba(75, 192, 192, 1)",
                                        "rgba(153, 102, 255, 1)",
                                        "rgba(255, 159, 64, 1)"
                                    ],
                                    borderWidth: 1
                                }
                            ]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                });
        }
    }
});
