<script setup>
    import AppHeader from '../../Layouts/AppHeader.vue';
    import AppFooter from '../../Layouts/AppFooter.vue';
    import LBagTitle from '../Landing/utils/LBagTitle.vue';
</script>
<template>
  <AppHeader />
  <div class="max-w-app relative">
    <LBagTitle title="Calendar" />
    <div class="w-full flex justify-center lg:flex-nowrap flex-wrap lg:py-16 py-8">
      <div class="lg:w-1/2 w-full">
        <img
          class="img-fluid"
          src="../../../assets/calendar/LHorario-2.jpeg"
          alt=""
        >
      </div>
    </div>
  </div>
  <AppFooter />
</template>
