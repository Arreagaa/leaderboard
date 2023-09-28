<script setup>
  import WrapperForm from './utils/WrapperForm.vue';
  import LInput from './utils/LInput.vue';
  import { ref } from 'vue';
  
  const fields = ref([
  {
    name: '',
    label: 'Nombre de la compañía',
    type: 'text',
    required: false,
    placeholder: '',
  },
  {
    name: '',
    label: 'Industría',
    type: 'text',
    required: false,
    placeholder: '',
  },
  {
    name: '',
    label: 'Nombre de contacto',
    type: 'text',
    required: false,
    placeholder: '',
  },
  {
    name: '',
    label: 'Email',
    type: 'text',
    required: false,
    placeholder: '',
  },{
    name: '',
    label: 'Número de télefono',
    type: 'text',
    required: false,
    placeholder: '',
  },{
    name: '',
    label: '¿Cómo estás buscando involucrarte?',
    type: 'text',
    required: false,
    placeholder: '',
  }
  ])
  const resource = ref({
    company: '',
    industry: '',
    name: '',
    email: '',
    phone: '',
    description: '',
  });
  const clear = () => {
    resource.value = {
      company: '',
      industry: '',
      name: '',
      email: '',
      phone: '',
      description: '',
  }}
  </script>
<template>
  <WrapperForm
    title-header="Conviértete en patrocinador"
    :resource="resource"
    url="/apply/sponsor"
    @create="clear"
  >
    <div class="flex lg:flex-nowrap flex-wrap gap-x-5">
      <LInput
        v-model="resource.company"
        class="md:w-1/2 w-full"
        :field="fields[0]"
      />
      <LInput
        v-model="resource.industry"
        class="md:w-1/2 w-full"
        :field="fields[1]"
      />
    </div>
    <LInput
      v-model="resource.description"
      :field="fields[5]"
    />
    <div class="flex lg:flex-nowrap flex-wrap gap-x-5">
      <LInput
        v-model="resource.email"

        class="md:w-1/2 w-full"
        :field="fields[3]"
      />
      <LInput
        v-model="resource.phone"

        class="md:w-1/2 w-full"
        :field="fields[4]"
      />
    </div>
    <div class="flex lg:flex-nowrap flex-wrap gap-x-5">
      <LInput
        v-model="resource.name"
        class="md:w-1/2 w-full"
        :field="fields[2]"
      />
    </div>
  </WrapperForm>
</template>