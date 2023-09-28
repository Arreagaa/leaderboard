<script setup>
defineProps({
    title: {
        type: String,
        required: true,
    },
});
</script>
<template>
    <div class="w-full flex justify-center top-6 right-0 left-0">
        <div class="p-4 text-black uppercase">
            <h1 class="GeogrotesqueCyrSemiBold lg:text-3xl text-2xl">
                {{ title }}
            </h1>
        </div>
    </div>
</template>
