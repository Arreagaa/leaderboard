<script setup>
import { ref } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import LWoodsCard from "../../Woods/utils/LWoodsCard.vue";
import LTable from "../../../Components/env-table/table/LTable.vue";

const props = defineProps({
  yoga: {
    type: Array,
    default: () => {},
  },
  cycling: {
    type: Array,
    default: () => {},
  },
  fittestduo: {
    type: Array,
    default: () => {},
  },
  resources: {
    type: Object,
    default: () => {},
  },
  type: {
    type: String,
    default: () => "yoga",
  },
});

const options = ref([
  { value: "yoga", text: "Yoga" },
  { value: "cycling", text: "Cycling" },
  { value: "fittestduo", text: "Fittest Duo" },
]);

var config = ref({
  headers: [
    { name: "Nombre", key: "name" },
    { name: "Apellido", key: "lastname" },
    { name: "email", key: "email" },
    { name: "Teléfono", key: "phone" },
    { name: "Dpi", key: "dpi" },
    { name: "Sexo", key: "sex" },
    { name: "S Playera", key: "shirt_size" },
  ],
  title: "Registros",
  titleSingle: "Registro",
});

if (props.type == "fittestduo") {
  config.value.headers.push({ name: "Equipo", key: "team_name" });
}

const active = ref("yoga");
</script>
<template>
  <AppLayout 
    title="Registros" 
    title-header="Registros"
  >
    <div class="l-card max-w-app mt-4">
      <div class="flex items-center">
        <a
          v-for="(item, index) in options"
          :key="index"
          class="p-2 hover:shadow cursor-pointer px-4"
          :class="{
            'bg-gray-200 shadow': type === item.value,
            'bg-gray-100': type !== item.value,
          }"
          :href="`/diradmin/registers?type=${item.value}`"
        >
          <span>{{ item.text }}</span>
        </a>
      </div>
      <div class="mt-4 overflow-auto">
        <LTable
          :resources="{ data: resources }"
          :headers="config.headers"
          :buttons-show="false"
        />
      </div>
    </div>
  </AppLayout>
</template>