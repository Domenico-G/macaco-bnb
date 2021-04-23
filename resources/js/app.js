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
                imgJumbo: 'imageOfPage/jumbo-carousel/villa2.jpeg',
                bootStrapAlt: 'Second slide'
            },
            {
                imgJumbo: 'imageOfPage/jumbo-carousel/villa4.jpeg',
                bootStrapAlt: 'Third slide'
            },
            {
                imgJumbo: 'imageOfPage/jumbo-carousel/villa1.jpeg',
                bootStrapAlt: 'Fourth slide'
            }
        ],
        mainCarousel: [
            {
                imgCarousel: 'imageOfPage/main-carousel/taranto.jpeg',
                bootStrapAlt: 'Second slide',
                dataSlideTo: '1'
            },
            {
                imgCarousel: 'imageOfPage/main-carousel/milano.jpeg',
                bootStrapAlt: 'Third slide',
                dataSlideTo: '2'
            },
            {
                imgCarousel: 'imageOfPage/main-carousel/catania.jpeg',
                bootStrapAlt: 'Fourth slide',
                dataSlideTo: '3'
            },
            {
                imgCarousel: 'imageOfPage/main-carousel/bologna.jpeg',
                bootStrapAlt: 'Fifth slide',
                dataSlideTo: '4'
            },
            {
                imgCarousel: 'imageOfPage/main-carousel/tropea.jpeg',
                bootStrapAlt: 'Sixth slide',
                dataSlideTo: '5'
            },
            {
                imgCarousel: 'imageOfPage/main-carousel/napoli.jpeg',
                bootStrapAlt: 'Seventh slide',
                dataSlideTo: '6'
            },
            {
                imgCarousel: 'imageOfPage/main-carousel/abruzzo.jpeg',
                bootStrapAlt: 'Eighth slide',
                dataSlideTo: '7'
            },
            {
                imgCarousel: 'imageOfPage/main-carousel/roma.jpeg',
                bootStrapAlt: 'Ninth slide',
                dataSlideTo: '8'
            },
            {
                imgCarousel: 'imageOfPage/main-carousel/vicenza.jpeg',
                bootStrapAlt: 'Tenth slide',
                dataSlideTo: '9'
            }
        ],


        lonMapMarker:'',//data per i marker della mappa
        latMapMarker:'',//data per i marker della mappa
        titleFlatMarker:'',//data per i marker della mappa
        priceMapMarker:'',//data per i marker della mappa
        addressMarker: ''
    },

    mounted() {
        /* >>>>>>MAP TOMTOM IMPORT <<<<< */
        //la const pos passa le coordinate della posizione di riferimento
       const pos = { lng: this.lonMapMarker, lat: this.latMapMarker };
    //    var mapDiv = document.getElementById("map-div");
       this.map = tt.map({
           key: "iTF86GRA2V5iGjM6LMMV54lrK8v6zC1w",
           container: "map-div",
           style: "tomtom://vector/1/basic-main",
           //center importa la posizione di riferimento della ricerca
           center: pos,
           zoom: 10
       });
       //funzione che abilita il tasto full screen
       this.map.addControl(new tt.FullscreenControl());
       //funzione che abilita i tasti per navigare la mappa (zoom in out e bussola)
       this.map.addControl(new tt.NavigationControl());
       //aggiunge la funzione che renderizza il marker sulla mappa
       this.addMarker(this.map);

          /* >>>>>>END MAP TOMTOM IMPORT <<<<< */
    },


    methods: {
        //al caricamento della pagina prende la lat e la lon per creare il marker sulla mappa in maniera dinamica e le informazioni del flat
        getInfoForMarker: function(paramLon, paramLat, title, price,address) {
            this.lonMapMarker = paramLon;
            this.latMapMarker = paramLat;
            this.titleFlatMarker = title;
            this.addressMarker = address;
            this.priceMapMarker = price;
        },

        //funzione di tomtom per aggiugere i marker alla mappa
        addMarker: function(map){
            const tt = window.tt;
            //qui bisogna inserire la coordinata del marker nell'ordine lon e lat
             var location = [this.lonMapMarker, this.latMapMarker];
             var popupOffsets = {
               top: [0, 0],
               bottom: [0, -30],
               'bottom-right': [0, -30],
               'bottom-left': [0, -30],
               left: [25, -35],
               right: [-25, -35]
             }
             var marker = new tt.Marker().setLngLat(location).addTo(map);
             //questa variabile popolerà la modale che si apre al click sul marker della mappa
             var popup = new tt.Popup({offset: popupOffsets})
             .setHTML( '<h5 style="font-size:13px;">' + this.titleFlatMarker + '</h5>'
                + '<div style="color:#797979; font-style: italic">' + this.addressMarker + '</div>'
                + ' price: ' + this.priceMapMarker + ' €');
             marker.setPopup(popup).togglePopup();
        },

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

        getChar: function (id) {
            console.log(id);
            const self = this;
            axios
                .get("http://127.0.0.1:8000/api/views?id=" + this.$userId)
                .then(function (resp) {
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
