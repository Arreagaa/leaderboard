<script setup>
import axios from 'axios';
import { onMounted, ref } from 'vue';
import vSelect from 'vue-select'

const props = defineProps({
  modelValue: {
      type: [String, Number, Object],
      default: '',
  },
  field: {
    type: Object,
    default : ()=> {
      return {
        name: '',
        label: '',
        type: 'text',
        required: false,
        placeholder: '',
      };
    }
  },
  reduce: {
    type: Boolean,
    default: true
  }
});

const emit = defineEmits(['update:modelValue', 'change']);
const options = ref([])
const load = ref(true)

onMounted(() => {
    axios
    .get(props.field.url)
    .then(({data})=>{
        options.value = data
    })
    .catch(()=>{
        console.log('Error')
    })
    .finally(()=>{
        load.value = false
    })
});

</script>
<template>
  <div class="col-span-6 sm:col-span-3">
    <label
      for="first-name"
      class="block text-sm font-medium text-gray-700"
    >{{ field.label }} </label>
    <vSelect
      :model-value="modelValue"
      :options="options"
      :loading="load"
      :label="field.type"
      :reduce="(item) => reduce ? item.id : item"
      :placeholder="field.placeholder"
      class="mt-1 focus:ring-slate-500 focus:border-slate-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
      @update:model-value="$emit('update:modelValue', $event)"
      @change="emit('change')"
    />
  </div>
</template>
<style>
.vs__search::placeholder { color: rgb(122, 122, 122); }

</style>
