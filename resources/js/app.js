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
        normalFlats: [],
        sponsoredFlats: [],
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
        ],


        lonMapMarker:'12.55251545667927',//data per i marker della mappa
        latMapMarker:'42.090241374915855',//data per i marker della mappa
        titleFlatMarker:'Dove ti porta il cuore?',//data per i marker della mappa
        priceMapMarker:'',//data per i marker della mappa
        addressMarker: '',
        zoomView: 5,

        multiMarker: []
    },

    mounted() {
        /* >>>>>>MAP TOMTOM IMPORT <<<<< */
        //la const pos passa le coordinate della posizione di riferimento
       const pos ={ lng: this.lonMapMarker, lat: this.latMapMarker };
       let newZoom=parseInt(this.zoomView);

       var mapDiv = document.getElementById("map-div");
       this.map = tt.map({
           key: "iTF86GRA2V5iGjM6LMMV54lrK8v6zC1w",
           container: "map-div",
           style: "tomtom://vector/1/basic-main",
           //center importa la posizione di riferimento della ricerca
           center: pos,
           zoom: newZoom
       });
       //funzione che abilita il tasto full screen
       this.map.addControl(new tt.FullscreenControl());
       //funzione che abilita i tasti per navigare la mappa (zoom in out e bussola)
       this.map.addControl(new tt.NavigationControl());
       //aggiunge la funzione che renderizza il marker sulla mappa
       this.addMarker2(this.map);
          /* >>>>>>END MAP TOMTOM IMPORT <<<<< */
     },
    methods: {
    mapRendering: function(){
                /* >>>>>>MAP TOMTOM IMPORT <<<<< */
        //la const pos passa le coordinate della posizione di riferimento
        let pos;

        if(this.sponsoredFlats.length > 0){
            pos ={ lng: this.sponsoredFlats[0].lon, lat: this.sponsoredFlats[0].lat };
        }else if(this.sponsoredFlats.length === 0 && this.normalFlats.length === 0){
            pos ={ lng: this.lonMapMarker, lat: this.latMapMarker };
        }else{
            pos ={ lng: this.normalFlats[0].lon, lat: this.normalFlats[0].lat };
        }

           var mapDiv = document.getElementById("map-div");
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
        //    this.addMarker(this.map);
            /* >>>>>>END MAP TOMTOM IMPORT <<<<< */
            this.getDataForMarker();
        },
        //al caricamento della pagina prende la lat e la lon per creare il marker sulla mappa in maniera dinamica e le informazioni del flat
        getInfoForMarker: function(paramLon, paramLat, title, price,address, zoom) {
            this.lonMapMarker = paramLon;
            this.latMapMarker = paramLat;
            this.titleFlatMarker = title;
            this.addressMarker = address;
            this.priceMapMarker = price;
            this.zoomView = zoom;
        },
        addMarker2: function(map){
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

        //funzione di tomtom per aggiugere i marker alla mappa
        addMarker: function(map){
            for (let x = 0; x < this.multiMarker.length; x++) {
                const element = this.multiMarker[x];
                const tt = window.tt;
                //qui bisogna inserire la coordinata del marker nell'ordine lon e lat
                 var location = [element.lon, element.lat];
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
                 .setHTML( '<h5 style="font-size:13px;">' + element.title + '</h5>'
                    + '<div style="color:#797979; font-style: italic">' + element.address + '</div>'
                    + ' price: ' + element.price + ' €');
                 marker.setPopup(popup).togglePopup();
            }

        },
        getDataForMarker: function(){
            this.multiMarker=[];
            for (let index = 0; index < this.normalFlats.length; index++) {
                this.multiMarker.push({
                    lat: this.normalFlats[index].lat,
                    lon: this.normalFlats[index].lon,
                    title: this.normalFlats[index].details['flat_title'],
                    price: this.normalFlats[index].details['price_day'],
                    address: this.normalFlats[index].street_name + ' ' + this.normalFlats[index].street_number
                })
            }

            for (let index = 0; index < this.sponsoredFlats.length; index++) {
                this.multiMarker.push({
                    lat: this.sponsoredFlats[index].lat,
                    lon: this.sponsoredFlats[index].lon,
                    title: this.sponsoredFlats[index].details['flat_title'],
                    price: this.sponsoredFlats[index].details['price_day'],
                    address: this.sponsoredFlats[index].street_name + ' ' + this.sponsoredFlats[index].street_number
                })
            }
            this.addMarker(this.map)

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
                .then(function(resp) {
                    self.titleSearchedInput = self.address;

                    if (resp.data.normals.length === 0 && resp.data.sponsoreds.length === 0) {
                        self.titleNoResultsFlag = true;

                        self.titleFlag = false;
                    } else {
                        self.titleFlag = true;

                        self.titleNoResultsFlag = false;
                    }
                    self.normalFlats = resp.data.normals;

                    self.sponsoredFlats = resp.data.sponsoreds;

                    self.mapRendering();
                });
        },
        getChar: function (id) {
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
                { month: "January", views: this.numberRandomizer(30, 60) },
                { month: "February", views: this.numberRandomizer(30, 100) },
                { month: "March", views: this.numberRandomizer(30, 70) },
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
                console.log(item.flat_id);
                if (id === item.flat_id) {
                    let viewMonth = date(item.updated_at);

                    dataArrChar.forEach(el => {
                        if (el.month == viewMonth.format("MMMM")) {
                            el.views += 1;
                        }
                    });
                }
            });

            console.log(dataArrChar.map(item => item.views));

            return dataArrChar.map(item => item.views);
        },
        toggleDropdownSection: function() {
            if (this.classDropdownSection === "") {
                return (this.classDropdownSection = "active");
            }

            if (this.classDropdownSection === "active") {
                return (this.classDropdownSection = "");
            }
        },
        toggleCloseSection: function() {
            if (this.classDropdownSection === "active") {
                return (this.classDropdownSection = "");
            }
        },

        numberRandomizer: function(min, max) {
            return Math.floor(Math.random() * (max + 1 - min) + min);
        },

        showMap: function(){
            let mapIcon= document.getElementsByClassName('mapboxgl-ctrl-fullscreen')[0];
            mapIcon.click();
        }
    }
});
