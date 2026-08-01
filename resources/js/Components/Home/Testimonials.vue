<template>
    <section class="testimonials">
        <div class="testimonial-header">
            <span>Testimonials</span>
            <h2>What Our Players Say</h2>
        </div>

        <div class="testimonial-wrapper">
            <button class="testimonial-prev" @click="swiper?.slidePrev()">
                <i class="fa-solid fa-chevron-left"></i>
            </button>

            <div class="swiper testimonialSwiper" ref="swiperContainer">
                <div class="swiper-wrapper">
                    <!-- Slide 1 -->
                    <div class="swiper-slide">
                        <div class="testimonial-card">
                            <div class="quote">
                                <i class="fa-solid fa-quote-left"></i>
                            </div>
                            <p>
                                The courts are world-class and the community
                                is incredible. I've improved so much since
                                joining Smash Lab. The coaches really care
                                about your progress and the booking system
                                makes everything so convenient.
                            </p>
                            <div class="author">
                                <div class="avatar"></div>
                                <div>
                                    <h4>John Doe</h4>
                                    <span>Active Member — 2 Years</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Slide 2 -->
                    <div class="swiper-slide">
                        <div class="testimonial-card">
                            <div class="quote">
                                <i class="fa-solid fa-quote-left"></i>
                            </div>
                            <p>
                                Booking is so easy now. I play twice a week
                                without any hassle. The dashboard tells me
                                exactly which courts are free. No more calling
                                the front desk or guessing.
                            </p>
                            <div class="author">
                                <div class="avatar"></div>
                                <div>
                                    <h4>Carlo Villanueva</h4>
                                    <span>Class Student — 1 Year</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Slide 3 -->
                    <div class="swiper-slide">
                        <div class="testimonial-card">
                            <div class="quote">
                                <i class="fa-solid fa-quote-left"></i>
                            </div>
                            <p>
                                Coach Sarah transformed my game completely.
                                I went from intermediate to advanced in just
                                three months. Her attention to detail pushed
                                me further than I ever imagined.
                            </p>
                            <div class="author">
                                <div class="avatar"></div>
                                <div>
                                    <h4>Juan Dela Cruz</h4>
                                    <span>Advanced Class — 6 Months</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Slide 4 -->
                    <div class="swiper-slide">
                        <div class="testimonial-card">
                            <div class="quote">
                                <i class="fa-solid fa-quote-left"></i>
                            </div>
                            <p>
                                The booking process is seamless and the
                                facilities are excellent. I highly recommend
                                Smash Lab to anyone looking to improve their
                                badminton skills.
                            </p>
                            <div class="author">
                                <div class="avatar"></div>
                                <div>
                                    <h4>Maria Santos</h4>
                                    <span>Premium Member</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Slide 5 -->
                    <div class="swiper-slide">
                        <div class="testimonial-card">
                            <div class="quote">
                                <i class="fa-solid fa-quote-left"></i>
                            </div>
                            <p>
                                Smash Lab is the best place to train. The
                                coaches are experienced, the courts are
                                top-notch, and the community is very
                                welcoming. Highly recommended!
                            </p>
                            <div class="author">
                                <div class="avatar"></div>
                                <div>
                                    <h4>Mark Rivera</h4>
                                    <span>Competitive Player — 1 Year</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <button class="testimonial-next" @click="swiper?.slideNext()">
                <i class="fa-solid fa-chevron-right"></i>
            </button>
        </div>

        <div class="swiper-pagination"></div>
    </section>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import Swiper from 'swiper';
import 'swiper/css';
import 'swiper/css/pagination';

const swiperContainer = ref(null);
const swiper = ref(null);

onMounted(() => {
    swiper.value = new Swiper(swiperContainer.value, {
        loop: true,
        centeredSlides: true,
        grabCursor: true,
        speed: 800,
        autoplay: {
            delay: 4000,
            disableOnInteraction: false,
            pauseOnMouseEnter: true
        },
        slidesPerView: 1,
        spaceBetween: 0,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
            dynamicBullets: true,
        },
        breakpoints: {
            640: {
                slidesPerView: 1,
                centeredSlides: true,
                spaceBetween: 0,
            },
            768: {
                slidesPerView: 2,
                centeredSlides: true,
                spaceBetween: 0,
            },
            1024: {
                slidesPerView: 3,
                centeredSlides: true,
                spaceBetween: 0,
            }
        }
    });
});
</script>

<style scoped>
.testimonials {
    background: #fff;
    padding: 70px 0 100px;
    overflow: hidden;
}

.testimonial-header {
    text-align: center;
    margin-bottom: 50px;
}

.testimonial-header span {
    display: inline-block;
    padding: 8px 24px;
    border: 1.5px solid #1f47d8;
    border-radius: 40px;
    color: #1f47d8;
    font-size: 14px;
    font-weight: 600;
    letter-spacing: 1px;
    text-transform: uppercase;
    margin-bottom: 16px;
}

.testimonial-header h2 {
    font-size: 58px;
    font-weight: 800;
    margin-top: 10px;
    color: #111;
}

.testimonial-wrapper {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0;
    width: 100%;
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 70px;
    position: relative;
}

.testimonialSwiper {
    width: 100%;
    overflow: hidden !important;
    padding: 30px 0;
}

.testimonialSwiper .swiper-wrapper {
    align-items: center;
}

.testimonialSwiper .swiper-slide {
    width: 33.333333% !important;
    flex-shrink: 0;
    transition: all 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    opacity: 0.35;
    transform: scale(0.82);
    padding: 0 12px;
}

.testimonialSwiper .swiper-slide-active {
    transform: scale(1);
    opacity: 1;
    z-index: 10;
}

.testimonialSwiper .swiper-slide-active .testimonial-card {
    background: #173A8D;
    color: #fff;
    box-shadow: 0 25px 55px rgba(0, 0, 0, 0.2);
}

.testimonialSwiper .swiper-slide-active .author span {
    color: rgba(255, 255, 255, 0.85);
}

.testimonialSwiper .swiper-slide-active .quote {
    color: #fff;
}

.testimonialSwiper .swiper-slide-active .avatar {
    background: linear-gradient(135deg, #ffffff, #a0b4d8);
}

.testimonialSwiper .swiper-slide-prev,
.testimonialSwiper .swiper-slide-next {
    opacity: 0.55;
    transform: scale(0.88);
}

.testimonialSwiper .swiper-slide-prev:not(.swiper-slide-active):not(.swiper-slide-next),
.testimonialSwiper .swiper-slide-next:not(.swiper-slide-active):not(.swiper-slide-prev) {
    opacity: 0.2;
    transform: scale(0.76);
}

.testimonial-card {
    background: #b8b8b8;
    border-radius: 22px;
    padding: 40px;
    min-height: 340px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    transition: all 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    height: 100%;
}

.quote {
    font-size: 44px;
    margin-bottom: 16px;
    opacity: 0.9;
    color: #173A8D;
}

.testimonial-card p {
    font-size: 18px;
    line-height: 1.7;
    margin-bottom: 24px;
    flex: 1;
}

.author {
    display: flex;
    align-items: center;
    gap: 16px;
}

.avatar {
    width: 52px;
    height: 52px;
    border-radius: 50%;
    background: linear-gradient(135deg, #a6a6a6, #7f7f7f);
    flex-shrink: 0;
}

.author h4 {
    font-size: 18px;
    font-weight: 700;
    margin-bottom: 2px;
}

.author span {
    font-size: 14px;
    opacity: 0.7;
}

.testimonial-prev,
.testimonial-next {
    width: 56px;
    height: 56px;
    border: none;
    border-radius: 50%;
    background: #fff;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
    cursor: pointer;
    transition: all 0.3s ease;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 10;
    position: relative;
}

.testimonial-prev { margin-right: 10px; }
.testimonial-next { margin-left: 10px; }

.testimonial-prev:hover,
.testimonial-next:hover {
    transform: scale(1.08);
    box-shadow: 0 8px 30px rgba(23, 58, 141, 0.25);
}

.testimonial-prev i,
.testimonial-next i {
    font-size: 20px;
    color: #173A8D;
}

.swiper-pagination {
    position: relative !important;
    margin-top: 30px;
}

:deep(.swiper-pagination-bullet) {
    width: 12px;
    height: 12px;
    background: #d6d6d6;
    opacity: 1;
    transition: all 0.3s ease;
}

:deep(.swiper-pagination-bullet-active) {
    background: #173A8D;
    transform: scale(1.2);
    box-shadow: 0 0 12px rgba(23, 58, 141, 0.3);
}

/* Dark Mode */
:global(.dark) .testimonials {
    background: #0a1628;
}

:global(.dark) .testimonial-header span {
    border-color: #1f47d8;
    color: #4a7a9c;
}

:global(.dark) .testimonial-header h2 {
    color: #ffffff;
}

:global(.dark) .testimonial-card {
    background: #1a2a4a;
    color: #d1d5db;
}

:global(.dark) .testimonialSwiper .swiper-slide-active .testimonial-card {
    background: #1f47d8;
    color: #ffffff;
}

:global(.dark) .testimonialSwiper .swiper-slide-active .author span {
    color: rgba(255, 255, 255, 0.85);
}

:global(.dark) .testimonialSwiper .swiper-slide-active .quote {
    color: #ffffff;
}

:global(.dark) .testimonialSwiper .swiper-slide-active .avatar {
    background: linear-gradient(135deg, #ffffff, #a0b4d8);
}

:global(.dark) .quote {
    color: #4a7a9c;
}

:global(.dark) .author h4 {
    color: #ffffff;
}

:global(.dark) .author span {
    color: #9ca3af;
}

:global(.dark) .avatar {
    background: linear-gradient(135deg, #2a3a5a, #1a2a4a);
}

:global(.dark) .testimonial-prev,
:global(.dark) .testimonial-next {
    background: #1a2a4a;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
}

:global(.dark) .testimonial-prev i,
:global(.dark) .testimonial-next i {
    color: #4a7a9c;
}

:global(.dark) .testimonial-prev:hover,
:global(.dark) .testimonial-next:hover {
    box-shadow: 0 8px 30px rgba(31, 71, 216, 0.3);
}

:global(.dark) :deep(.swiper-pagination-bullet) {
    background: #2a3a5a;
}

:global(.dark) :deep(.swiper-pagination-bullet-active) {
    background: #1f47d8;
}

@media (max-width: 1200px) {
    .testimonial-header h2 { font-size: 44px; }
    .testimonial-wrapper { padding: 0 50px; }
    .testimonialSwiper .swiper-slide { padding: 0 10px; }
    .testimonial-card { padding: 32px; min-height: 300px; }
    .testimonial-card p { font-size: 16px; }
    .testimonial-prev, .testimonial-next { width: 48px; height: 48px; }
    .testimonial-prev i, .testimonial-next i { font-size: 18px; }
}

@media (max-width: 1024px) {
    .testimonialSwiper .swiper-slide { width: 50% !important; }
    .testimonialSwiper .swiper-slide-active { transform: scale(1); }
    .testimonialSwiper .swiper-slide-prev,
    .testimonialSwiper .swiper-slide-next { transform: scale(0.92); }
    .testimonial-wrapper { padding: 0 40px; }
    .testimonial-card { padding: 28px; min-height: 280px; }
    .testimonial-card p { font-size: 15px; }
}

@media (max-width: 768px) {
    .testimonial-prev, .testimonial-next { display: none !important; }
    .testimonialSwiper { padding: 20px 0; }
    .testimonialSwiper .swiper-slide {
        width: 100% !important;
        transform: scale(1) !important;
        opacity: 1 !important;
        padding: 0 4px;
    }
    .testimonialSwiper .swiper-slide-active .testimonial-card {
        background: #173A8D;
        color: #fff;
    }
    .testimonialSwiper .swiper-slide-prev,
    .testimonialSwiper .swiper-slide-next {
        opacity: 1 !important;
        transform: scale(1) !important;
    }
    .testimonial-card { padding: 24px; }
    .testimonial-card p { font-size: 15px; margin-bottom: 16px; }
    .quote { font-size: 32px; margin-bottom: 10px; }
    .author h4 { font-size: 16px; }
    .author span { font-size: 13px; }
    .avatar { width: 44px; height: 44px; }
    .testimonial-wrapper { padding: 0 20px; }
}

@media (max-width: 480px) {
    .testimonials { padding: 40px 0 60px; }
    .testimonial-header h2 { font-size: 28px; }
    .testimonial-header span { font-size: 14px; }
    .testimonial-wrapper { padding: 0 12px; }
    .testimonial-card { padding: 20px; border-radius: 16px; }
    .testimonial-card p { font-size: 14px; }
    .quote { font-size: 28px; }
    .author h4 { font-size: 14px; }
    .author span { font-size: 12px; }
    .avatar { width: 38px; height: 38px; }
}
</style>