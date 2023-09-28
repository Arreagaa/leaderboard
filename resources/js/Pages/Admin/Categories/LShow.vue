<script setup>
  import { ref, toRef } from 'vue';
  import LWrapper from '@/Components/env-detail/LWrapper.vue';
  import setConfig from './setConfig';
  import LEventRelation from './LEventRelation.vue';
  import LAddResult from './LAddResult.vue';
  import Leaderboard from "../../../Components/leaderboard/Tool.vue";

  const props = defineProps({  
    resource: {
      type: Object,
      default: () => ({}),
    },
    athletes: {
      type: Object,
      default: () => ({}),
    },
  })
  const config = ref(setConfig())

  
  const showAddResult = ref(false)
  
  const fields = ref({
    workouts: {
      name: 'name',
      label: 'Workouts',
      type: 'name',
      required: false,
      placeholder: 'Workouts',
      url: '/only/workouts',
      title: 'Workouts',
      urlBase: `/diradmin/categories/${props.resource.id}/workouts`,
      urlBaseDelete: `categories.workouts.detach`,
    },
    athletes: {
      name: 'full_name',
      label: 'Athlete',
      type: 'full_name',
      required: false,
      placeholder: 'Athletes',
      url: '/only/athletes',
      urlBase: `/diradmin/events/${props.resource.id}/athletes`,
      urlBaseDelete: `events.athletes.detach`,
    }
  })

</script>
  
<template>
  <LWrapper
    :resource="resource"
    :config="config"
  >
    <div
      class="gap-8"
    >
      <LEventRelation
        title="Workouts"
        :event-id="resource.id"
        :field="fields.workouts"
        :resources="resource.workouts"
      />
    </div>

    <div class="pb-8">
      <div class="text-rigth mb-4">
        <button
          class="l-btn-secondary"
          @click="showAddResult = true"
        >
          {{ `Add Result` }}
        </button>
      </div>
      <div class="l-card">
        <Leaderboard :resource="resource" />
      </div>
    </div>
    <LAddResult
      :event-id="resource.id"
      :show="showAddResult"
      @close="showAddResult = false"
      @add="showAddResult = false"
    />
  </LWrapper>
</template>
<style>
  .ag-header-viewport {
    background-color: #fff;
  }
  .ag-header-cell-text, .ag-header-group-text{
    color: rgb(61, 61, 61);
  }
  .ag-cell{
    color: rgb(54, 54, 54);
  }
</style>