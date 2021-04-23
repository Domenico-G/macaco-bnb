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
        checkedServices: [],
        classDropdownSection: "",
        titleFlag: false,
        titleSearchedInput: "",
        titleNoResultsFlag: false,
        chartViewInstce: null,
        viewsArr: [],
        map: null,

        /*
        questi data formano il carousel visibile se il video del jumbotron non dovesse
        essere supportato dal browser
        */
        carouselJumbo: [
            {
                imgJumbo: "imageOfPage/jumbo-carousel/villa2.jpeg",
                bootStrapAlt: "Second slide"
            },
            {
                imgJumbo: "imageOfPage/jumbo-carousel/villa4.jpeg",
                bootStrapAlt: "Third slide"
            },
            {
                imgJumbo: "imageOfPage/jumbo-carousel/villa1.jpeg",
                bootStrapAlt: "Fourth slide"
            }
        ],
        mainCarousel: [
            {
                imgCarousel: "imageOfPage/main-carousel/taranto.jpeg",
                bootStrapAlt: "Second slide",
                dataSlideTo: "1"
            },
            {
                imgCarousel: "imageOfPage/main-carousel/milano.jpeg",
                bootStrapAlt: "Third slide",
                dataSlideTo: "2"
            },
            {
                imgCarousel: "imageOfPage/main-carousel/catania.jpeg",
                bootStrapAlt: "Fourth slide",
                dataSlideTo: "3"
            },
            {
                imgCarousel: "imageOfPage/main-carousel/bologna.jpeg",
                bootStrapAlt: "Fifth slide",
                dataSlideTo: "4"
            },
            {
                imgCarousel: "imageOfPage/main-carousel/tropea.jpeg",
                bootStrapAlt: "Sixth slide",
                dataSlideTo: "5"
            },
            {
                imgCarousel: "imageOfPage/main-carousel/napoli.jpeg",
                bootStrapAlt: "Seventh slide",
                dataSlideTo: "6"
            },
            {
                imgCarousel: "imageOfPage/main-carousel/abruzzo.jpeg",
                bootStrapAlt: "Eighth slide",
                dataSlideTo: "7"
            },
            {
                imgCarousel: "imageOfPage/main-carousel/roma.jpeg",
                bootStrapAlt: "Ninth slide",
                dataSlideTo: "8"
            },
            {
                imgCarousel: "imageOfPage/main-carousel/vicenza.jpeg",
                bootStrapAlt: "Tenth slide",
                dataSlideTo: "9"
            }
        ]
    },

    mounted() {
        const pos = { lng: -122.47483, lat: 37.80776 };
        //    var mapDiv = document.getElementById("map-div");

        this.map = tt.map({
            key: "iTF86GRA2V5iGjM6LMMV54lrK8v6zC1w",
            container: "map-div",
            style: "tomtom://vector/1/basic-main",
            center: pos,
            zoom: 12
        });
        console.log(this.map);
    },

    methods: {
        getFlats: function() {
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
                .then(function(resp) {
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

                    // creo dinamicamente la lista dei mesi
                    const moment = require("moment");
                    var m = moment().month();
                    var monthList = moment.months().slice(0, m + 1);



                    // Instanzio il grafico per ogni appartamento
                    const chart = document.getElementById("chartView");
                    self.chartViewInstce = new Chart(chart, {
                        type: "line",
                        type: "line",
                        data: {
                            labels: monthList,
                            datasets: [
                                {
                                    label: "#N° Visualizzazzioni",
                                    data: self.filterChar(self.viewsArr[1], id, moment),
                                    backgroundColor: [
                                        "rgba(54, 162, 235, 0.2)"
                                    ],
                                    borderColor: ["rgba(54, 162, 235, 1)"],
                                    borderWidth: 1
                                },
                                {
                                    label: "#N° Messaggi",
                                    data: self.filterChar(self.viewsArr[0], id, moment),
                                    backgroundColor: ["#ffe0cc"],
                                    borderColor: ["#ff8533"],
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
        },

        filterChar: function(arr, id, date) {
            let dataArrChar = [
                { month: "January", views: 0 },
                { month: "February", views: 0 },
                { month: "March", views: 0 },
                { month: "April", views: 0 },
                { month: "May", views: 0 },
                { month: "June", views: 0 },
                { month: "July", views: 0 },
                { month: "August", views: 0 },
                { month: "September", views: 0 },
                { month: "October", views: 0 },
                { month: "November", views: 0 },
                { month: "December", views: 0 }
            ];

            // Raccolgo solo le visualizzazzioni della stanza selezionata
            arr.forEach(item => {
                if (id === item.flat_id) {
                    let viewMonth = date(item.updated_at);

                    dataArrChar.forEach(el => {
                        if (el.month == viewMonth.format("MMMM")) {
                            el.views += 1;
                        }
                    });
                }
            });

            return dataArrChar.map(item => item.views);
        },

        toggleDropdownSection: function() {
            if (this.classDropdownSection === "") {
                return (this.classDropdownSection = "active");
            }

            if (this.classDropdownSection === "active") {
                return (this.classDropdownSection = "");
            }
        }
    }
});
