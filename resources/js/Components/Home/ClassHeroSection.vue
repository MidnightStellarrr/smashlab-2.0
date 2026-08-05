<template>
    <section class="hero-section">
        <!-- Navbar -->
        <Navbar />

        <div class="hero-overlay"></div>

        <!-- White Diagonal Shape -->
        <div class="hero-shape"></div>

        <div class="hero-container">
            <!-- Left Content -->
            <div class="hero-content">
                <div v-if="classBadge" class="class-badge">
                    <span class="badge-level">{{ classBadge }}</span>
                    <span v-if="classDuration" class="badge-duration">{{ classDuration }}</span>
                </div>

                <h1>{{ mainHeading }}</h1>
                <p>{{ subHeading }}</p>

                <!-- Button -->
                <Link v-if="buttonText" :href="buttonLink" class="hero-btn">
                    {{ buttonText }} <i class="fa-solid fa-arrow-right"></i>
                </Link>
            </div>

            <!-- Right Image -->
            <div class="hero-image">
                <img
                    :src="imageSrc"
                    :alt="imageAlt || 'Badminton Player'"
                >
            </div>
        </div>
    </section>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import Navbar from '@/Components/Home/Navbar.vue';

defineProps({
    mainHeading: {
        type: String,
        default: 'Class Title'
    },
    subHeading: {
        type: String,
        default: 'Class description goes here.'
    },
    classBadge: {
        type: String,
        default: ''
    },
    classDuration: {
        type: String,
        default: ''
    },
    buttonText: {
        type: String,
        default: 'Enroll Now'
    },
    buttonLink: {
        type: String,
        default: '/classes/enroll'
    },
    imageSrc: {
        type: String,
        default: '/images/hero_side_image.png'
    },
    imageAlt: {
        type: String,
        default: 'Badminton Player'
    }
});
</script>

<style scoped>
/* ============================================
   HERO SECTION
   ============================================ */
.hero-section {
    position: relative;
    width: 100%;
    height: 590px;
    overflow: hidden;
    background: linear-gradient(
        90deg,
        #0c244b 0%,
        #07114b 45%,
        #095fb8 100%
    );
}

/* ── Blue Overlay ── */
.hero-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(
        90deg,
        rgba(10, 28, 70, 0.25),
        rgba(5, 15, 70, 0.18)
    );
    z-index: 1;
}

/* ── White Diagonal Shape ── */
.hero-shape {
    position: absolute;
    right: -180px;
    bottom: -20px;
    width: 832px;
    height: 227px;
    background: #fff;
    transform: rotate(150deg);
    z-index: 2;
}

/* ── Container ── */
.hero-container {
    position: relative;
    z-index: 3;
    max-width: 1450px;
    height: 100%;
    margin: auto;
    padding: 0 8%;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

/* ── Content ── */
.hero-content {
    max-width: 560px;
    color: #fff;
    margin-top: 40px;
}

.hero-content h1 {
    font-size: 64px;
    font-weight: 700;
    line-height: 1.05;
    margin-bottom: 20px;
}

.hero-content p {
    font-size: 16px;
    line-height: 1.5;
    color: rgba(255, 255, 255, 0.92);
}

/* ── Class Badge ── */
.class-badge {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-top: 20px;
    margin-bottom: 15px;
}

.badge-level {
    display: inline-block;
    padding: 6px 20px;
    border-radius: 40px;
    font-size: 13px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    background: #fff;
    color: #173A8D;
}

.badge-level.beginner {
    background: #dcfce7;
    color: #16a34a;
}

.badge-level.intermediate {
    background: #fef3c7;
    color: #d97706;
}

.badge-level.advanced {
    background: #fef2f2;
    color: #dc2626;
}

.badge-duration {
    display: inline-block;
    padding: 6px 20px;
    border-radius: 40px;
    font-size: 13px;
    font-weight: 500;
    background: rgba(255, 255, 255, 0.15);
    color: #fff;
    backdrop-filter: blur(4px);
}

/* ── Image ── */
.hero-image {
    flex: 1;
    display: flex;
    justify-content: flex-end;
    align-items: flex-end;
    height: 100%;
}

.hero-image img {
    height: 550px;
    width: 620px;
    max-width: 100%;
    object-fit: contain;
    position: relative;
    bottom: -15px;
    z-index: 5;
}

/* ── Hero Button ── */
.hero-btn {
    display: inline-flex;
    align-items: center;
    gap: 12px;
    padding: 14px 40px;
    margin-top: 30px;
    border-radius: 40px;
    background: #fff;
    color: #173A8D;
    text-decoration: none;
    font-size: 16px;
    font-weight: 600;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
}

.hero-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 30px rgba(255, 255, 255, 0.25);
}

.hero-btn i {
    font-size: 14px;
    transition: transform 0.3s ease;
}

.hero-btn:hover i {
    transform: translateX(4px);
}

/* ============================================
   DARK MODE
   ============================================ */
:global(.dark) .hero-section {
    background: linear-gradient(
        90deg,
        #050814 0%,
        #0a1628 45%,
        #1a2a4a 100%
    );
}

:global(.dark) .hero-shape {
    background: #111827;
}

:global(.dark) .hero-btn {
    background: #1f47d8;
    color: #ffffff;
}

:global(.dark) .hero-btn:hover {
    background: #2a5ae8;
    box-shadow: 0 8px 30px rgba(31, 71, 216, 0.4);
}

:global(.dark) .badge-level {
    background: #1a2a4a;
    color: #4a7a9c;
}

:global(.dark) .badge-level.beginner {
    background: #065f46;
    color: #34d399;
}

:global(.dark) .badge-level.intermediate {
    background: #78350f;
    color: #fbbf24;
}

:global(.dark) .badge-level.advanced {
    background: #7f1d1d;
    color: #f87171;
}

:global(.dark) .badge-duration {
    background: rgba(255, 255, 255, 0.08);
}

/* ============================================
   RESPONSIVE
   ============================================ */
@media (max-width: 1200px) {
    .hero-section {
        height: 540px;
    }

    .hero-content h1 {
        font-size: 64px;
    }

    .hero-content p {
        font-size: 20px;
    }

    .hero-image img {
        width: 480px;
    }
}

@media (max-width: 900px) {
    .hero-section {
        height: auto;
        padding: 80px 0 40px;
    }

    .hero-shape {
        display: none;
    }

    .hero-container {
        flex-direction: column;
        justify-content: center;
        text-align: center;
        gap: 40px;
    }

    .hero-content {
        max-width: 100%;
        margin-top: 0;
    }

    .hero-content h1 {
        font-size: 52px;
    }

    .hero-content p {
        font-size: 18px;
    }

    .hero-image {
        justify-content: center;
    }

    .hero-image img {
        width: 360px;
        bottom: 0;
    }

    .class-badge {
        justify-content: center;
    }

    .hero-btn {
        padding: 12px 32px;
        font-size: 15px;
    }

    .hero-content {
        display: flex;
        flex-direction: column;
        align-items: center;
    }
}

@media (max-width: 480px) {
    .hero-section {
        padding: 60px 0 30px;
    }

    .hero-content h1 {
        font-size: 36px;
    }

    .hero-content p {
        font-size: 16px;
    }

    .hero-image img {
        width: 280px;
    }

    .hero-btn {
        padding: 10px 28px;
        font-size: 14px;
    }

    .class-badge {
        flex-wrap: wrap;
        justify-content: center;
    }

    .badge-level,
    .badge-duration {
        font-size: 11px;
        padding: 4px 14px;
    }
}
</style>