<template>
  <div
    class="relative"
  >
    <div
      class="cursor-pointer p-4"
      @mouseover="open = true"
      @mouseleave="open = false"
    >
      <slot
        name="trigger"
        :open="open"
      />
    </div>

    <!-- Full Screen Dropdown Overlay -->


    <transition
      enter-active-class="transition ease-out duration-200"
      enter-from-class="transform opacity-0 scale-95"
      enter-to-class="transform opacity-100 scale-100"
      leave-active-class="transition ease-in duration-75"
      leave-from-class="transform opacity-100 scale-100"
      leave-to-class="transform opacity-0 scale-95"
    >
      <div
        v-show="open"
        class="absolute z-50 shadow bg-zinc-900"
        :class="[widthClass, alignmentClasses]"
        style="display: none; width: 13.5rem"
        @mouseover="open = true"
        @mouseleave="open = false"
      >
        <div
          class="ring-1 ring-black ring-opacity-5"
          :class="contentClasses"
        >
          <slot name="content" />
        </div>
      </div>
    </transition>
  </div>
</template>

<script>
export default {
  props: {
    align: {
      type: String,
      default: "right",
    },
    width: {
      type: String,
      default: "48",
    },
    contentClasses: {
      type: Array,
      default: () => [],
    },
  },

  data() {
    return {
      open: false,
    };
  },

  computed: {
    widthClass() {
      return {
        48: "w-48",
      }[this.width.toString()];
    },

    alignmentClasses() {
      if (this.align === "left") {
        return "origin-top-left pin-l";
      } else if (this.align === "right") {
        return "origin-top-right pin-r";
      } else {
        return "origin-top";
      }
    },
  },
};
</script>
