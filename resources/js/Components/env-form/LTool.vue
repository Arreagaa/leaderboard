<script setup>
import { useForm } from '@inertiajs/inertia-vue3';
import { ref } from 'vue';
import LInput from './LInput.vue';
import LTextarea from './LTextarea.vue';
import LSelect from './LSelect.vue';
import LContent from './LContent.vue';

const props = defineProps({
  config: {
      type: Object,
      default: () => ({}),
  },
});

const form = useForm({...props.config.resource});
const alertSuccess = ref(false)

const changeFile = (file, field) => { 
    const reader = new FileReader();
    reader.onload = () => {
      form[field] = reader.result;
    };
    reader.readAsText(file);
}

const processForm = () => {
  alertSuccess.value = false
  form[props.config.method](route(props.config.url, form.id), {
      errorBag: 'processForm',
      preserveScroll: true,
      onSuccess: (e) => {
        alertSuccess.value = true;
      },
      onError: (errors) => {
        console.log('errorsin', errors)
      },
  });
};


</script>
<template>
  <div class="max-w-app">
    <!-- component, form  -->
    <form @submit.prevent="processForm">
      <div class="l-card">
        <!-- form, fields  -->
        <div class="grid grid-cols-6 gap-6 mb-4">
          <template
            v-for="(field) in config.fields"
            :key="field.name"
          >
            <!-- fields, select  -->
            <LSelect
              v-if="field.typeField == 'select'"
              :ref="field.name"
              v-model="form[field.name]"
              :field="field"
            />
            <!-- fields, textarea  -->
            <LTextarea
              v-if="field.typeField == 'textarea'"
              :ref="field.name"
              v-model="form[field.name]"
              :field="field"
            />
            <!-- fields, radio  -->
            <div
              v-if="field.typeField == 'radio'"
              class="col-span-6 sm:col-span-3"
            >
              <label
                for="first-name"
                class="block text-sm font-medium text-gray-700"
              >{{ field.label }}</label>
              <div class="flex items-center my-2">
                <div
                  v-for="(item, index) in field.options"
                  :key="index"
                  class="mr-2"
                >
                  <label :for="`input-radio-${item.value}`"><input
                    :id="`input-${item.value}`"
                    v-model="form[field.name]"
                    :value="item.value"
                    type="radio"
                    :name="`input-${field.name}`"
                  > {{ item.label }}</label>
                </div>
              </div>
            </div>
            <!-- fields, file  -->
            <LContent
              v-if="field.typeField == 'file'"
              :name="field.label"
              :field-for="field.name"
            >
              <input
                type="file"
                @input="form[field.name] = $event.target.files[0]"
              >
            </LContent>
            <!-- fields, input  -->
            <LInput
              v-if="field.typeField == 'input'"
              :ref="field.name"
              v-model="form[field.name]"
              :field="field"
            />
          </template>
        </div>

        <!-- component, alerts  -->
        <!-- alert, success  -->
        <div
          v-if="alertSuccess"
          class="l-alert-success"
        >
          <span>Updated Successfully</span>
        </div>

        <!-- alert, errors  -->
        <div
          v-if="Object.keys(form.errors).length > 0"
          class="l-alert-danger"
        >
          <ul
            class="list-disc pl-4"
          >
            <li
              v-for="item in form.errors"
              :key="item"
            >
              {{ item }}
            </li>
          </ul>
        </div>
      </div>
      <!-- component, footer -->
      <!-- footer, buttons [submit, cancel] -->
      <div class="flex justify-end items-center mt-4">
        <!-- buttons, return  -->
        <a
          :href="config.baseUrl"
          class="mr-4 text-gray-700 font-bold text-base cursor-pointer"
        >Return</a>
        <!-- buttons, submit  -->
        <button
          :disabled="form.processing"
          type="submit"
          class="shadow bg-slate-600 px-4 py-2 rounded-md cursor-pointer"
        >
          <!-- button, submitted, processing  -->
          <div
            v-if="form.processing"
            class="flex items-center justify-center w-28"
          >
            <span
              class="loader"
            />
          </div>
          <!-- button, submitted, label  -->
          <span 
            v-else 
            class="text-white"
          >{{ config.typeForm }} resource</span>
        </button>
      </div> 
    </form>  
  </div>
</template>
<style>
  
</style>
