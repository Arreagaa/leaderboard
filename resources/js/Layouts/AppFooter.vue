<script setup>
import { Link } from "@inertiajs/inertia-vue3";
</script>
<template>
    <div class="bg-zinc-900 py-16 GeogrotesqueCyrBold text-[20px]">
        <div
            class="max-w-app px-16 flex sm:flex-nowrap flex-wrap justify-between"
        >
            <div class="w-full">
                <ul class="sm:text-left text-center text-white font-bold">
                    <li><a href="">Nosotros</a></li>
                    <li><a href="">Contáctanos</a></li>
                    <li><a href="">Política de Privacidad</a></li>
                </ul>

                <div class="mt-8 text-white text-2xl">
                    <ul class="flex sm:justify-start justify-center gap-4">
                        <li>
                            <a
                                href="https://www.instagram.com/tecumaninvitational/"
                                target="_blank"
                            >
                                <l-icon icon="fa-brands fa-instagram" />
                            </a>
                        </li>
                        <li>
                            <a
                                href="https://www.youtube.com/channel/UCtz3fmsRUiq0D8PR2W-x8mA"
                                target="_blank"
                            >
                                <l-icon icon="fa-brands fa-youtube" />
                            </a>
                        </li>
                        <li>
                            <a
                                href="mailto:tecumaninvitational@gmail.com"
                                target="_blank"
                            >
                                <l-icon icon="fa-regular fa-envelope" />
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="sm:text-right text-center w-full lg:pt-0 pt-8">
                <Link href="/" class="text-white text-2xl">
                    Tecuman Sports Festival
                </Link>
            </div>
        </div>
    </div>
    <footer class="GeogrotesqueCyrBold bg-zinc-900">
        <div class="w-full text-center px-2">
            <span class="text-white text-base flex items-center justify-center"
                >Powered By &nbsp;
                <a href="https://schoolaid.app/" target="_blank">
                    <img class="h-24" src="/logos/schoolaid_white.png" alt="" />
                </a>
            </span>
        </div>
        <div class="w-full p-10 text-center px-16">
            <span class="text-white text-base"
                >&copy; Tecuman, Sports Festival. All Rights Reserved / Privacy
                Policy / Third Party Privacy Policy
            </span>
        </div>
    </footer>
</template>
