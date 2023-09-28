<script setup>
import setConfig from './setConfig';
import AppLayout from '@/Layouts/AppLayout.vue';
import EnvForm from '@/Components/env-form/LTool.vue';
import { ref } from 'vue';

const config = ref(setConfig())

</script>

<template>
  <app-layout
    title-header="Create Event"
  >
    <EnvForm :config="config" />
  </app-layout>
</template>