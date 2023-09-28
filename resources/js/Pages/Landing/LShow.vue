<script setup>
import LBagTitle from "./utils/LBagTitle.vue";
import LSliderPartners from "./LSliderPartners.vue";
import AppFooter from "../../Layouts/AppFooter.vue";
import AppHeader from "../../Layouts/AppHeader.vue";
import LCompetencies from "./LCompetencies.vue";
import LLessons from "./LLessons.vue";
import LHero from "./LHero.vue";
import LVideo from "./LVideo.vue";
</script>
<template>
    <section>
        <div class="bg-[#ebedef]">
            <AppHeader />
            <LHero />
        </div>
    </section>
    <section class="bg-[#ebedef]">
        <div class="relative pb-8">
            <div class="pt-8 pb-4">
                <LBagTitle id="Competencias" title="Competencias" />
            </div>
            <LCompetencies />
        </div>
        <div class="relative bg-zinc-900 py-16">
            <div class="text-white uppercase text-center mb-8">
                <h1 class="font-bold lg:text-3xl text-2xl">Live Stream</h1>
            </div>
            <LVideo />
        </div>
    </section>
    <section
        class="max-w-[1250px] m-auto l-max-w 2xl:px-0 px-16 max-[375px]:px-10 flex justify-center py-12"
    >
        <LSliderPartners />
    </section>
    <section>
        <AppFooter />
    </section>
</template>
