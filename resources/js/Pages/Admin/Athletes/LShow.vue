<script setup>
import { ref, toRef } from 'vue';
import LWrapper from '../../../Components/env-detail/LWrapper.vue';
import setConfig from './setConfig';

const props = defineProps({  
  resource: {
    type: Object,
    default: () => ({}),
  },
})
const config = ref(setConfig())
</script>

<template>
  <LWrapper
    :resource="resource"
    :config="config"
  />
</template>