<script setup>
    import AppHeader from '../../../Layouts/AppHeader.vue';
    import AppFooter from '../../../Layouts/AppFooter.vue';
    import LBagTitle from '../../Landing/utils/LBagTitle.vue';
import { useForm } from '@inertiajs/inertia-vue3';
import { ref, watch } from 'vue';

const props = defineProps({
  resource: {
      type: Object,
      default: () => ({}),
  },
  url: {
      type: String,
      default: '',
  },
  titleHeader: {
      type: String,
      default: '',
  },
  showImg: {
      type: Boolean,
      default: true,
  },
});

const emit = defineEmits(['create']);

const form = useForm({...props.resource});

// watch for resources
watch(props.resource, (value) => {
  for (const key in value) {
    form[key] = value[key]
  }
}, { deep: true });

// computed for resource 

const alertSuccess = ref(false)

const processForm = () => {
  alertSuccess.value = false
  form.post(props.url, {
      errorBag: 'processForm',
      preserveScroll: true,
      onSuccess: (e) => {
        alertSuccess.value = true
        form.reset();
        emit('create')
      },
      onError: (errors) => {
        console.log('errorsin', errors)
      },
  });
};

</script>
<template>
  <form @submit.prevent="processForm">
    <AppHeader />
    <div class="max-w-app relative">
      <LBagTitle :title="titleHeader" />
      <div class="flex lg:flex-nowrap flex-wrap lg:p-16 p-8">
        <div
          class="w-full"
          :class="{'lg:w-1/2': showImg}"
        >
          <slot />
          <div class="flex items-end justify-start mb-4">
            <button
              :disabled="form.processing"
              type="submit"
              class="l-btn-primary"
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
              <span v-else>Enviar</span>
            </button>
          </div>
          <!-- component, alerts  -->
          <!-- alert, success  -->
          <div
            v-if="alertSuccess"
            class="l-alert-success"
          >
            <span>Hemos recibido tu información, pronto te escribiremos.</span>
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
        <div
          v-if="showImg"
          class="lg:w-1/2 w-full p-4 lg:pl-8 pl-0 lg:pt-0 pt-8"
        >
          <div class="rounded-md overflow-hidden">
            <img
              src="../../../../assets/bg-form.jpeg"
              alt=""
            >
          </div>
        </div>
      </div>
    </div>
    <AppFooter />
  </form>
</template>