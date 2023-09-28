<script setup>
import { onMounted, ref } from 'vue';

const props = defineProps({
  modelValue: {
      type: [String, Number, File],
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
  }
});

const emit = defineEmits(['update:modelValue', 'send:file']);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

const changeValue = (e)=>{
  if(props.field.type == 'file'){
    emit('send:file', e.files[0])  
  }else{
    emit('update:modelValue', e.value)
  }
}
defineExpose({ focus: () => input.value.focus() });
</script>
<template>
  <div class="col-span-6 sm:col-span-3">
    <label
      for="first-name"
      class="block text-sm font-medium text-gray-700"
    >{{ field.label }}</label>
    <input
      :id="field.name"
      ref="input"
      :value="modelValue"
      :type="field.type"
      :name="field.name"
      :placeholder="field.placeholder"
      class="mt-1 focus:ring-slate-500 focus:border-slate-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
      @input="changeValue($event.target)"
    >
  </div>
</template>
