<template>
    <div class="intermediate-class-page">
        <!-- Hero Section - Class Specific -->
        <ClassHeroSection 
            main-heading="Intermediate Class"
            sub-heading="Take your badminton skills to the next level with our intermediate class. Build on your fundamentals and learn advanced techniques."
            class-badge="Intermediate"
            class-duration="6 Weeks"
            button-text="Enroll Now"
            button-link="/classes/enroll/intermediate"
            image-src="/images/hero_side_image.png"
        />

        <!-- Section 1: Class Overview -->
        <section class="class-overview">
            <div class="overview-container">
                <div class="overview-text">
                    <span class="section-badge">Class Overview</span>
                    <h2>Take Your Game to the Next Level</h2>
                    <p>
                        Our Intermediate Class is designed for players who have mastered the basics
                        and are ready to refine their techniques. You'll learn advanced footwork,
                        shot variations, and game strategies to outsmart your opponents and play
                        with more confidence.
                    </p>
                    <div class="overview-features">
                        <div class="feature-item">
                            <i class="fa-solid fa-check-circle"></i>
                            <span>Basic skills required</span>
                        </div>
                        <div class="feature-item">
                            <i class="fa-solid fa-check-circle"></i>
                            <span>Advanced techniques</span>
                        </div>
                        <div class="feature-item">
                            <i class="fa-solid fa-check-circle"></i>
                            <span>Match play & strategy</span>
                        </div>
                        <div class="feature-item">
                            <i class="fa-solid fa-check-circle"></i>
                            <span>Small class size (max 6)</span>
                        </div>
                    </div>
                </div>
                <div class="overview-stats">
                    <div class="stat-box">
                        <h3>6</h3>
                        <p>Weeks Program</p>
                    </div>
                    <div class="stat-box">
                        <h3>1hr</h3>
                        <p>Per Session</p>
                    </div>
                    <div class="stat-box">
                        <h3>6</h3>
                        <p>Students Max</p>
                    </div>
                    <div class="stat-box">
                        <h3>₱600</h3>
                        <p>Per Month</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section 2: What You'll Learn -->
        <section class="learn-section">
            <div class="learn-container">
                <div class="learn-header">
                    <span class="section-badge">Curriculum</span>
                    <h2>What You'll Learn</h2>
                    <p>6-week progressive program designed for intermediate players.</p>
                </div>

                <div class="learn-grid">
                    <div v-for="(item, index) in curriculum" :key="index" class="learn-card">
                        <div class="learn-number">{{ String(index + 1).padStart(2, '0') }}</div>
                        <h3>{{ item.title }}</h3>
                        <p>{{ item.description }}</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section 3: Meet Your Coach -->
        <section class="coach-section">
            <div class="coach-container">
                <div class="coach-image">
                    <img src="/images/intermediate_class.jpg" alt="Coach Sarah">
                </div>
                <div class="coach-info">
                    <span class="section-badge">Meet Your Coach</span>
                    <h2>Coach Sarah</h2>

                    <div class="coach-credentials">
                        <span><i class="fa-solid fa-certificate"></i> Certified Coach</span>
                        <span><i class="fa-solid fa-clock"></i> 7+ Years Experience</span>
                        <span><i class="fa-solid fa-trophy"></i> Former Tournament Player</span>
                    </div>
                    <p>
                        Coach Sarah brings years of competitive experience to every session.
                        Her focus on precision, strategy, and mental toughness helps players
                        elevate their game and perform consistently under pressure.
                    </p>
                    <blockquote>
                        "I believe that strategy and precision win games. My goal is to help
                        players develop the tactical awareness they need to outsmart their
                        opponents and play with confidence."
                    </blockquote>
                    <Link href="/classes/enroll" class="enroll-btn secondary">
                        Enroll Now <i class="fa-solid fa-arrow-right"></i>
                    </Link>
                </div>
            </div>
        </section>

        <!-- Section 4: Pricing & Packages -->
        <section class="pricing-section">
            <div class="pricing-bg-overlay"></div>

            <div class="pricing-container">
                <!-- Urgency Banner -->
                <div class="urgency-banner">
                    <i class="fa-solid fa-clock"></i>
                    Only <strong>4 spots</strong> left for this month!
                </div>

                <div class="pricing-header">
                    <span class="section-badge">Pricing</span>
                    <h2>Choose Your Package</h2>
                    <p>Flexible options to fit your schedule and budget.</p>
                </div>

                <div class="pricing-grid">
                    <div v-for="(plan, index) in pricingPlans" :key="index" 
                        class="pricing-card" :class="{ popular: plan.popular }">
                        <div v-if="plan.popular" class="popular-badge">Most Popular</div>
                        <div v-if="plan.save" class="save-badge">Save {{ plan.save }}%</div>
                        <div class="pricing-card-header">
                            <h3>{{ plan.name }}</h3>
                            <span class="pricing-price">₱{{ plan.price }}</span>
                            <p>{{ plan.per }}</p>
                            <span v-if="plan.description" class="price-label">{{ plan.description }}</span>
                        </div>
                        <ul class="pricing-features">
                            <li v-for="(feature, fIndex) in plan.features" :key="fIndex">
                                <i class="fa-solid fa-check"></i> {{ feature }}
                            </li>
                        </ul>
                        <Link :href="plan.link" class="pricing-btn">Choose {{ plan.name }}</Link>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section 5: Student Testimonials (Social Proof) -->
        <section class="testimonials-section">
            <div class="testimonials-container">
                <div class="testimonial-header">
                    <span class="section-badge">Student Stories</span>
                    <h2>What Our Students Say</h2>
                </div>
                <div class="testimonials-grid">
                    <div v-for="(testimonial, index) in testimonials" :key="index" class="testimonial-card">
                        <div class="testimonial-stars">
                            <i v-for="star in 5" :key="star" class="fa-solid fa-star" :class="{ filled: star <= testimonial.rating }"></i>
                        </div>
                        <p>"{{ testimonial.text }}"</p>
                        <div class="student-info">
                            <span class="student-name">— {{ testimonial.name }}</span>
                            <span class="student-result">{{ testimonial.result }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section 6: FAQ (Accordion) -->
        <section class="faq-section">
            <div class="faq-container">
                <div class="faq-header">
                    <span class="section-badge">FAQ</span>
                    <h2>Frequently Asked Questions</h2>
                </div>

                <div class="faq-grid">
                    <div v-for="(faq, index) in faqs" :key="index" class="faq-item" @click="toggleFaq(index)">
                        <div class="faq-header-row">
                            <h3>{{ faq.question }}</h3>
                            <i class="fa-solid" :class="openFaqs.includes(index) ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                        </div>
                        <p v-show="openFaqs.includes(index)">{{ faq.answer }}</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section 7: CTA - Ready to Play -->
        <section class="ready-section">
            <div class="ready-overlay"></div>
            <div class="ready-content">
                <h2>Ready to Level Up Your Game?</h2>
                <p>
                    Join the Intermediate Class today and take your skills<br>
                    to the next level.
                </p>
                <Link href="/classes/enroll/intermediate" class="ready-btn">
                    Enroll Now <i class="fa-solid fa-arrow-right"></i>
                </Link>
            </div>
        </section>

        <!-- Footer -->
        <Footer />
    </div>
</template>

<script setup>
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';
import ClassHeroSection from '@/Components/Home/ClassHeroSection.vue';
import Footer from '@/Components/Home/Footer.vue';

// ── FAQ Accordion State ──
const openFaqs = ref([0]);

const toggleFaq = (index) => {
    const pos = openFaqs.value.indexOf(index);
    if (pos > -1) {
        openFaqs.value.splice(pos, 1);
    } else {
        openFaqs.value.push(index);
    }
};

// ── Curriculum Data ──
const curriculum = [
    {
        title: 'Advanced Footwork',
        description: 'Master efficient movement patterns to cover the court faster and conserve energy during rallies.'
    },
    {
        title: 'Shot Variation',
        description: 'Learn to mix up your shots — smashes, drops, clears, and net play — to keep opponents guessing.'
    },
    {
        title: 'Deceptive Net Play',
        description: 'Develop deceptive net shots and spinning techniques to force weak returns from opponents.'
    },
    {
        title: 'Defensive & Offensive Tactics',
        description: 'Understand when to attack and when to defend — and how to transition between the two.'
    },
    {
        title: 'Match Strategy',
        description: 'Learn to read opponents, exploit weaknesses, and make smart shot decisions under pressure.'
    },
    {
        title: 'Competitive Match Play',
        description: 'Apply your skills in competitive match simulations and prepare for tournament play.'
    }
];

// ── Pricing Plans ──
const pricingPlans = [
    {
        name: 'Drop-in',
        price: '180',
        per: 'per session',
        popular: false,
        save: null,
        description: 'Best for trying out',
        features: ['Pay per session', 'Flexible schedule', 'No commitment', 'Try before you commit'],
        link: '/classes/enroll/intermediate?package=drop-in'
    },
    {
        name: 'Monthly',
        price: '600',
        per: 'per month',
        popular: true,
        save: null,
        description: 'Best value for consistent training',
        features: ['4 sessions included', 'Progress tracking', 'Best value', 'Consistent training'],
        link: '/classes/enroll/intermediate?package=monthly'
    },
    {
        name: 'Quarterly',
        price: '1,620',
        per: 'per quarter',
        popular: false,
        save: '10',
        description: 'Best for long-term commitment',
        features: ['12 sessions included', 'Save 10%', 'Priority booking', 'Certificate upon completion'],
        link: '/classes/enroll/intermediate?package=quarterly'
    }
];

// ── Testimonials Data (Social Proof) ──
const testimonials = [
    {
        name: 'James R.',
        result: '⭐ 5/5',
        rating: 5,
        text: 'Coach Sarah completely transformed my game. I went from being stuck to consistently winning matches in just 6 weeks!'
    },
    {
        name: 'Lisa T.',
        result: '⭐⭐⭐⭐⭐',
        rating: 5,
        text: 'The advanced techniques and match strategies have given me so much confidence on the court. Highly recommend!'
    },
    {
        name: 'Mark P.',
        result: '⭐ 5/5',
        rating: 5,
        text: 'The match simulations and tactical training are incredible. I feel like a completely different player now.'
    }
];

// ── FAQ Data ──
const faqs = [
    {
        question: 'What is the prerequisite for this class?',
        answer: 'Basic knowledge of grip, strokes, and rules is required. Completion of Beginner Class or equivalent experience recommended.'
    },
    {
        question: 'What if I\'m not sure about my level?',
        answer: 'Contact us for a quick skill assessment before enrolling.'
    },
    {
        question: 'Can I join mid-term?',
        answer: 'Yes — subject to availability and coach approval.'
    },
    {
        question: 'Will I get to play matches?',
        answer: 'Yes — match simulations and friendly games are part of the program.'
    },
    {
        question: 'What gear do I need?',
        answer: 'Comfortable clothes, indoor shoes, and a water bottle. Rackets and shuttlecocks are available for rent.'
    },
    {
        question: 'How long is each session?',
        answer: 'Each session is 1 hour long, twice a week.'
    }
];
</script>

<style scoped>
/* ============================================
   CLASS OVERVIEW
   ============================================ */
.class-overview {
    padding: 80px 8%;
    background: #fff;
}

.overview-container {
    max-width: 1400px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 60px;
    align-items: center;
}

.section-badge {
    display: inline-block;
    padding: 6px 20px;
    border-radius: 40px;
    color: #fff;
    background-color: #1f47d8;
    font-size: 13px;
    font-weight: 600;
    letter-spacing: 1px;
    text-transform: uppercase;
}

.overview-text h2 {
    font-size: 42px;
    font-weight: 700;
    color: #111;
    margin-bottom: 16px;
}

.overview-text p {
    font-size: 16px;
    line-height: 1.7;
    color: #666;
    margin-bottom: 24px;
}

.overview-features {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 12px;
}

.feature-item {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 15px;
    color: #333;
}

.feature-item i {
    color: #22c55e;
    font-size: 18px;
}

/* ── Stats with Icons ── */
.overview-stats {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 30px;
}

.stat-box {
    background: #173A8D;
    border-radius: 16px;
    padding: 30px 20px;
    text-align: center;
}

.stat-box i {
    font-size: 24px;
    color: rgba(255, 255, 255, 0.5);
    margin-bottom: 8px;
}

.stat-box h3 {
    font-size: 36px;
    font-weight: 600;
    color: #f5f6f8;
    margin-bottom: 6px;
}

.stat-box p {
    font-size: 16px;
    color: #f5f6f8;
    font-weight: 500;
}

/* ============================================
   WHAT YOU'LL LEARN
   ============================================ */
.learn-section {
    padding: 80px 8%;
    background: #f5f6f8;
}

.learn-container {
    max-width: 1400px;
    margin: 0 auto;
}

.learn-header {
    text-align: center;
    margin-bottom: 50px;
}

.learn-header h2 {
    font-size: 42px;
    font-weight: 800;
    color: #111;
    margin-bottom: 10px;
}

.learn-header p {
    font-size: 18px;
    color: #666;
}

.learn-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 30px;
}

.learn-card {
    background: #fff;
    border-radius: 16px;
    padding: 30px;
    border: 1px solid #e8e8e8;
    transition: all 0.3s ease;
}

.learn-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.06);
}

.learn-number {
    font-size: 32px;
    font-weight: 800;
    color: #173A8D;
    margin-bottom: 12px;
}

.learn-card h3 {
    font-size: 18px;
    font-weight: 700;
    color: #111;
    margin-bottom: 8px;
}

.learn-card p {
    font-size: 15px;
    color: #777;
    line-height: 1.5;
}

/* ============================================
   COACH SECTION
   ============================================ */
.coach-section {
    padding: 80px 8%;
    background: #fff;
}

.coach-container {
    max-width: 1400px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: 1fr 1.5fr;
    gap: 60px;
    align-items: center;
}

.coach-image img {
    width: 100%;
    max-width: 500px;
    height: 500px;
    object-fit: cover;
    border-radius: 20px;
}

.coach-info h2 {
    font-size: 42px;
    font-weight: 800;
    color: #111;
    margin-bottom: 16px;
}

/* ── Coach Quick Facts ── */
.coach-quick-facts {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 16px;
    margin-bottom: 20px;
}

.fact {
    background: #f5f6f8;
    border-radius: 12px;
    padding: 12px 16px;
    text-align: center;
}

.fact-number {
    display: block;
    font-size: 20px;
    font-weight: 700;
    color: #173A8D;
}

.fact-label {
    display: block;
    font-size: 12px;
    color: #666;
}

.coach-credentials {
    display: flex;
    flex-wrap: wrap;
    gap: 16px;
    margin-bottom: 20px;
}

.coach-credentials span {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 14px;
    color: #555;
    background: #f5f6f8;
    padding: 6px 16px;
    border-radius: 40px;
}

.coach-credentials i {
    color: #173A8D;
}

.coach-info p {
    font-size: 16px;
    line-height: 1.7;
    color: #666;
    margin-bottom: 20px;
}

.coach-info blockquote {
    font-size: 18px;
    font-style: italic;
    color: #333;
    border-left: 4px solid #173A8D;
    padding-left: 20px;
    margin-bottom: 30px;
}

.enroll-btn {
    display: inline-flex;
    align-items: center;
    gap: 12px;
    padding: 14px 40px;
    border-radius: 40px;
    background: #173A8D;
    color: #fff;
    text-decoration: none;
    font-size: 16px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.enroll-btn:hover {
    background: #0f2a6b;
    transform: translateY(-3px);
    box-shadow: 0 8px 30px rgba(23, 58, 141, 0.35);
}

.enroll-btn i {
    font-size: 14px;
    transition: transform 0.3s ease;
}

.enroll-btn:hover i {
    transform: translateX(4px);
}

.enroll-btn.secondary {
    background: #173A8D;
    color: #fff;
}

/* ============================================
   PRICING
   ============================================ */
.pricing-section {
    position: relative;
    padding: 80px 8%;
    background: url("/images/pricing_bg.jpg") center center/cover no-repeat;
    overflow: hidden;
}

.pricing-bg-overlay {
    position: absolute;
    inset: 0;
    background: rgba(255, 255, 255, 0.85);
    backdrop-filter: blur(2px);
    -webkit-backdrop-filter: blur(2px);
    z-index: 1;
}

.pricing-container {
    position: relative;
    z-index: 2;
    max-width: 1400px;
    margin: 0 auto;
}

/* ── Urgency Banner ── */
.urgency-banner {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    background: #ef4444;
    color: #fff;
    padding: 12px 24px;
    border-radius: 40px;
    margin-bottom: 30px;
    font-size: 16px;
    font-weight: 500;
    max-width: 400px;
    margin-left: auto;
    margin-right: auto;
}

.urgency-banner i {
    font-size: 18px;
}

.urgency-banner strong {
    font-weight: 700;
}

.pricing-header {
    text-align: center;
    margin-bottom: 50px;
}

.pricing-header h2 {
    font-size: 42px;
    font-weight: 800;
    color: #111;
    margin-bottom: 10px;
}

.pricing-header p {
    font-size: 18px;
    color: #666;
}

.pricing-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 30px;
}

.pricing-card {
    background: #fff;
    border-radius: 20px;
    padding: 40px 30px;
    text-align: center;
    border: 1px solid #e8e8e8;
    transition: all 0.3s ease;
    position: relative;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
}

.pricing-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 12px 40px rgba(0, 0, 0, 0.12);
}

.pricing-card.popular {
    border-color: #173A8D;
    box-shadow: 0 4px 30px rgba(23, 58, 141, 0.15);
}

.popular-badge {
    position: absolute;
    top: -12px;
    left: 50%;
    transform: translateX(-50%);
    background: #173A8D;
    color: #fff;
    padding: 4px 20px;
    border-radius: 40px;
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
}

.save-badge {
    position: absolute;
    top: -12px;
    right: -12px;
    background: #22c55e;
    color: #fff;
    padding: 4px 14px;
    border-radius: 40px;
    font-size: 11px;
    font-weight: 700;
}

.pricing-card-header h3 {
    font-size: 24px;
    font-weight: 700;
    color: #111;
    margin-bottom: 10px;
}

.pricing-price {
    font-size: 48px;
    font-weight: 500;
    color: #173A8D;
}

.pricing-card-header p {
    font-size: 14px;
    color: #888;
}

.price-label {
    display: block;
    font-size: 12px;
    color: #666;
    margin-top: 6px;
    background: #f5f6f8;
    padding: 4px 14px;
    border-radius: 12px;
    display: inline-block;
}

.pricing-features {
    list-style: none;
    padding: 0;
    margin: 30px 0;
}

.pricing-features li {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    padding: 10px 0;
    font-size: 15px;
    color: #555;
    border-bottom: 1px solid #f0f0f0;
}

.pricing-features li:last-child {
    border-bottom: none;
}

.pricing-features i {
    color: #22c55e;
}

.pricing-btn {
    display: inline-block;
    padding: 12px 40px;
    border-radius: 40px;
    background: #173A8D;
    color: #fff;
    text-decoration: none;
    font-size: 15px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.pricing-btn:hover {
    background: #0f2a6b;
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(23, 58, 141, 0.3);
}

/* ============================================
   TESTIMONIALS (Social Proof)
   ============================================ */
.testimonials-section {
    padding: 80px 8%;
    background: #f5f6f8;
}

.testimonials-container {
    max-width: 1400px;
    margin: 0 auto;
}

.testimonial-header {
    text-align: center;
    margin-bottom: 50px;
}

.testimonial-header h2 {
    font-size: 42px;
    font-weight: 800;
    color: #111;
}

.testimonials-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 30px;
}

.testimonial-card {
    background: #fff;
    border-radius: 16px;
    padding: 30px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
    transition: all 0.3s ease;
}

.testimonial-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
}

.testimonial-stars {
    margin-bottom: 12px;
}

.testimonial-stars i {
    color: #d1d5db;
    font-size: 16px;
}

.testimonial-stars i.filled {
    color: #f59e0b;
}

.testimonial-card p {
    font-size: 16px;
    line-height: 1.6;
    color: #555;
    font-style: italic;
    margin-bottom: 16px;
}

.student-info {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: 12px;
    border-top: 1px solid #e8eaed;
}

.student-name {
    font-weight: 600;
    color: #111;
}

.student-result {
    font-size: 14px;
    color: #173A8D;
    font-weight: 600;
}

/* ============================================
   FAQ (Accordion)
   ============================================ */
.faq-section {
    padding: 80px 8%;
    background: #fff;
}

.faq-container {
    max-width: 1400px;
    margin: 0 auto;
}

.faq-header {
    text-align: center;
    margin-bottom: 50px;
}

.faq-header h2 {
    font-size: 42px;
    font-weight: 800;
    color: #111;
}

.faq-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
}

.faq-item {
    background: #f5f6f8;
    border-radius: 16px;
    padding: 20px 24px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.faq-item:hover {
    background: #e8eaed;
}

.faq-header-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.faq-header-row h3 {
    font-size: 17px;
    font-weight: 600;
    color: #111;
    margin: 0;
}

.faq-header-row i {
    color: #173A8D;
    font-size: 14px;
    transition: transform 0.3s ease;
    flex-shrink: 0;
    margin-left: 12px;
}

.faq-item p {
    font-size: 15px;
    color: #666;
    line-height: 1.5;
    margin: 12px 0 0 0;
}

/* ============================================
   CTA - READY TO PLAY
   ============================================ */
.ready-section {
    position: relative;
    width: 100%;
    height: 500px;
    background: url("/images/ready_to_play.jpg") center center/cover no-repeat;
    display: flex;
    align-items: center;
    overflow: hidden;
}

.ready-overlay {
    position: absolute;
    inset: 0;
    background: rgba(0, 0, 0, 0.45);
}

.ready-content {
    position: relative;
    z-index: 2;
    max-width: 550px;
    margin-left: 9%;
    color: #fff;
}

.ready-content h2 {
    font-size: 60px;
    font-weight: 600;
    line-height: 1.05;
    margin-bottom: 28px;
}

.ready-content p {
    font-size: 16px;
    line-height: 1.5;
    color: rgba(255, 255, 255, 0.92);
    margin-bottom: 30px;
}

.ready-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
    padding: 15px 42px;
    border-radius: 999px;
    background: #fff;
    color: #111;
    text-decoration: none;
    font-size: 16px;
    font-weight: 700;
    transition: all 0.3s ease;
}

.ready-btn:hover {
    background: #173A8D;
    color: #fff;
    transform: translateY(-3px);
    box-shadow: 0 15px 35px rgba(23, 58, 141, 0.35);
}

.ready-btn i {
    font-size: 14px;
    transition: transform 0.3s ease;
}

.ready-btn:hover i {
    transform: translateX(4px);
}

/* ============================================
   DARK MODE STYLES
   ============================================ */
:global(.dark) .class-overview {
    background: #0a1628;
}

:global(.dark) .overview-text h2 {
    color: #ffffff;
}

:global(.dark) .overview-text p {
    color: #9ca3af;
}

:global(.dark) .feature-item {
    color: #d1d5db;
}

:global(.dark) .stat-box {
    background: #1a2a4a;
}

:global(.dark) .stat-box h3 {
    color: #ffffff;
}

:global(.dark) .stat-box p {
    color: #9ca3af;
}

:global(.dark) .stat-box i {
    color: rgba(255, 255, 255, 0.3);
}

:global(.dark) .learn-section {
    background: #0a1628;
}

:global(.dark) .learn-header h2 {
    color: #ffffff;
}

:global(.dark) .learn-header p {
    color: #9ca3af;
}

:global(.dark) .learn-card {
    background: #1a2a4a;
    border-color: #2a3a5a;
}

:global(.dark) .learn-card:hover {
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.3);
}

:global(.dark) .learn-number {
    color: #4a7a9c;
}

:global(.dark) .learn-card h3 {
    color: #ffffff;
}

:global(.dark) .learn-card p {
    color: #9ca3af;
}

:global(.dark) .coach-section {
    background: #0a1628;
}

:global(.dark) .coach-info h2 {
    color: #ffffff;
}

:global(.dark) .coach-quick-facts .fact {
    background: #1a2a4a;
}

:global(.dark) .fact-number {
    color: #4a7a9c;
}

:global(.dark) .fact-label {
    color: #9ca3af;
}

:global(.dark) .coach-credentials span {
    background: #1a2a4a;
    color: #9ca3af;
}

:global(.dark) .coach-credentials i {
    color: #4a7a9c;
}

:global(.dark) .coach-info p {
    color: #9ca3af;
}

:global(.dark) .coach-info blockquote {
    color: #d1d5db;
    border-left-color: #1f47d8;
}

:global(.dark) .enroll-btn {
    background: #1f47d8;
}

:global(.dark) .enroll-btn:hover {
    background: #2a5ae8;
    box-shadow: 0 8px 30px rgba(31, 71, 216, 0.4);
}

:global(.dark) .pricing-bg-overlay {
    background: rgba(10, 22, 40, 0.85);
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
}

:global(.dark) .pricing-header h2 {
    color: #ffffff;
}

:global(.dark) .pricing-header p {
    color: #9ca3af;
}

:global(.dark) .urgency-banner {
    background: #7f1d1d;
}

:global(.dark) .pricing-card {
    background: #1a2a4a;
    border-color: #2a3a5a;
}

:global(.dark) .pricing-card:hover {
    box-shadow: 0 12px 40px rgba(0, 0, 0, 0.4);
}

:global(.dark) .pricing-card.popular {
    border-color: #1f47d8;
    box-shadow: 0 4px 30px rgba(31, 71, 216, 0.2);
}

:global(.dark) .popular-badge {
    background: #1f47d8;
}

:global(.dark) .save-badge {
    background: #065f46;
}

:global(.dark) .pricing-card-header h3 {
    color: #ffffff;
}

:global(.dark) .pricing-price {
    color: #4a7a9c;
}

:global(.dark) .pricing-card-header p {
    color: #6b7280;
}

:global(.dark) .price-label {
    background: #0a1628;
    color: #9ca3af;
}

:global(.dark) .pricing-features li {
    color: #9ca3af;
    border-color: #2a3a5a;
}

:global(.dark) .pricing-features i {
    color: #34d399;
}

:global(.dark) .pricing-btn {
    background: #1f47d8;
}

:global(.dark) .pricing-btn:hover {
    background: #2a5ae8;
    box-shadow: 0 8px 25px rgba(31, 71, 216, 0.4);
}

:global(.dark) .testimonials-section {
    background: #0a1628;
}

:global(.dark) .testimonial-header h2 {
    color: #ffffff;
}

:global(.dark) .testimonial-card {
    background: #1a2a4a;
}

:global(.dark) .testimonial-card:hover {
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.3);
}

:global(.dark) .testimonial-card p {
    color: #9ca3af;
}

:global(.dark) .student-name {
    color: #ffffff;
}

:global(.dark) .student-result {
    color: #4a7a9c;
}

:global(.dark) .testimonial-stars i {
    color: #4b5563;
}

:global(.dark) .testimonial-stars i.filled {
    color: #fbbf24;
}

:global(.dark) .student-info {
    border-color: #2a3a5a;
}

:global(.dark) .faq-section {
    background: #0a1628;
}

:global(.dark) .faq-header h2 {
    color: #ffffff;
}

:global(.dark) .faq-item {
    background: #1a2a4a;
}

:global(.dark) .faq-item:hover {
    background: #2a3a5a;
}

:global(.dark) .faq-header-row h3 {
    color: #ffffff;
}

:global(.dark) .faq-header-row i {
    color: #4a7a9c;
}

:global(.dark) .faq-item p {
    color: #9ca3af;
}

:global(.dark) .ready-overlay {
    background: rgba(0, 0, 0, 0.7);
}

:global(.dark) .ready-content h2 {
    color: #ffffff;
}

:global(.dark) .ready-content p {
    color: #d1d5db;
}

:global(.dark) .ready-btn {
    background: #1f47d8;
    color: #ffffff;
}

:global(.dark) .ready-btn:hover {
    background: #2a5ae8;
    box-shadow: 0 15px 35px rgba(31, 71, 216, 0.4);
}

/* ============================================
   RESPONSIVE
   ============================================ */
@media (max-width: 1200px) {
    .pricing-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 992px) {
    .overview-container {
        grid-template-columns: 1fr;
        gap: 40px;
    }

    .overview-features {
        grid-template-columns: 1fr 1fr;
    }

    .coach-container {
        grid-template-columns: 1fr;
        text-align: center;
    }

    .coach-credentials {
        justify-content: center;
    }

    .coach-quick-facts {
        justify-content: center;
    }

    .coach-image img {
        max-width: 100%;
        height: 350px;
    }

    .learn-grid {
        grid-template-columns: repeat(2, 1fr);
    }

    .faq-grid {
        grid-template-columns: 1fr;
    }

    .testimonials-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 768px) {
    .overview-text h2 {
        font-size: 32px;
    }

    .overview-stats {
        grid-template-columns: repeat(2, 1fr);
    }

    .stat-box h3 {
        font-size: 28px;
    }

    .learn-grid {
        grid-template-columns: 1fr;
    }

    .pricing-grid {
        grid-template-columns: 1fr;
        max-width: 400px;
        margin: 0 auto;
    }

    .pricing-card.popular {
        order: -1;
    }

    .testimonials-grid {
        grid-template-columns: 1fr;
        max-width: 400px;
        margin: 0 auto;
    }

    .coach-info h2 {
        font-size: 32px;
    }

    .learn-header h2 {
        font-size: 32px;
    }

    .pricing-header h2 {
        font-size: 32px;
    }

    .faq-header h2 {
        font-size: 32px;
    }

    .testimonial-header h2 {
        font-size: 32px;
    }

    .overview-features {
        grid-template-columns: 1fr;
    }

    .ready-section {
        height: 380px;
        justify-content: center;
        text-align: center;
    }

    .ready-content {
        margin: 0 25px;
        text-align: center;
    }

    .ready-content h2 {
        font-size: 34px;
    }

    .ready-content p {
        font-size: 16px;
        margin-bottom: 30px;
    }

    .ready-btn {
        width: 100%;
        max-width: 280px;
        justify-content: center;
    }

    .urgency-banner {
        font-size: 14px;
        padding: 10px 20px;
        max-width: 100%;
    }
}

@media (max-width: 480px) {
    .class-overview {
        padding: 60px 5%;
    }

    .learn-section {
        padding: 60px 5%;
    }

    .coach-section {
        padding: 60px 5%;
    }

    .pricing-section {
        padding: 60px 5%;
    }

    .faq-section {
        padding: 60px 5%;
    }

    .testimonials-section {
        padding: 60px 5%;
    }

    .overview-text h2 {
        font-size: 26px;
    }

    .stat-box h3 {
        font-size: 24px;
    }

    .coach-image img {
        height: 250px;
    }

    .coach-quick-facts {
        grid-template-columns: 1fr;
    }

    .pricing-card {
        padding: 30px 20px;
    }

    .pricing-price {
        font-size: 36px;
    }

    .faq-item {
        padding: 16px 20px;
    }

    .faq-header-row h3 {
        font-size: 15px;
    }

    .testimonial-card {
        padding: 20px;
    }

    .ready-section {
        height: 320px;
    }

    .ready-content h2 {
        font-size: 28px;
    }

    .ready-content p {
        font-size: 15px;
    }

    .ready-btn {
        padding: 12px 30px;
        font-size: 14px;
        max-width: 220px;
    }
}
</style>