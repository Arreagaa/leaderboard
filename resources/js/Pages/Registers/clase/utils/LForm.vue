<script setup>
import { ref, watch } from 'vue';
import LInput from '../../../../Components/env-form/LInput.vue';

const props = defineProps({
  isFile: {
    type: Boolean,
    default: true
  },
  type: {
    type: String,
    default: 'type'
  },
  idForm: {
    type: Number,
    default: 1
  }
})

const resource = ref({
  name: '',
  lastname: '',
  email: '',
  date_of_birth: '',
  dpi: '',
  sex: '',
  phone: '',
  name_contact_emergency: '',
  phone_contact_emergency: '',
  shirt_size: '',
  voucher: '',
});

const emit = defineEmits(['form', 'file'])

const fields = ref([
  {
    label: 'Nombre',
    type: 'text',
    placeholder: '',
  },
  {
    label: 'Apellido',
    type: 'text',
    placeholder: '',
  },
  {
    label: 'Email',
    type: 'email',
    required: false,
    placeholder: '',
  },
  {
    label: 'Dpi',
    type: 'text',
    placeholder: '',
  },
  {
    label: 'Número de teléfono',
    type: 'text',
    placeholder: '',
  },
  {
    name: '',
    label: 'Nombre de contacto de emergencia',
    type: 'text',
    placeholder: '',
  },
  {
    label: 'Número de contacto de emergencia',
    type: 'text',
    placeholder: '',
  },
  {
    label: 'Fecha de nacimiento',
    type: 'date',
    placeholder: '',
  },
  {
    label: 'Comprobante de pago',
    type: 'file',
    placeholder: '',
  },
  {
    options: [
      { label: 'S', value: 'S' },
      { label: 'M', value: 'M' },
      { label: 'L', value: 'L' },
      { label: 'XL', value: 'XL' },
    ],
  },
])


</script>
<template>
  <div>
    <div class="flex md:flex-nowrap flex-wrap gap-5">
      <LInput
        v-model="resource.name"
        class="md:w-1/2 w-full mb-2"
        :field="fields[0]"
        @input="emit('form', resource)"
      />
      <LInput
        v-model="resource.lastname"
        class="md:w-1/2 w-full  mb-2"
        :field="fields[1]"
        @input="emit('form', resource)"
      />
    </div>
    <div class="flex gap-5">
      <LInput
        v-model="resource.email"
        class="md:w-1/2 w-full  mb-2"
        :field="fields[2]"
        @input="emit('form', resource)"
      />
      <div class="md:w-1/2 w-full flex gap-5  mb-2">
        <div class="col-span-6 sm:col-span-3">
          <label
            for="first-name"
            class="block text-sm font-medium text-gray-700"
          >{{ 'Sexo' }}</label>
          <div class="flex items-center my-2">
            <div>
              <label :for="`input-sex-m-${idForm}`"><input
                :id="`input-sex-m-${idForm}`"
                v-model="resource.sex"
                value="M"
                type="radio"
                :name="`input-sex-m-${idForm}`"
                @input="emit('form', resource)"
              > M</label>
            </div>
            <div class="mx-2">
              <label :for="`input-sex-f-${idForm}`"><input
                :id="`input-sex-f-${idForm}`"
                v-model="resource.sex"
                value="F"
                type="radio"
                :name="`input-sex-f-${idForm}`"
                @input="emit('form', resource)"
              > F</label>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="flex gap-5">
      <LInput
        v-model="resource.dpi"
        class="md:w-1/2 w-full  mb-2"
        :field="fields[3]"
        @input="emit('form', resource)"
      />
      <LInput
        v-model="resource.phone"
        class="md:w-1/2 w-full  mb-2"
        :field="fields[4]"
        @input="emit('form', resource)"
      />
    </div>
    <div class="flex gap-5">
      <LInput
        v-model="resource.name_contact_emergency"
        class="md:w-1/2 w-full  mb-2"
        :field="fields[5]"
        @input="emit('form', resource)"
      />
      <LInput
        v-model="resource.phone_contact_emergency"
        class="md:w-1/2 w-full  mb-2"
        :field="fields[6]"
        @input="emit('form', resource)"
      />
    </div>
    <div class="flex gap-5">
      <LInput
        v-model="resource.date_of_birth"
        class="md:w-1/2 w-full mb-2"
        :field="fields[7]"
        @input="emit('form', resource)"
      />
      <!-- fields, radio  -->
      <div
        class="col-span-6 sm:col-span-3"
      >
        <label
          for="first-name"
          class="block text-sm font-medium text-gray-700"
        >Tamaño de playera</label>
        <div class="flex items-center my-2">
          <div
            v-for="(item, index) in fields[9].options"
            :key="index"
            class="mr-2"
          >
            <label :for="`input-size-${item.value}-${idForm}`"><input
              :id="`input-size-${type}-${idForm}`"
              v-model="resource.shirt_size"
              :value="item.value"
              type="radio"
              :name="`input-size-${type}-${idForm}`"
              @input="emit('form', resource)"
            > {{ item.label }}</label>
          </div>
        </div>
      </div>
    </div>
    <div
      v-if="isFile"
      class="col-span-6 sm:col-span-3"
    >
      <label
        for="first-name"
        class="block text-sm font-medium text-gray-700"
      >Comprobante de pago</label>
      <input
        type="file"
        accept=".jpg, .jpeg, .png, .pdf"
        class="mt-1 focus:ring-slate-500 focus:border-slate-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
        @input="resource.voucher = $event.target.files[0]"
      >
    </div>
  </div>
</template>
