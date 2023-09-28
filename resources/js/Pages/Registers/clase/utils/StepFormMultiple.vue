<script setup>
import StepSchedule from './StepSchedule.vue';
import LInput from '../../../../Components/env-form/LInput.vue';
import LValidateSchedule from './LValidateSchedule.vue';
import LUser from './LUser.vue';
import { ref } from 'vue';
import LForm from './LForm.vue';
import LSelect from '../../../../Components/env-form/LSelect.vue';

const props = defineProps({
  type: {
    type: String,
    default: ''
  },
  maxUsers: {
    type: Number,
    default: 3
  }
}) 

const emit = defineEmits(['schedule', 'form-0','form-1', 'form-2', 'name-team', 'file', 'category'])

const schedule = ref(null)
const name = ref(null)
const category = ref(null)

const changeSchedule = (sch) =>{
  emit('schedule', sch)
  schedule.value = sch
}

const changeName = ()=>{
  emit('name-team', name.value)
}

const changeCategory = ()=>{
  console.log(category.value)
  emit('category', category.value)
}

</script>
<template>
  <div class="border border-gray-200 rounded-md p-4">
    <h1 class="text-2xl font-semibold">
      Registrarse
    </h1>
    <div class="flex lg:flex-nowrap flex-wrap mt-2">
      <div class="lg:w-1/3 w-full lg:pr-4 pr-0">
        <StepSchedule
          class="w-full"
          :type="type"
          @schedule="changeSchedule($event)"
        />
        <LSelect
          v-if="type == 'duatlon'"
          v-model="category"
          class="w-full"
          :field="{
            label: 'Categorias',
            url: '/register/clase/duatlon/categories',
            type: 'name',
            labelShow: 'name',
            typeField: 'select',
            placeholder: 'Categoria',
          }"
          @update:model-value="changeCategory()"
        />
      </div>
      <div class="lg:w-2/3 w-full">
        <h1 class="text-lg">
          Información personal
        </h1>
        <LValidateSchedule :schedule="schedule">
          <LInput
            v-model="name"
            class="md:w-1/2 w-full  mb-2"
            :field="{
              label: 'Nombre del equipo',
              type: 'text',
              typeField: 'input',
            }"
            @input="changeName"
          />
          <LUser
            v-for="item in maxUsers"
            :key="item"
            :type="item"
          >
            <LForm
              :is-file="false"
              :type="type"
              :id-form="item"
              @form="emit(`form-${item}`, $event)"
            />
          </LUser>
          <div
            class="col-span-6 sm:col-span-3 mt-4"
          >
            <label
              for="first-name"
              class="block text-sm font-medium text-gray-700"
            >Comprobante de pago</label>
            <input
              type="file"
              class="mt-1 focus:ring-slate-500 focus:border-slate-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
              @input="emit('file', $event.target.files[0])"
            >
          </div>
          <slot />
        </LValidateSchedule>
      </div>
    </div>
  </div>
</template>