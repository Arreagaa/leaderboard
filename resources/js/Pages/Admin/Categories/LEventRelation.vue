<script setup>
import LTableHeader from '@/Components/env-table/LTableHeader.vue';
import LTable from '@/Components/env-table/table/LTable.vue';
import LAdd from '@/Components/env-detail/LAdd.vue';
import { ref, toRef } from 'vue';
import LDelete from '../../../Components/env-detail/LDelete.vue';

const props = defineProps({
  title: {
    type: String,
    default: 'Hola'
  },
  eventId: {
    type: [String, Number],
    default: 0
  },
  headers: {
    type:Array,
    default: () => [{name: 'Name', key: 'name'}],
  },
  field: {
    type: Object,
    default : ()=> {
      return {
        name: 'name',
        label: 'Categories',
        type: 'name',
        required: false,
        placeholder: 'Categories',
        url: '/only/categories'
      };
    }
  },
  resources:{
    type: Array,
    default: () => []
  }
})

const show = ref(false)
const showDelete = ref(false)
const select = ref({})

const buttons = ref({
  view: {
    required: false,
    type: 'link',
  },
  edit: {
    required: false,
    type: 'link',
  },
  delete: {
    required: true,
    type: 'event',
  }
})

const openDelete = (item)=>{
  showDelete.value = true
  item.id = [props.eventId, item.id]
  select.value = item
}

const succesDelete = ()=>{
  showDelete.value = false
  select.value = {}
}

</script>
<template>
  <LTableHeader
    :title="title"
    :title-single="title"
    @add="show = true"
  >
    <template #actions>
      <slot name="actions" />
    </template>
  </LTableHeader>
  <div class="l-card mt-4 mb-12">
    <div
      v-if="resources.length == 0"
      class="text-center p-8"
    >
      <span class="text-gray-600">We have not found records</span>
    </div>
    <LTable
      v-else
      :headers="headers"
      :resources="{data: resources, path: ''}"
      :buttons="buttons"
      @delete="openDelete($event)"
    />
  </div>
  <LAdd
    :event-id="eventId"
    :url="field.urlBase"
    :field="field"
    :show="show"
    @close="show = false"
    @add="show = false"
  />
  <LDelete
    :resource="select"
    :url="field.urlBaseDelete"
    :show="showDelete"
    @close="showDelete = false"
    @delete="succesDelete()"
  />
</template>