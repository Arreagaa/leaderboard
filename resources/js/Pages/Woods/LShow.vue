<script setup>
    import AppHeader from '../../Layouts/AppHeader.vue';
    import AppFooter from '../../Layouts/AppFooter.vue';
    import LBagTitle from '../Landing/utils/LBagTitle.vue';
    import { ref } from 'vue';
    import LWoodsCard from './utils/LWoodsCard.vue';

</script>
<template>
  <AppHeader />
  <div class="max-w-app relative">
    <LBagTitle title="Workouts" />
    <div class="flex lg:flex-nowrap flex-wrap sm:p-16 p-8">
      <div class="lg:w-1/3 sm:w-1/2 w-full lg:px-2 px-0 sm:pr-4">
        <div class="px-4 py-2 text-white bg-slate-700">
          Masculino
        </div>
        <LWoodsCard title-header="Hang Tight">
          <img
            src="../../../assets/woods/wood_hang_tight.jpeg"
            alt=""
            class="w-full"
          >
        </LWoodsCard>
        <LWoodsCard title-header="Can you get in it 3?">
          <img
            src="../../../assets/woods/wood_can_you.jpeg"
            alt=""
            class="w-full"
          >
        </LWoodsCard>
        <LWoodsCard title-header="The Yoker">
          <img
            src="../../../assets/woods/wood_the_yoker.jpeg"
            alt=""
            class="w-full"
          >
        </LWoodsCard>
        <LWoodsCard title-header="Proximamente">
          Proximamente....
        </LWoodsCard>
        <LWoodsCard title-header="Proximamente">
          Proximamente....
        </LWoodsCard>
        <LWoodsCard title-header="Proximamente">
          Proximamente....
        </LWoodsCard>
      </div>
      <div class="lg:w-1/3 sm:w-1/2 w-full lg:px-2 px-0 sm:pl-4 sm:my-0 my-4">
        <div class="px-4 py-2 text-white bg-slate-700">
          Femenino
        </div>
        <LWoodsCard title-header="Hang Tight">
          <img
            src="../../../assets/woods/wood_hang_tight.jpeg"
            alt=""
            class="w-full"
          >
        </LWoodsCard>
        <LWoodsCard title-header="Can you get in it 3?">
          <img
            src="../../../assets/woods/wood_can_you.jpeg"
            alt=""
            class="w-full"
          >
        </LWoodsCard>
        <LWoodsCard title-header="The Yoker">
          <img
            src="../../../assets/woods/wood_the_yoker.jpeg"
            alt=""
            class="w-full"
          >
        </LWoodsCard>
        <LWoodsCard title-header="Proximamente">
          Proximamente....
        </LWoodsCard>
        <LWoodsCard title-header="Proximamente">
          Proximamente....
        </LWoodsCard>
        <LWoodsCard title-header="Proximamente">
          Proximamente....
        </LWoodsCard>
      </div>
      <div class="lg:w-1/3 sm:w-1/2 w-full lg:my-0 my-4 lg:px-2">
        <div class="px-4 py-2 text-white bg-slate-700">
          Fittest Duo
        </div>
        <LWoodsCard title-header="Proximamente">
          Proximamente....
        </LWoodsCard>
        <LWoodsCard title-header="Proximamente">
          Proximamente....
        </LWoodsCard>
      </div>
    </div>
  </div>
  <AppFooter />
</template>
