<script setup>
import { ref } from 'vue';
import LWrapper from '@/Components/env-form/LWrapper.vue';
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
    {name: 'Last Name', key: 'last_name'},
    {name: 'Box', key: 'box'},
    {name: 'Category', key: 'category_name'},
  ],
  title: 'Athletes',
  titleSingle: 'Athlete',
  baseUrlCreate: '/diradmin/athletes/create',
  baseUrlDelete: 'athletes.destroy',
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