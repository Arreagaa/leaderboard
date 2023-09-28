<script setup>
    const props = defineProps({  
        user: {
            type: Object,
            default: () => ({}),
        },
    })
    </script>
        
<template>
  <div class="shadow">
    <div class="max-w-app">
      Información del usuario
    </div>
  </div>
  <div class="max-w-app">
    <div class="l-card lg:w-1/2 w-full text-lg">
      <span>Usuario: participa a clase</span>
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
        <div
          v-if="user.approved"
          class="mb-4 shadow border border-gray-200 rounded-md p-4"
        >
          <div class="mb-4">
            <span class="text-sm">Clase</span><br> 
            <span class="">{{ user.clase_name }}</span>
          </div>
          <div class="mb-4">
            <span class="text-sm">Equipo</span><br> 
            <span class="">{{ user.clase_team_name }}</span>
          </div>
          <div class="mb-4">
            <div>
              <span class="text-sm">Horario</span> <br> 
              <span>{{ user.clase_schedule }}</span>
            </div>
          </div>
          <div class="">
            <span class="text-sm">Fecha</span><br> 
            <span class="">{{ user.clase_date }}</span>
          </div>
        </div>
        <div
          v-if="!user.approved"
          class="mb-4 p-4 text-center"
        >
          <span class="text-red-500 font-semibold">Error, este usuario no fue verificado</span>
        </div>
        <div class="mb-4">
          <div class="mb-4">
            <span class="text-sm">Nombre de contacto de emergencia</span><br> 
            <span class="">{{ user.name_contact_emergency }}</span>
          </div>
          <div>
            <div>
              <span class="text-sm">Número de contacto de emergencia</span> <br> 
              <span>{{ user.phone_contact_emergency }}</span>
            </div>
          </div>
        </div>
        <div class="mb-4">
          <div class="mb-4">
            <span class="text-sm">Sexo</span><br> 
            <span class="">{{ user.sex }}</span>
          </div>
          <div>
            <div>
              <span class="text-sm">Fecha de nacimiento</span> <br> 
              <span>{{ user.date_of_birth }}</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>