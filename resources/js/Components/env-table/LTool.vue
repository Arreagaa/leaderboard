<script setup>
import LPagination from './table/LPagination.vue';
import LTable from './table/LTable.vue';
import LLoader from "../LLoader.vue";
import LDropdown from './LDropdown.vue';
import LBtnOptions from '../buttons/LBtnOptions.vue';
import { ref } from 'vue';

const props = defineProps({
    resources: {
        type: Object,
        default: () => {},
    },
    config: {
      type: Object,
      default: () => ({
        
        headers: [
          {name: 'Nombre', key: 'name'},
          {name: 'Color', key: 'color'},
        ]
      }),
    }
});

const emit = defineEmits(['delete'])

let load = ref({
  main: false
});

</script>

<template>
  <div>
    <div class="l-card">
      <div
        v-if="resources.total == 0"
        class="text-center p-12"
      >
        <span class="text-gray-600">We have not found records</span>
        <div class="mt-4">
          <a
            :href="config.baseUrlCreate"
            class="shadow bg-slate-600 px-4 py-2 rounded-md cursor-pointer"
          >
            <span class="text-white">Create resource</span>
          </a>
        </div>
      </div>
      <div v-else>
        <div 
          v-if="false" 
          class="flex justify-end"
        >
          <LDropdown :content-classes="['p-3', 'bg-white','w-48']">
            <template #trigger> 
              <LBtnOptions />
            </template>
            <template #content>
              <div>
                <span>Nada por ahora</span>
              </div>
            </template>
          </LDropdown>
        </div>
        <div
          v-if="load.main"
          class="p-8 flex justify-center items-center"
        >
          <LLoader />
        </div>
        <div class="mt-3">
          <LTable
            :resources="resources"
            :headers="config.headers"
            @delete="$emit('delete', $event)"
          />
          <LPagination :config="resources" />
        </div>
      </div>
    </div>
  </div>
</template>