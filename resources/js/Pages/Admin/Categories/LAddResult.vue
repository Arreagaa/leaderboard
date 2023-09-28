<script setup>
import { useForm } from '@inertiajs/inertia-vue3';
import { ref } from 'vue';
import Modal from '@/Jetstream/Modal.vue';
import LSelect from '../../../Components/env-form/LSelect.vue';
import LInput from '../../../Components/env-form/LInput.vue';
import LTime from '../../../Components/env-form/LTime.vue';

const props = defineProps({
  eventId:{
    type: [String, Number],
    default: ''
  },
  show: {
      type: Boolean,
      default: false,
  },
})

const emit = defineEmits(['add', 'close'])

const form = useForm({
  competition_id: null,
  athlete_id: null,
  category_id: props.eventId,
  result: null,
  time: "00:00:00",
})


const fields = ref({
  competitions: {
    name: 'workout_id',
    label: 'Workout',
    url: `/only/categories/${props.eventId}/workouts`,
    type: 'name',
    required: true,
    placeholder: 'Workouts',
  },
  athletes: {
    name: 'athlete_id',
    label: 'Athlete',
    url: `/only/categories/${props.eventId}/athletes`,
    type: 'full_name',
    required: true,
    placeholder: 'Athlete',
  },
  result: {
    label: 'Result',
    type: 'number',
    required: true,
    placeholder: 'Result',
  },
})

const processForm = () => {
    form.post(`/diradmin/categories/${props.eventId}/results`, {
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
          Add Result
        </h1>
        <!-- fields, select  -->
        <LSelect
          v-model="form.competition_id"
          class="mb-4"
          :reduce="false"
          :field="fields.competitions"
        />
        <LSelect
          v-model="form.athlete_id"
          class="mb-4"
          :field="fields.athletes"
        />
        <div
          v-if="form.competition_id != null"
          class=""
        >
          <!-- fields, input  -->
          <LInput
            v-if="form.competition_id.competition_type.type == 'number'"
            v-model="form.result"
            :field="fields.result"
          />
          <!-- fields, input  -->
          <LTime
            v-if="form.competition_id.competition_type.type == 'time'"
            v-model="form.time"
            :field="fields.result"
          />
        </div>
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
          :disabled="form.processing || (form.time == null && form.result == null)"
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
          <span
            v-else
            class="px-4"
          >Add result</span>
        </button>
      </div>
    </form>
  </Modal>
</template>