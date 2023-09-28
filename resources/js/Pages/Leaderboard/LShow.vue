<script setup>
import AppHeader from '../../Layouts/AppHeader.vue';
import AppFooter from '../../Layouts/AppFooter.vue';
import LBagTitle from '../Landing/utils/LBagTitle.vue';
import Leaderboard from '../../Components/leaderboard/Tool.vue';
import { ref } from 'vue';

const props = defineProps({  
  categories: {
    type: Array,
    default: () => ([]),
  }
})

const state = ref({
  category: null,
  load: false,
})

const getCategory = (id) => {
  state.value.load = true;
  axios
  .get(`/data-leaderboard/${id}`)
  .then(({data}) => {
    state.value.category = data.category;
  })
  .catch(() => {
    console.log('Borradin');
  })
  .finally(() => {
    state.value.load = false;
  });
}

if(props.categories.length > 0){
  getCategory(props.categories[0].id)
}

</script>
<template>
  <AppHeader />
  <section class="max-w-app relative">
    <LBagTitle title="LEADEARBOARD" />
    <div class="max-w-app">
      <div
        
        class="w-full"
      >
        <div
          v-if="state.category != null"
          class="flex border md:flex-nowrap flex-wrap border-gray-300 mb-4"
        >
          <div
            v-for="(item, index) in categories"
            :key="index"
            class="px-4 pt-4 pb-2 mx-4 cursor-pointer"
            :class="state.category.id === item.id ? 'border-b-2 border-slate-700' : ''"
            @click="getCategory(item.id)"
          >
            <span class="font-semibold text-gray-500">{{ item.name }}</span>
          </div>
        </div>
        <div
          v-if="state.load"
          class="flex justify-center items-center"
          style="width: 100%; height: 429px"
        >
          <span class="leaderboard-loader" />
        </div>
        <div v-else>
          <Leaderboard
            v-if="state.category"
            :resource="state.category"
          />
          <div v-else class="p-4 text-center">
            <span class="text-2xl font-semibold">Aún no disponible</span>
          </div>
        </div>
      </div>
    </div>
  </section>
  <AppFooter />
</template>
<style>
  .leaderboard-loader {
    position: relative;
    width:  48px;
    height: 48px;
    background: #de3500;
    transform: rotateX(65deg) rotate(45deg);
    color: #fff;
    animation: layers1 1s linear infinite alternate;
  }
  .leaderboard-loader:after {
    content: '';
    position: absolute;
    inset: 0;
    background: rgba(255, 255, 255, 0.7);
    animation: layerTr 1s linear infinite alternate;
  }

  @keyframes layers1 {
    0% { box-shadow: 0px 0px 0 0px  }
   90% , 100% { box-shadow: 20px 20px 0 -4px  }
  }
  @keyframes layerTr {
    0% { transform:  translate(0, 0) scale(1) }
    100% {  transform: translate(-25px, -25px) scale(1) }
  }
      
</style>