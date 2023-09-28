<script setup>
  import WrapperForm from './utils/WrapperForm.vue';
  import LInput from './utils/LInput.vue';
  import { ref } from 'vue';
  

  const resource = ref({
    name: '',
    lastname: '',
    email: '',
    date_of_birth: '',
    dpi: '',
    sex: '',
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
    label: 'Email',
    type: 'email',
    required: false,
    placeholder: '',
  },
  {
    name: '',
    label: 'Fecha de nacimiento',
    type: 'date',
    required: false,
    placeholder: '',
  },
  {
    name: '',
    label: 'Dpi',
    type: 'text',
    required: false,
    placeholder: '',
  },
  {
    name: '',
    label: 'Sexo',
    type: 'text',
    required: false,
    placeholder: '',
  }
  ,
  {
    name: '',
    label: 'Número de teléfono',
    type: 'text',
    required: false,
    placeholder: '',
  }
])

const clear = () => {
  resource.value = {
    name: '',
    lastname: '',
    email: '',
  }
}

</script>
<template>
  <WrapperForm
    title-header="REGISTRO DE ESPECTADORES"
    :resource="resource"
    url="/apply/user"
    :show-img="true"
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
      v-model="resource.email"

      class="lg:w-1/2 w-full"
      :field="fields[2]"
    />
    <div class="flex lg:flex-nowrap flex-wrap gap-x-5">
      <LInput
        v-model="resource.date_of_birth"
        class="lg:w-1/2 w-full"
        :field="fields[3]"
      />
      <LInput
        v-model="resource.dpi"

        class="lg:w-1/2 w-full"
        :field="fields[4]"
      />
    </div>
    <div class="flex lg:flex-nowrap flex-wrap gap-x-5">
      <div class="lg:w-1/2 w-full">
        <label
          for="first-name"
          class="block text-sm font-medium text-gray-700"
        >{{ 'Sexo' }}</label>
        <div class="flex items-center my-2">
          <div>
            <label for="input-sex-m"><input
              id="input-sex-m"
              v-model="resource.sex"
              value="M"
              type="radio"
              name="input-sex"
            > M</label>
          </div>
          <div class="mx-2">
            <label for="input-sex-f"><input
              id="input-sex-f"
              v-model="resource.sex"
              value="F"
              type="radio"
              name="input-sex"
            > F</label>
          </div>
        </div>
      </div>
      <LInput
        v-model="resource.phone"
        class="lg:w-1/2 w-full"
        :field="fields[6]"
      />
    </div>
  </WrapperForm>
</template>