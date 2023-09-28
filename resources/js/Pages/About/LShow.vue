<script setup>
import AppHeader from '../../Layouts/AppHeader.vue';
import AppFooter from '../../Layouts/AppFooter.vue';
import LBagTitle from '../Landing/utils/LBagTitle.vue';

</script>
<template>
  <AppHeader />
  <div class="max-w-app relative">
    <LBagTitle title="SOBRE NOSOTROS" />
    <div>
      <div class="lg:flex flex-wrap justify-center sm:p-16 p-8">
        <div class="lg:w-1/2 w-full">
          <p class="text-justify">
            <span class="font-semibold">¡Tecuman y Cayalá se unen para presentar la primera edición de Tecuman Sports Festival!</span> <br><br>
            Sé parte de un fin de semana lleno de actividades para toda tu familia y familia perruna, en donde habrán diferentes competencias de Crossfit, Duatlón y Karate; además contará varias clases Yoga y Functional Cycling, así como con un entreno especial de Entrenamiento Funcional y una competencia para el “Fittest Fan” la cual será en parejas.
            <br><br>
            ¡Los esperamos!
          </p>
        </div>
        <div class="lg:w-1/2 w-full lg:pl-8 pl-0 lg:pt-0 pt-8">
          <img
            src="../../../assets/bg-form.jpeg"
            alt=""
          >
        </div>
      </div>
    </div>
  </div>
  <AppFooter />
</template>
