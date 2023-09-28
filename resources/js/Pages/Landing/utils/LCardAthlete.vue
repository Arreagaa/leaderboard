<script setup>
const props = defineProps({
    item: {
        type: Object,
        required: true,
    },
    idItem: {
        type: Number,
        default: 0,
    },
});
</script>
<template>
    <div
        class="bg-white rounded-lg border shadow-md max-w-xs md:max-w-none overflow-hidden"
    >
        <a :href="item.ig" target="_blank">
            <img
                class="img-fluid h-96 w-full object-cover object-top"
                :src="item.image"
                alt=""
            />
            <div class="p-3">
                <span class="text-base text-primary">{{ item.title }}</span>
                <h3 class="font-semibold text-xl leading-6 text-gray-700 my-2">
                    {{ item.name }}
                </h3>
                <input
                    :id="`owner-post-${idItem}`"
                    type="checkbox"
                    class="read-more-state"
                />

                <p class="read-more-wrap text-justify">
                    {{ item.description }}
                    <span class="read-more-target text-justify">
                        {{ item.more }}
                    </span>
                </p>

                <label
                    :for="`owner-post-${idItem}`"
                    class="read-more-trigger font-bold hover:text-zinc-700"
                />
            </div>
        </a>
    </div>
</template>

<style>
.read-more-state {
    display: none;
}

.read-more-target {
    opacity: 0;
    max-height: 0;
    font-size: 0;
    transition: 0.25s ease;
}

.read-more-state:checked ~ .read-more-wrap .read-more-target {
    opacity: 1;
    font-size: inherit;
    max-height: 999em;
}

.read-more-state ~ .read-more-trigger:before {
    content: "Show more";
}

.read-more-state:checked ~ .read-more-trigger:before {
    content: "Show less";
}

.read-more-trigger {
    margin-top: 5px;
    cursor: pointer;
    display: inline-block;
    color: black;
    font-size: 0.9em;
    line-height: 2;
}
</style>
