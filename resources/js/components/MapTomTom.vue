<template>

    <div class="container">

         <div id='map' ref="mapRef"></div>
    </div>
</template>

<script>
    import ref from 'vue'
    export default {
        name:'map-tom-tom',
        mounted(){
            const tt = window.tt;
            var map = tt.map({
                key: 'iTF86GRA2V5iGjM6LMMV54lrK8v6zC1w',
                container: mapRef.value,
                style: 'tomtom://vector/1/basic-main',
            });
                map.addControl(new tt.FullscreenControl());
                map.addControl(new tt.NavigationControl());
                addMarker(map);
                function addMarker(map){
            const tt = window.tt;
                var location = [45.47426954182167, 9.17326734712459];
                var popupOffsets = {
                top: [0, 0],
                bottom: [0, -30],
                'bottom-right': [0, -30],
                'bottom-left': [0, -30],
                left: [25, -35],
                right: [-25, -35]
                }
                var marker = new tt.Marker().setLngLat(location).addTo(map);
                var popup = new tt.Popup({offset: popupOffsets}).setHTML("Your address!");
                marker.setPopup(popup).togglePopup();
            }
            return {
            mapRef,
            }
        }

    }
</script>
