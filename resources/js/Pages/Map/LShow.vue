<script setup>
  import { GoogleMap, Marker } from "vue3-google-map";
  import AppHeader from '../../Layouts/AppHeader.vue';
  import AppFooter from '../../Layouts/AppFooter.vue';
  import LBagTitle from '../Landing/utils/LBagTitle.vue';
  import { ref } from 'vue';
  
  const center = ref({ lat: 14.611029396325769, lng: -90.48583401365119 });

  </script>
<template>
  <AppHeader />
  <div class="max-w-app relative">
    <LBagTitle title="Mapa" />
    <div>
      <div class="lg:flex flex-wrap justify-center sm:p-16 p-8">
        <div class="lg:w-1/2 w-full">
          <GoogleMap
            api-key="AIzaSyCq7aHTKV601i0b1fosJWMDZcgZizakR1A"
            style="width: 100%; height: 500px"
            :center="center"
            :zoom="15"
          >
            <Marker :options="{ position: center }" />
          </GoogleMap>
        </div>
        <div class="lg:w-1/2 w-full lg:pl-8 pl-0 lg:pt-0 pt-8">
          <img
            src="../../../assets/bg-form.jpeg"
            alt=""
          >
        </div>
      </div>
    </div>
  </div>
  <AppFooter />
</template>