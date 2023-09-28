<script setup>
import setConfig from './setConfig';
import AppLayout from '@/Layouts/AppLayout.vue';
import EnvForm from '@/Components/env-form/LTool.vue';
import { ref, toRef } from 'vue';

const props = defineProps({  
  resource: {
    type: Object,
    default: () => ({}),
  },
})
const resource = toRef(props, 'resource')

const config = ref(setConfig())
config.value.resource = resource;
config.value.url = 'competitions.update'
config.value.method = 'put'
config.value.typeForm = 'Update'

</script>

<template>
  <app-layout
    title-header="Update Competition"
  >
    <EnvForm :config="config" />
  </app-layout>
</template>