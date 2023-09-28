<script setup>
import { ref } from "vue";
import "ag-grid-community/styles/ag-grid.css";
import "ag-grid-community/styles/ag-theme-alpine.css";
import { AgGridVue } from "ag-grid-vue3";

const props = defineProps({
  resource: {
    type: Object,
    default: () => ({}),
  },
});

const ag = ref({
  headers: [
    {
      headerName: "Atletas",
      children: [
        { headerName: "Rank", field: "rank", width: 80 },
        { headerName: "Nombre", field: "full_name", width: 234 },
      ],
    },
    {
      headerName: "Total",
      children: [
        { headerName: "Puntos", field: "points", width: 80},
      ],
    },
  ],
  defaultColDef: {
    sortable: true,
    resizable: true,
  },
});

props.resource.workouts.forEach((workout) => {
  ag.value.headers.push({
    headerName: workout.name,
    children: [
      {
        headerName: "Puntos",
        field: `workout_${workout.id}_points`,
        width: 80,
      },
      { headerName: "Rank", field: `workout_${workout.id}_rank`, width: 90 },
      {
        headerName: workout.competition_type.name,
        field: `workout_${workout.id}`,
        width: 120,
      },
    ],
  });
});
</script>
    
<template>
  <ag-grid-vue
    style="width: 100%; height: 429px"
    class="ag-theme-alpine"
    :column-defs="ag.headers"
    :row-data="resource.return"
    :default-col-def="ag.defaultColDef"
  />
</template>
  <style>
.ag-header-viewport {
  background-color: #fff;
}
.ag-header-cell-text,
.ag-header-group-text {
  color: rgb(61, 61, 61);
}
.ag-cell {
  color: rgb(54, 54, 54);
}
.ag-root-wrapper {
  border: 1px solid #e2e8f0 !important;
  border-radius: 5px;
}
</style>