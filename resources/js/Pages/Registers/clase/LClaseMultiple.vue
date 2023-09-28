<script setup>
import { computed, ref } from 'vue';
import AppHeader from '@/Layouts/AppHeader.vue';
import AppFooter from '@/Layouts/AppFooter.vue';
import LBagTitle from '../../Landing/utils/LBagTitle.vue';
import StepPay from './utils/StepPay.vue';
import StepFooter from './utils/StepFooter.vue';
import StepFormMultiple from './utils/StepFormMultiple.vue';
import { useForm } from '@inertiajs/inertia-vue3';
    
const active = ref(1)
const props = defineProps({
  type: {
    type: String,
    default: ''
  },
  title: {
    type: String,
    default: ''
  },
  maxUsers: {
    type: Number,
    default: 3
  }
}) 

const emitUsers = ref([])
const category = ref(null)
const form = useForm({
  schedule: null,
  users: [],
  voucher: null,
  name: null,
  category: null
});

const alertSuccess = ref(false)

const processForm = () => {
  alertSuccess.value = false;
  form.users = emitUsers.value;
  form.category = category.value;
  
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

const filterMaxUsers =  computed(() =>{
  if  (props.type == 'duatlon' ){
    if(category.value == 'relevos'){
      return 3
    }
    return 1
  }
  return props.maxUsers
})

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
          <StepFormMultiple
            v-if="active == 2"
            :type="type"
            :max-users="filterMaxUsers"
            @form-0="emitUsers[0] = $event"
            @form-1="emitUsers[1] = $event"
            @form-2="emitUsers[2] = $event"
            @form-3="emitUsers[3] = $event"
            @schedule="form.schedule = $event.id"
            @category="category = $event"
            @name-team="form.name = $event"
            @file="form.voucher = $event"
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
          </StepFormMultiple>
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