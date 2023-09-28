<script setup>
const props = defineProps({  
    user: {
        type: Object,
        default: () => ({}),
    },
})
</script>
    
<template>
  <div class="shadow ">
    <div class="max-w-app">
      Información del usuario
    </div>
  </div>
  <div class="max-w-app">
    <div class="l-card lg:w-1/2 w-full text-lg">
      <span>Usuario espectador</span>
      <div class="">
        <div class="mb-4">
          <div class="mb-4">
            <span class="text-sm">Nombre</span><br> 
            <span>{{ user.name }} {{ user.lastname }}</span>
          </div>
          <div class="">
            <div class="mb-4">
              <span class="text-sm">Email</span><br> {{ user.email }}
            </div>
            <div class="">
              <span class="text-sm">Número</span><br> {{ user.phone }}
            </div>
            <div class="">
              <span class="text-sm"># Veces escaneadas</span><br> {{ user.count_qr }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>