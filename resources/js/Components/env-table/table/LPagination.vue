<script setup>
const props = defineProps({
    config: {
        type: Object,
        default: () => {},
    },
});
</script>

<template>
  <!-- This example requires Tailwind CSS v2.0+ -->
  <div class="bg-white py-2 flex items-center justify-between">
    <div class="flex-1 flex justify-between sm:hidden">
      <a
        :href="config.last_page_url"
        class="cursor-pointer relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"
      > Previous </a>
      <a
        :href="config.next_page_url"
        class="cursor-pointer ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"
      > Next </a>
    </div>
    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
      <div>
        <p class="text-sm text-gray-700">
          Showing
          <span class="font-medium">1</span>
          to
          <span class="font-medium">{{ config.per_page }}</span>
          of
          <span class="font-medium">{{ config.total }}</span>
          results
        </p>
      </div>
      <div>
        <nav
          class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px"
          aria-label="Pagination"
        >
          <a
            v-for="(item, index) in config.links"
            :key="index"
            :href="item.url"
            :class="`${item.active ? 'z-10 bg-indigo-50 border-indigo-500 text-indigo-600': 'bg-white border-gray-300 text-gray-500 hover:bg-gray-50'}`"
            class="cursor-pointer relative inline-flex items-center px-4 py-2 border text-sm font-medium"
          >
            <span class="">{{ item.label }}</span>
          </a>
        </nav>
      </div>
    </div>
  </div>
</template>