<script setup>
import { ref } from 'vue';
import AppHeader from '@/Layouts/AppHeader.vue';
import AppFooter from '@/Layouts/AppFooter.vue';
import LBagTitle from '../../Landing/utils/LBagTitle.vue';
import StepPay from './utils/StepPay.vue';
import StepFooter from './utils/StepFooter.vue';
import StepForm from './utils/StepForm.vue';
import { useForm } from '@inertiajs/inertia-vue3';

const props = defineProps({
  type: {
    type: String,
    default: ''
  },
  title: {
    type: String,
    default: ''
  },
  success: {
    type: Boolean,
    default: false
  }
})

const active = ref(1)
const formEmit =  ref(null)
const form = useForm({
  schedule: null,
  user: {
    voucher: null
  },
  users: {},
});

const alertSuccess = ref(false)

const processForm = () => {
  form.user = formEmit.value;
  alertSuccess.value = false;
  
  form.post(route(`apply.store.${props.type}`), {
      errorBag: 'processForm',
      forceFormData: true,
      preserveScroll: true,
      onSuccess: (e) => {
        form.reset();
        alertSuccess.value = true;
      },
      onError: (errors) => {
        console.log('errorsin', errors)
      },
  });
};
</script>
<template>
  <AppHeader />
  <div class="max-w-app relative">
    <LBagTitle :title="`REGISTRATE A ${title}`" />
    <div class="lg:py-24 py-16">
      <form @submit.prevent="processForm">
        <!-- alert, success  -->
        <div
          v-if="alertSuccess"
          class="l-alert-success my-4"
        >
          <span>Hemos recibido tu información, pronto te enviaremos tu confirmación para la clase.</span>
        </div>

        <div v-if="!alertSuccess">
          <StepPay
            v-if="active == 1"
            :type="type"
          />
          <StepForm
            v-if="active == 2"
            :type="type"
            @form="formEmit = $event"
            @schedule="form.schedule = $event.id"
          >
            <!-- alert, errors  -->
            <div
              v-if="Object.keys(form.errors).length > 0"
              class="l-alert-danger mt-4"
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
          </StepForm>
        </div>
        <div>
          <!-- button, submitted, processing  -->
          <div
            v-if="form.processing"
            class="flex items-end justify-center w-full p-4"
          >
            <span
              class="loader"
            />
          </div>
          <!-- button, submitted, label  -->
          <StepFooter
            v-else
            v-model="active"
            :max="2"
          />
        </div>
      </form>
    </div>  
  </div>
  <AppFooter />
</template>