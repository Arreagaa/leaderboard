<script setup>
import { ref } from 'vue';
import AppHeader from '../../Layouts/AppHeader.vue';
import AppFooter from '../../Layouts/AppFooter.vue';
import LBagTitle from '../Landing/utils/LBagTitle.vue';
import StepPay from './clase/utils/StepPay.vue';
import StepFooter from './clase/utils/StepFooter.vue';
import StepForm from './clase/utils/StepForm.vue';
  
const active = ref(1)

</script>
<template>
  <AppHeader />
  <div class="max-w-app relative">
    <LBagTitle title="REGISTRATE A CLASE" />
    <div class="lg:py-24 py-16">
      <StepPay v-if="active == 1" />
      <StepForm v-if="active == 2" />
      
      <StepFooter
        v-model="active"
        :max="2"
      />
    </div>  
  </div>
  <AppFooter />
</template>