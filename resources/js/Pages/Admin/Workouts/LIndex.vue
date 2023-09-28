<script setup>
import { ref } from 'vue';
import LWrapper from '../../../Components/env-form/LWrapper.vue';
import AppLayout from '@/Layouts/AppLayout.vue';

const props = defineProps({
    resources: {
        type: Object,
        default: () => {},
    },
});

const config = ref({    
  headers: [
    {name: 'Name', key: 'name'},
    {name: 'Description', key: 'description'},
    {name: 'Type', key: 'competition_type_name'},
  ],
  title: 'Workouts',
  titleSingle: 'Workout',
  baseUrlCreate: '/diradmin/workouts/create',
  baseUrlDelete: 'workouts.destroy',
})


</script>

<template>
  <AppLayout
    :title="config.title"
    :title-header="config.title"
  >
    <LWrapper
      :resources="resources"
      :config="config"
    />
  </AppLayout>
</template>