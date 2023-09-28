<script setup>
  import WrapperForm from './utils/WrapperForm.vue';
  import LInput from './utils/LInput.vue';
  import { ref } from 'vue';
  
  const resource = ref({
    name: '',
    lastname: '',
    experience: '',
    age: '',
    email: '',
    phone: '',
  });


  const fields = ref([
  {
    name: '',
    label: 'Nombre',
    type: 'text',
    required: false,
    placeholder: '',
  },
  {
    name: '',
    label: 'Apellido',
    type: 'text',
    required: false,
    placeholder: '',
  },
  {
    name: '',
    label: 'Experiencia',
    type: 'text',
    required: false,
    placeholder: '',
  },
  {
    name: '',
    label: 'Edad',
    type: 'text',
    required: false,
    placeholder: '',
  },{
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
  }
  ])
  
  const clear = () => {
  resource.value = {
    name: '',
    lastname: '',
    experience: '',
    age: '',
    email: '',
    phone: '',
  }
}

  </script>
<template>
  <WrapperForm
    title-header="Conviértete en voluntario"
    :resource="resource"
    url="/apply/volunteer"
    @create="clear"
  >
    <div class="flex lg:flex-nowrap flex-wrap gap-x-5">
      <LInput
        v-model="resource.name"

        class="lg:w-1/2 w-full"
        :field="fields[0]"
      />
      <LInput
        v-model="resource.lastname"

        class="lg:w-1/2 w-full"
        :field="fields[1]"
      />
    </div>
    <LInput
      v-model="resource.experience"
      :field="fields[2]"
    />
    <div class="flex lg:flex-nowrap flex-wrap gap-x-5">
      <LInput
        v-model="resource.age"

        class="lg:w-1/2 w-full"
        :field="fields[3]"
      />
      <LInput
        v-model="resource.email"

        class="lg:w-1/2 w-full"
        :field="fields[4]"
      />
    </div>
    <div class="flex lg:flex-nowrap flex-wrap gap-x-5">
      <LInput
        v-model="resource.phone"

        class="lg:w-1/2 w-full"
        :field="fields[5]"
      />
    </div>
  </WrapperForm>
</template>