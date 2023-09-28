<script setup>
import { useForm } from '@inertiajs/inertia-vue3';
import { ref } from 'vue';
import Modal from '@/Jetstream/Modal.vue';

const props = defineProps({
  eventId:{
    type: [String, Number],
    default: ''
  },
  url: {
    type: String,
    default: ''
  },
  resource: {
    type: Object,
    default: ()=>({
      id: 0
    })
  },
  show: {
      type: Boolean,
      default: false,
  },
})

const emit = defineEmits(['delete', 'close'])

const form = useForm(props.resource)

const processForm = () => {
    form.delete(route(props.url, props.resource.id), {
        errorBag: 'processForm',
        preserveScroll: true,
        onSuccess: () => {
          emit('delete')
        },
        onError: (errors) => {

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
          Delete Resource
        </h1>
        <p>Are you sure you want to delete the resource?</p>
      </div>
      <div class="bg-slate-100 p-4 flex items-center justify-end">
        <a
          class="mr-4 text-gray-700 font-bold text-base cursor-pointer"
          @click="$emit('close')"
        >Return</a>
        <button
          :disabled="form.processing"
          class="bg-red-600 px-4 py-2 rounded-md text-white"
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
          <span v-else>Delete resource</span>
        </button>
      </div>
    </form>
  </Modal>
</template>