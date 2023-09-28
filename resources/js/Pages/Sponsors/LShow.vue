<script setup>
    import AppHeader from '../../Layouts/AppHeader.vue';
    import AppFooter from '../../Layouts/AppFooter.vue';
    import LBagTitle from '../Landing/utils/LBagTitle.vue';
    import LSliderPartners from '../Landing/LSliderPartners.vue';

</script>
<template>
  <AppHeader />
  <div class="max-w-app relative">
    <LBagTitle title="Patrocinadores" />
    <div class="relative ">
      <div
        class="l-max-w 2xl:px-0 px-16 flex justify-center py-12"
      >
        <LSliderPartners />
      </div>
    </div>
  </div>
  <AppFooter />
</template>
