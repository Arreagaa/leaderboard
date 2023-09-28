<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import EnvDetail from '@/Components/env-detail/LTool.vue';
import { ref, toRef } from 'vue';
import LDelete from '@/Components/env-detail/LDelete.vue';

const props = defineProps({  
  resource: {
    type: Object,
    default: () => ({}),
  },
  config: {
    type: Object,
    default: () => ({}),
  }
})
const resource = toRef(props, 'resource')

const configThis = ref(props.config)
configThis.value.resource = resource;
configThis.value.typeForm = 'Show'

const showDelete = ref(false)
const successDelete = ()=>{
    console.log('Borradin')
}

</script>

<template>
  <app-layout
    :title-header="`Show ${config.titleSingle}`"
  >
    <EnvDetail
      :config="configThis"
      @delete="showDelete = true"
    />
    <LDelete
      :resource="configThis.resource"
      :url="configThis.baseUrlDelete"
      :show="showDelete"
      @close="showDelete = false"
      @delete="successDelete()"
    />
    <div class="max-w-app">
      <slot />
    </div>
  </app-layout>
</template>