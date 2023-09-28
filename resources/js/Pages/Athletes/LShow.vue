<script setup>
    import AppHeader from '../../Layouts/AppHeader.vue';
    import AppFooter from '../../Layouts/AppFooter.vue';
    import LBagTitle from '../Landing/utils/LBagTitle.vue';
    import LSilderAthletes from '../Landing/LSilderAthletes.vue';

</script>
<template>
  <AppHeader />
  <div class="max-w-app relative">
    <LBagTitle title="Nuestros atletas" />
    <div class="relative">
      <div
        class="l-max-w 2xl:px-0 lg:px-16 px-8 flex justify-center lg:py-28 py-8"
      >
        <LSilderAthletes />
      </div>
    </div>
  </div>
  <AppFooter />
</template>
