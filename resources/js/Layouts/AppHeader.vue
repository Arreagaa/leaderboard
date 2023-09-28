<script setup>
import LHeaderBUtton from "./utils/LHeaderBUtton.vue";
import { ref, watch } from "vue";
import { Link } from "@inertiajs/inertia-vue3";
const active = ref(false);

watch(active, (newActive) => {
    const body = document.body;

    if (newActive) {
        body.classList.add("overflow-hidden");
        body.classList.remove("overflow-auto");
    } else {
        body.classList.add("overflow-auto");
        body.classList.remove("overflow-hidden");
    }
});

const urls = ref({
    info: [
        { title: "Sobre Nosotros", url: "/about" },
        { title: "Voluntarios", url: "/register/volunteer" },
    ],
    invitational: [
        { title: "¿Quienes somos?", url: "/about" },
        { title: "Atletas", url: "/our-athletes" },
        { title: "Leaderboard", url: "/leaderboard" },
        { title: "WODS", url: "/woods" },
    ],
    activities: [
        { title: "Competencias", url: "/#Competencias" },
        { title: "Clases", url: "/#Clases" },
    ],
    sponsors: [
        { title: "Nuestros patrocinadores", url: "/sponsors" },
        { title: "Conviertete en un patrocinador", url: "/register/sponsor" },
    ],
    calendar: [
        { title: "Ver calendario", url: "/calendar" },
        { title: "Ver mapa", url: "/map" },
    ],
    register: [{ title: "Comienza Ya", url: "/register/user" }],
});
</script>
<template>
    <div class="bg-[#ebedef]">
        <div
            class="justify-center max-w-app px-16 flex sm:flex-nowrap flex-wrap"
        >
            <div class="w-full px-4">
                <div class="text-center mx-auto max-w-[510px]">
                    <Link href="/" class="text-lg text-primary">
                        <img
                            src="../../assets/logos/logoHeader/TECUMANLOGO.png"
                            alt="image"
                            class="logo-img mx-auto"
                        />
                    </Link>
                </div>
            </div>
        </div>
        <header class="max-w-fit m-auto">
            <div class="flex justify-center items-center lg:py-2 sm:py-8">
                <nav
                    class="flex w-full lg:p-12 items-center lg:justify-between justify-center"
                >
                    <ul
                        class="lg:flex hidden flex-col items-center lg:items-start lg:flex-row font-bold text-sm uppercase tracking-tight text-black gap-x-4"
                    >
                        <li>
                            <LHeaderBUtton
                                title="¿QUIÉNES SOMOS?"
                                :items="urls.info"
                            />
                        </li>
                        <li>
                            <LHeaderBUtton
                                title="INVITATIONAL CROSSFIT"
                                :items="urls.invitational"
                            />
                        </li>
                        <li>
                            <LHeaderBUtton
                                title="ACTIVIDADES"
                                :items="urls.activities"
                            />
                        </li>
                        <li>
                            <LHeaderBUtton
                                title="PATROCINADORES"
                                :items="urls.sponsors"
                            />
                        </li>

                        <li>
                            <LHeaderBUtton
                                title="CALENDARIO"
                                :items="urls.calendar"
                            />
                        </li>
                        <li>
                            <LHeaderBUtton
                                title="REGÍSTRATE"
                                :items="urls.register"
                            />
                        </li>
                    </ul>
                    <div class="lg:hidden block pb-4">
                        <a @click="active = !active">
                            <l-icon
                                icon="fa-solid fa-bars"
                                class="text-black text-2xl"
                            />
                        </a>
                    </div>
                </nav>
            </div>
            <div class="flex justify-center lg:hidden lg:pb-0 pb-8">
                <a
                    href="/register/user"
                    class="py-2 text-black uppercase cursor-pointer hover:text-zinc-700 GeogrotesqueCyrBold text-[22px]"
                >
                    REGÍSTRATE
                </a>
            </div>
            <div
                v-if="active"
                class="absolute w-screen h-screen bg-white top-0 left-0"
                style="z-index: 98"
            >
                <div class="w-screen h-screen">
                    <div class="p-8">
                        <a
                            href="/"
                            class="GeogrotesqueCyrBold uppercase text-black text-2xl"
                        >
                            Tecuman Sports Festival
                        </a>
                    </div>
                    <a
                        class="absolute top-8 right-8"
                        style="z-index: 99"
                        @click="active = !active"
                    >
                        <l-icon
                            icon="fa-solid fa-bars"
                            class="text-black text-2xl"
                        />
                    </a>
                    <ul
                        class="font-bold uppercase tracking-tight gap-x-8 text-black gap-y-4 p-8 text-lg"
                    >
                        <li>
                            <LHeaderBUtton
                                title="¿QUIÉNES SOMOS?"
                                :items="urls.info"
                            />
                        </li>
                        <li>
                            <LHeaderBUtton
                                title="INVITATIONAL CROSSFIT"
                                :items="urls.invitational"
                            />
                        </li>
                        <li>
                            <LHeaderBUtton
                                title="ACTIVIDADES"
                                :items="urls.activities"
                            />
                        </li>
                        <li>
                            <LHeaderBUtton
                                title="PATROCINADORES"
                                :items="urls.sponsors"
                            />
                        </li>

                        <li>
                            <LHeaderBUtton
                                title="CALENDARIO"
                                :items="urls.calendar"
                            />
                        </li>
                    </ul>
                </div>
            </div>
        </header>
    </div>
</template>
<style>
@media (max-width: 1200px) {
    .logo-img {
        width: 18rem;
    }
}
</style>
