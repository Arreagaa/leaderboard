<script setup>
import { ref } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import LWoodsCard from "../../Woods/utils/LWoodsCard.vue";
import { useForm } from "@inertiajs/inertia-vue3";
import LRequestsFooter from "./utils/LRequestsFooter.vue";

const props = defineProps({
  individual: {
    type: Array,
    default: () => {},
  },
  teams: {
    type: Array,
    default: () => {},
  },
});

const form = useForm({
  type: "",
  id: "",
  approved: "",
});

const alertSuccess = ref(false);
var type = "team";
var id = 0;
var approved = false;

const change = (typee, idd, approvedd) => {
  type = typee;
  id = idd;
  approved = approvedd;
};

const processForm = (typee, idd, approvedd) => {
  change(typee, idd, approvedd);
  alertSuccess.value = false;
  form.type = type;
  form.id = id;
  form.approved = approved;

  form.post(route(`requests.approve`), {
    errorBag: "processForm",
    forceFormData: true,
    preserveScroll: true,
    onSuccess: (e) => {
      form.reset();
      alertSuccess.value = true;
    },
    onError: (errors) => {
      console.log("errorsin", errors);
    },
  });
};
</script>
    
<template>
  <AppLayout title="Solicitudes" title-header="Solicitudes">
    <div class="l-card max-w-app mt-4">
      <LWoodsCard :title-header="`Individuales ${individual.length}`">
        <div
          v-for="(item, index) in individual"
          :key="index"
          class="my-4 border border-gray-200 rounded-md"
        >
          <div class="flex lg:flex-nowrap flex-wrap p-3">
            <div class="lg:w-1/2 w-full">
              <span>Clase</span>
              <div>Clase: {{ item.clase_schedule.name }}</div>
              <div>Hora inicio: {{ item.clase_schedule.start_time }}</div>
              <div>Fecha: {{ item.clase_schedule.date }}</div>
              <div class="mb-4">
                Hora final: {{ item.clase_schedule.end_time }}
              </div>
              <span>Usuario</span>
              <div>Nombre: {{ item.apply_user.name }}</div>
              <div>Apellidos: {{ item.apply_user.lastname }}</div>
              <div>Email: {{ item.apply_user.email }}</div>
              <div>Phone: {{ item.apply_user.phone }}</div>
              <div>Dpi: {{ item.apply_user.dpi }}</div>
              <div>
                Fecha de nacimiento: {{ item.apply_user.date_of_birth }}
              </div>
            </div>
            <div class="lg:w-1/2 w-full p-3">
              <a :href="item.apply_user.voucher">Archivo</a>
              <img :src="item.apply_user.voucher" style="width: 370px" />
            </div>
          </div>
          <div>
            <!-- button, submitted, processing  -->
            <div
              v-if="form.processing"
              class="flex items-center justify-end w-full p-3"
            >
              <span class="loader" />
            </div>
            <!-- button, submitted, label  -->
            <LRequestsFooter
              v-else
              @yes="processForm('individual', item.id, true)"
              @no="processForm('individual', item.id, false)"
            />
          </div>
        </div>
      </LWoodsCard>

      <LWoodsCard :title-header="`Equipos ${teams.length}`">
        <div
          v-for="(item, index) in teams"
          :key="index"
          class="my-4 border border-gray-200 rounded-md"
        >
          <div class="flex lg:flex-nowrap flex-wrap p-3">
            <div class="lg:w-1/2 w-full">
              <div>Clase: {{ item.clase_schedule.name }}</div>
              <div>Hora inicio: {{ item.clase_schedule.start_time }}</div>
              <div class="mb-4">
                Hora final: {{ item.clase_schedule.end_time }}
              </div>
              <div>Fecha: {{ item.clase_schedule.date }}</div>
              <span>Usuarios</span>
              <div>
                <div
                  v-for="(user, indexx) in item.clase_team.users"
                  :key="indexx"
                  class="p-3 mb-4 border border-gray-200"
                >
                  <div>Nombre: {{ user.name }}</div>
                  <div>Apellidos: {{ user.lastname }}</div>
                  <div>Email: {{ user.email }}</div>
                  <div>Phone: {{ user.phone }}</div>
                  <div>Dpi: {{ user.dpi }}</div>
                  <div>Fecha de nacimiento: {{ user.date_of_birth }}</div>
                </div>
              </div>
            </div>
            <div class="lg:w-1/2 w-full p-3">
              <a :href="item.clase_team.voucher">Archivo</a>

              <img :src="item.clase_team.voucher" style="width: 370px" />
            </div>
          </div>
          <div>
            <!-- button, submitted, processing  -->
            <div
              v-if="form.processing"
              class="flex items-center justify-end w-full p-3"
            >
              <span class="loader" />
            </div>
            <!-- button, submitted, label  -->
            <LRequestsFooter
              v-else
              @yes="processForm('team', item.id, true)"
              @no="processForm('team', item.id, false)"
            />
          </div>
        </div>
      </LWoodsCard>
    </div>
  </AppLayout>
</template>