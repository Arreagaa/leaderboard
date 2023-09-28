<script>
import { Swiper, SwiperSlide } from "swiper/vue";
import "swiper/css";
import "swiper/css/navigation";
import { Navigation, Autoplay } from "swiper";

export default {
    components: {
        Swiper,
        SwiperSlide,
    },
    setup() {
        return {
            modules: [Navigation, Autoplay],
            photos: [
                {
                    img: "/sliders/SLIDER1.png",
                },
                {
                    img: "/sliders/SLIDER2.png",
                },
                {
                    img: "/sliders/SLIDER3.png",
                },
            ],
        };
    },
};
</script>
<template>
    <section>
        <swiper
            :navigation="true"
            :loop="true"
            :autoplay="{
                delay: 2500,
                disableOnInteraction: false,
            }"
            :modules="modules"
            class="mySwiper w-full"
        >
            <swiper-slide
                v-for="(photo, index) in photos"
                :key="index"
                class="h-full w-full flex items-center justify-center"
            >
                <img :src="photo.img" class="object-cover w-full h-full" />
            </swiper-slide>
        </swiper>
    </section>
</template>
<style>
.swiper-button-next,
.swiper-button-prev {
    color: #ebedef;
}
@media (max-width: 640px) {
    .swiper-slide {
        height: 60vh;
    }
}
</style>
