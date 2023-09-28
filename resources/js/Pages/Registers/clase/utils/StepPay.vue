<script setup>
import { ref } from 'vue';
import StepSchedule from './StepSchedule.vue';
import LIframeDuatlon from '../iframes/LIframeDuatlon.vue';
import LIframeCycling1 from '../iframes/LIframeCycling1.vue';
import LIframeCycling2 from '../iframes/LIframeCycling2.vue';
import LIframeCycling3 from '../iframes/LIframeCycling3.vue';
import LIframeYoga1 from '../iframes/LIframeYoga1.vue';
import LIframeYoga2 from '../iframes/LIframeYoga2.vue';
import LIframeYoga3 from '../iframes/LIframeYoga3.vue';
import LIframeFittestDuo from '../iframes/LIframeFittestDuo.vue';
import LValidateSchedule from './LValidateSchedule.vue';

const frames = {
  LIframeDuatlon,
  LIframeCycling1,
  LIframeCycling2,
  LIframeCycling3,
  LIframeYoga1,
  LIframeYoga2,
  LIframeYoga3,
  LIframeFittestDuo
}

console.log('hola')
const props = defineProps({
  type: {
    type: String,
    default: ''
  },
}) 

const emit = defineEmits(['schedule'])

const schedule = ref(null)

const changeSchedule = (sch) =>{
  emit('schedule', sch)
  schedule.value = sch
}
</script>

<template>
  <div class="border border-gray-200 rounded-md p-4">
    <h1 class="text-2xl font-semibold">
      Pago
    </h1>
    <div class="flex md:flex-nowrap flex-wrap mt-2">
      <StepSchedule
        class="md:w-1/3 w-full lg:pr-4 pr-0"
        :type="type"
        @schedule="changeSchedule($event)"
      />
      <div class="text-lgpr-4 md:w-2/3 w-full">
        <p>Entra al link y realiza tu pago.</p>
        <LValidateSchedule :schedule="schedule">
          <div class="flex justify-center">
            <component :is="frames[schedule.iframe]" />
          </div>
        </LValidateSchedule>
      </div>
    </div>
  </div>
</template>