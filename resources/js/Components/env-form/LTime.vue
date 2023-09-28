<script setup>
import flatpickr from "flatpickr";
import "flatpickr/dist/themes/airbnb.css";
import { ref, nextTick } from "vue";

const props = defineProps({
  modelValue: {
    type: String,
    default: "",
  },
  field: {
    type: Object,
    default: () => {
      return {
        name: "",
        label: "",
        type: "text",
        required: false,
        placeholder: "",
      };
    },
  },
});

const emit = defineEmits(["update:modelValue"]);
var meTime = ref({
  hours: 0,
  minutes: 0,
  seconds: 0,
});

nextTick(() => {
  flatpickr("#datePicker", {
    enableTime: true,
    noCalendar: true,
    dateFormat: "H:i:s",
    time_24hr: true,
  });
});

const configTime = ref({
  wrap: true,
  enableTime: true,
  enableSeconds: true,
  noCalendar: true,
});

const changeValue = () => {
  var time = "";
  time =
    meTime.value.hours +
    ":" +
    meTime.value.minutes +
    ":" +
    meTime.value.seconds;
  emit("update:modelValue", time);
};
</script>
<template>
  <div class="col-span-6 sm:col-span-3">
    <label 
      for="first-name" 
      class="block text-sm font-medium text-gray-700"
    >
      {{ field.label }}
    </label>
    <div class="flex items-center">
      <div>
        <div>Hours</div>
        <input
          v-model="meTime.hours"
          required
          type="number"
          class="border-gray-300 rounded-md p-1 px-2 w-24 text-right"
          min="0"
          @input="changeValue"
        >
        :
      </div>
      <div class="mx-2">
        <div>Minutes</div>
        <input
          v-model="meTime.minutes"
          required
          type="number"
          class="border-gray-300 rounded-md p-1 px-2 w-24 text-right"
          min="0"
          @input="changeValue"
        >
        :
      </div>
      <div>
        <div>Seconds</div>
        <input
          v-model="meTime.seconds"
          required
          type="number"
          class="border-gray-300 rounded-md p-1 px-2 w-24 text-right"
          min="0"
          @input="changeValue"
        >
      </div>
    </div>
  </div>
</template>