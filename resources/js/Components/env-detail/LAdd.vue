<script setup>
import { useForm } from '@inertiajs/inertia-vue3';
import { ref } from 'vue';
import Modal from '@/Jetstream/Modal.vue';
import LSelect from '../env-form/LSelect.vue';

const props = defineProps({
  eventId:{
    type: [String, Number],
    default: ''
  },
  url: {
    type: String,
    default: ''
  },
  field: {
    type: Object,
    default : ()=> {
      return {
        name: 'name',
        label: 'Categories',
        type: 'name',
        required: false,
        placeholder: 'Categories',
        url: '/only/categories'
      };
    }
  },
  show: {
      type: Boolean,
      default: false,
  },
})

const emit = defineEmits(['add', 'close'])

const form = useForm({
  id: null,
  workout_id: props.eventId
})

const processForm = () => {
    form.post(`${props.url}/${form.id}`, {
        errorBag: 'processForm',
        preserveScroll: true,
        onSuccess: () => {
          emit('add')
        },
        onError: (errors) => {
          console.log(errors)
        },
    });
};

</script>
<template>
  <Modal
    :show="show"
    @close="$emit('close')"
  >
    <form @submit.prevent="processForm">
      <div class="p-4">
        <h1 class="text-lg font-semibold">
          Add {{ field.title }}
        </h1>
        <!-- fields, select  -->
        <LSelect
          v-model="form.id"
          :field="field"
        />
      </div>
      <div class="px-4">
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
      <div class="bg-slate-100 p-4 flex items-center justify-end">
        <a
          class="mr-4 text-gray-700 font-bold text-base cursor-pointer"
          @click="$emit('close')"
        >Return</a>
        <button
          :disabled="form.processing"
          class="bg-slate-600 px-4 py-2 rounded-md text-white"
          type="submit"
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
          <span v-else>Add {{ field.title }}</span>
        </button>
      </div>
    </form>
  </Modal>
</template>