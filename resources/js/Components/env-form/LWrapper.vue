<script setup>
import EnvTable from "@/Components/env-table/LTool.vue";
import LBtnPrimary from "@/Components/buttons/LBtnPrimary.vue";
import { ref } from "vue";
import LDelete from "@/Components/env-detail/LDelete.vue";

const props = defineProps({
  resources: {
    type: Object,
    default: () => {},
  },
  config: {
    type: Object,
    default: () => ({
      headers: [
        { name: "Name", key: "name" },
        { name: "Description", key: "description" },
      ],
      title: "Events",
      titleSingle: "Event",
      baseUrlCreate: "/diradmin/events/create",
      baseUrlDelete: "events.destroy",
    }),
  },
});

const showDelete = ref(false);
const select = ref({});

const openDelete = (item) => {
  showDelete.value = true;
  select.value = item;
};

const succesDelete = () => {
  showDelete.value = false;
  select.value = {};
};
</script>

<template>
  <div class="max-w-app">
    <div 
      v-if="config.baseUrlCreate" 
      class="flex items-end justify-end mb-4"
    >
      <LBtnPrimary
        :url="config.baseUrlCreate"
        :name="`Create ${config.titleSingle}`"
      />
    </div>
    <EnvTable
      :resources="resources"
      :config="config"
      @delete="openDelete($event)"
    />
    <LDelete
      :resource="select"
      :url="config.baseUrlDelete"
      :show="showDelete"
      @close="showDelete = false"
      @delete="succesDelete()"
    />
    <slot />
  </div>
</template>