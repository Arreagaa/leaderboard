<script setup>
import LDropdown from "@/Components/LDropdown.vue";
import { Link } from "@inertiajs/inertia-vue3";

defineProps({
    title: {
        type: String,
        required: true,
    },
    items: {
        type: Array,
        default: () => {
            return [];
        },
    },
});
</script>
<template>
    <LDropdown>
        <template #trigger>
            <!-- component, ndropdown button show  -->
            <div>
                <span
                    class="group cursor-pointer rounded-md py-2 GeogrotesqueCyrBold text-[22px] hover:text-zinc-700 flex items-center"
                >
                    <img
                        src="../../../assets/logos/TLogo.png"
                        class="w-[35px] h-[35px] opacity-0 group-hover:opacity-100 transition duration-500"
                    />
                    {{ title }}
                </span>
            </div>
        </template>
        <template #content>
            <!-- component, ndropdown content show  -->
            <div
                class="GeogrotesqueCyrBold text-[18px] px-4 pb-22 pt-4 bg-zinc-900 text-white"
            >
                <ul>
                    <li
                        v-for="(item, index) in items"
                        :key="index"
                        class="mb-2"
                    >
                        <Link class="hover:text-stone-300" :href="item.url">
                            {{ item.title }}
                        </Link>
                    </li>
                </ul>
                <!-- component, ndropdown urls export  -->
            </div>
        </template>
    </LDropdown>
</template>
