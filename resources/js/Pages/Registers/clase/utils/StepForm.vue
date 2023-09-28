<script setup>
import LForm from './LForm.vue';
import StepSchedule from './StepSchedule.vue';
import LValidateSchedule from './LValidateSchedule.vue';
import { ref } from 'vue';
const props = defineProps({
  type: {
    type: String,
    default: ''
  },
}) 
const emit = defineEmits(['form', 'schedule'])

const schedule = ref(null)

const changeSchedule = (sch) =>{
  emit('schedule', sch)
  schedule.value = sch
}
</script>
<template>
  <div class="border border-gray-200 rounded-md p-4">
    <h1 class="text-2xl font-semibold">
      Registrarse
    </h1>
    <div class="flex lg:flex-nowrap flex-wrap mt-2">
      <StepSchedule
        class="lg:w-1/3 w-full lg:pr-4 pr-0"
        :type="type"
        @schedule="changeSchedule($event)"
      />
      <div class="lg:w-2/3 w-full">
        <h1 class="text-lg">
          Información personal
        </h1>
        <LValidateSchedule :schedule="schedule">
          <LForm
            @form="emit('form', $event)"
          />
          <slot />
        </LValidateSchedule>
      </div>
    </div>
  </div>
</template>