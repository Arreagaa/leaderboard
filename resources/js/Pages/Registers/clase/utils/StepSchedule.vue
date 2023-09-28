<script setup>
import axios from 'axios';
import { ref } from 'vue';

const props = defineProps({
  type: {
    type: String,
    default: ''
  },
}) 
const emit = defineEmits(['schedule'])


const state = ref({
  schedules: []
})
const load = ref({
  schedules: false
})

const getSchedules = ()=>{
  load.value.schedules = true
  axios
  .get(`/register/clase/schedules?type=${props.type}`)
  .then(({data})=>{
    state.value.schedules = data
  })
  .catch(()=>{
    console.log('Error')
  })
  .finally(()=>{
    load.value.schedules = false;
  })
}
getSchedules();


</script>
<template>
  <div class="">
    <div class="mb-4">
      <h1 class="text-lg">
        Horarios
      </h1>

      <div class="">
        <div
          v-for="(item, index) in state.schedules"
          :key="index"
          class=""
        >
          <label
            :for="`schedules-${item.id}`"
            class=""
          > <div class="flex p-3 w-full items-center rounded-md border-blue-200 border mb-2">
            <input
              :id="`schedules-${item.id}`"
              value="M"
              name="input-schedule"
              type="radio"
              @input="emit('schedule', item)"
            >
            <div class="pl-4">          
              <div><span class="text-gray-500"><l-icon icon="fa-solid fa-calendar" /></span> : {{ item.date }}</div> 
              <div><span class="text-gray-500"><l-icon icon="fa-regular fa-clock" /></span> : {{ item.start_time }}</div> 
            </div>
          </div></label>
        </div>
      </div>
    </div>
  </div>
</template>