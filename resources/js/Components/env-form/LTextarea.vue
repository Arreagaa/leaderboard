<script setup>
const props = defineProps({
  modelValue: {
      type: [String, Number],
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

const emit = defineEmits(['update:modelValue']);

</script>
<template>
  <div class="col-span-6 sm:col-span-3">
    <label
      for="first-name"
      class="block text-sm font-medium text-gray-700"
    >{{ field.label }}</label>
    <textarea
      :id="field.name"
      rows="3"
      :value="modelValue"
      :name="field.name"
      :placeholder="field.placeholder"
      class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
      @input="$emit('update:modelValue', $event.target.value)"
    />
  </div>
</template>
