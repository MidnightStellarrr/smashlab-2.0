<template>
    <div class="contact-page">
        <!-- Navbar -->
        <Navbar />

        <!-- Hero Section -->
        <Hero 
            main-heading="Contact"
            sub-heading="Have questions? We'd love to hear from you."
            bg-image="/images/hero_bg.jpg"
            height="590px"
            :centered="true"
        />

        <!-- ===========================
                CONTACT SECTION
        ============================ -->

        <section class="contact-section">
            <div class="contact-container">
                <!-- LEFT SIDE - FORM -->
                <div class="contact-form-card">
                    <div class="form-header">
                        <h2>Send Us a Message</h2>
                        <p>We'll get back to you as soon as possible.</p>
                    </div>

                    <form @submit.prevent="submitForm" novalidate>
                        <!-- Full Name -->
                        <div class="form-group" :class="{ 'has-error': validationErrors.fullName }">
                            <label for="fullName">Full Name <span class="required">*</span></label>
                            <input 
                                id="fullName"
                                type="text" 
                                v-model="form.fullName" 
                                placeholder="e.g. Juan Dela Cruz"
                                aria-required="true"
                                aria-describedby="fullNameHelp"
                                :class="{ 'error': validationErrors.fullName }"
                                @blur="validateField('fullName')"
                                required
                            >
                            <small id="fullNameHelp">Enter your full name</small>
                            <span v-if="validationErrors.fullName" class="error-text">
                                <i class="fa-solid fa-exclamation-circle"></i> {{ validationErrors.fullName }}
                            </span>
                        </div>

                        <!-- Email -->
                        <div class="form-group" :class="{ 'has-error': validationErrors.email }">
                            <label for="email">Email Address <span class="required">*</span></label>
                            <input 
                                id="email"
                                type="email" 
                                v-model="form.email" 
                                placeholder="e.g. juan@email.com"
                                aria-required="true"
                                aria-describedby="emailHelp"
                                :class="{ 'error': validationErrors.email }"
                                @blur="validateField('email')"
                                required
                            >
                            <small id="emailHelp">Enter your email address</small>
                            <span v-if="validationErrors.email" class="error-text">
                                <i class="fa-solid fa-exclamation-circle"></i> {{ validationErrors.email }}
                            </span>
                        </div>

                        <!-- Phone -->
                        <div class="form-group" :class="{ 'has-error': validationErrors.phone }">
                            <label for="phone">Phone Number</label>
                            <input 
                                id="phone"
                                type="tel" 
                                v-model="form.phone" 
                                placeholder="e.g. +63 912 345 6789"
                                aria-describedby="phoneHelp"
                                :class="{ 'error': validationErrors.phone }"
                                @blur="validateField('phone')"
                            >
                            <small id="phoneHelp">Enter your phone number (optional)</small>
                            <span v-if="validationErrors.phone" class="error-text">
                                <i class="fa-solid fa-exclamation-circle"></i> {{ validationErrors.phone }}
                            </span>
                        </div>

                        <!-- Message -->
                        <div class="form-group" :class="{ 'has-error': validationErrors.message }">
                            <label for="message">Message <span class="required">*</span></label>
                            <textarea 
                                id="message"
                                v-model="form.message" 
                                placeholder="How can we help you?"
                                aria-required="true"
                                aria-describedby="messageHelp"
                                :class="{ 'error': validationErrors.message }"
                                @blur="validateField('message')"
                                maxlength="500"
                                required
                            ></textarea>
                            <div class="char-count-wrapper">
                                <small id="messageHelp">Enter your message (max 500 characters)</small>
                                <span class="char-count" :class="{ 'char-count-warning': form.message.length > 450 }">
                                    {{ form.message.length }}/500
                                </span>
                            </div>
                            <span v-if="validationErrors.message" class="error-text">
                                <i class="fa-solid fa-exclamation-circle"></i> {{ validationErrors.message }}
                            </span>
                        </div>

                        <button type="submit" class="contact-btn" :disabled="isSubmitting || !isFormValid">
                            <span v-if="isSubmitting">
                                <i class="fa-solid fa-spinner fa-spin"></i> Sending...
                            </span>
                            <span v-else>
                                Send Message <i class="fa-solid fa-arrow-right"></i>
                            </span>
                        </button>

                        <!-- Success Message -->
                        <div v-if="submitSuccess" class="success-message" tabindex="-1" ref="successMessage">
                            <i class="fa-solid fa-check-circle"></i> 
                            Message sent successfully! We'll get back to you soon.
                        </div>

                        <!-- Error Message -->
                        <div v-if="submitError" class="error-message" tabindex="-1" ref="errorMessage">
                            <i class="fa-solid fa-exclamation-circle"></i> 
                            {{ submitError }}
                        </div>
                    </form>
                </div>

                <!-- RIGHT SIDE - INFO -->
                <div class="contact-info">
                    <h2>Let's Talk</h2>

                    <p class="contact-description">
                        Reach out and let us know how we can help you play your best.
                        Our team is ready to assist with bookings, classes, or any
                        questions you may have.
                    </p>

                    <div class="contact-grid">
                        <!-- Phone -->
                        <div class="info-card">
                            <div class="info-icon">
                                <i class="fa-solid fa-phone"></i>
                            </div>
                            <h3>Phone</h3>
                            <p>+63 912 345 6789</p>
                        </div>

                        <!-- Email -->
                        <div class="info-card">
                            <div class="info-icon">
                                <i class="fa-solid fa-envelope"></i>
                            </div>
                            <h3>Email</h3>
                            <p>smashlab@gmail.com</p>
                        </div>

                        <!-- Telegram -->
                        <div class="info-card">
                            <div class="info-icon">
                                <i class="fa-brands fa-telegram"></i>
                            </div>
                            <h3>Telegram</h3>
                            <p>@SmashLabOfficial</p>
                        </div>

                        <!-- Location -->
                        <div class="info-card">
                            <div class="info-icon">
                                <i class="fa-solid fa-location-dot"></i>
                            </div>
                            <h3>Location</h3>
                            <p>
                                456 Courtside Ave,<br>
                                Quezon City, Philippines
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ===========================
                MAP SECTION - FULL WIDTH
        ============================ -->

        <section class="map-section">
            <div class="map-container">
                <div v-if="mapLoading" class="map-loader">
                    <i class="fa-solid fa-spinner fa-spin"></i> Loading map...
                </div>
                <iframe
                    v-show="!mapLoading"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d30880.60284265476!2d121.03560675!3d14.6760414!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397b7e13f1c0f0d%3A0xd5b75d0a3e8f2e3!2sQuezon%20City%2C%20Metro%20Manila!5e0!3m2!1sen!2sph!4v1700000000000"
                    width="100%"
                    height="400"
                    style="border:0; display:block;"
                    loading="lazy"
                    allowfullscreen
                    title="SmashLab Location Map"
                    @load="mapLoading = false"
                ></iframe>
            </div>
        </section>

        <!-- Footer -->
        <Footer />
    </div>
</template>

<script setup>
import { ref, reactive, computed, onMounted, nextTick } from 'vue';
import Navbar from '@/Components/Home/Navbar.vue';
import Hero from '@/Components/Home/HeroSection.vue';
import Footer from '@/Components/Home/Footer.vue';

// ── Form State ──
const form = reactive({
    fullName: '',
    email: '',
    phone: '',
    message: ''
});

const isSubmitting = ref(false);
const submitSuccess = ref(false);
const submitError = ref(null);
const mapLoading = ref(true);
const successMessage = ref(null);
const errorMessage = ref(null);

// ── Validation Rules ──
const validationRules = {
    fullName: [
        { required: true, message: 'Full name is required' },
        { min: 2, message: 'Name must be at least 2 characters' }
    ],
    email: [
        { required: true, message: 'Email is required' },
        { email: true, message: 'Please enter a valid email address' }
    ],
    phone: [
        { phone: true, message: 'Please enter a valid phone number' }
    ],
    message: [
        { required: true, message: 'Message is required' },
        { min: 10, message: 'Message must be at least 10 characters' }
    ]
};

const validationErrors = reactive({
    fullName: '',
    email: '',
    phone: '',
    message: ''
});

// ── Auto-fill from user (if logged in) ──
// Uncomment if you have user data available
// const user = usePage().props.auth.user;
// 
// if (user) {
//     form.fullName = user.name || '';
//     form.email = user.email || '';
// }

// ── Validation Functions ──
const validateField = (field) => {
    const rules = validationRules[field];
    const value = form[field];
    
    if (!rules) return true;
    
    for (const rule of rules) {
        if (rule.required && !value.trim()) {
            validationErrors[field] = rule.message;
            return false;
        }
        if (rule.min && value.trim().length < rule.min) {
            validationErrors[field] = rule.message;
            return false;
        }
        if (rule.email && value.trim() && !isValidEmail(value)) {
            validationErrors[field] = rule.message;
            return false;
        }
        if (rule.phone && value.trim() && !isValidPhone(value)) {
            validationErrors[field] = rule.message;
            return false;
        }
    }
    validationErrors[field] = '';
    return true;
};

const isValidEmail = (email) => {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
};

const isValidPhone = (phone) => {
    return /^[\+\d\s\-\(\)]{7,15}$/.test(phone);
};

const validateForm = () => {
    const fields = ['fullName', 'email', 'message', 'phone'];
    let isValid = true;
    
    for (const field of fields) {
        if (!validateField(field)) {
            isValid = false;
        }
    }
    return isValid;
};

// ── Computed ──
const isFormValid = computed(() => {
    return form.fullName.trim() && 
           form.email.trim() && 
           isValidEmail(form.email) &&
           form.message.trim().length >= 10 &&
           (!form.phone || isValidPhone(form.phone));
});

// ── Submit Form ──
const submitForm = async () => {
    // Validate all fields
    if (!validateForm()) {
        // Focus on first error field
        const firstErrorField = document.querySelector('.has-error input, .has-error textarea');
        if (firstErrorField) {
            firstErrorField.focus();
        }
        return;
    }

    isSubmitting.value = true;
    submitError.value = null;
    
    try {
        // Simulate API call
        await new Promise(resolve => setTimeout(resolve, 1500));
        
        // Log form data
        console.log('Form submitted:', form);
        
        // Show success
        submitSuccess.value = true;
        
        // Focus on success message for accessibility
        await nextTick();
        if (successMessage.value) {
            successMessage.value.focus();
        }
        
        // Reset form after a short delay
        setTimeout(() => {
            form.fullName = '';
            form.email = '';
            form.phone = '';
            form.message = '';
            // Clear validation errors
            Object.keys(validationErrors).forEach(key => {
                validationErrors[key] = '';
            });
        }, 500);
        
        // Hide success message after 4 seconds
        setTimeout(() => {
            submitSuccess.value = false;
        }, 4000);
        
    } catch (error) {
        submitError.value = 'Failed to send message. Please try again.';
        console.error('Form submission error:', error);
        
        // Focus on error message for accessibility
        await nextTick();
        if (errorMessage.value) {
            errorMessage.value.focus();
        }
        
        setTimeout(() => {
            submitError.value = null;
        }, 5000);
    } finally {
        isSubmitting.value = false;
    }
};

// ── Export Function (Admin) ──
// const exportSubmissions = () => {
//     // Export form submissions to CSV
//     console.log('Exporting submissions...');
// };
</script>

<style scoped>
/*======================================
        CONTACT SECTION
======================================*/

.contact-section {
    padding: 100px 8%;
    background: #fff;
}

.contact-container {
    max-width: 1400px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 60px;
    align-items: start;
}

/*======================================
        FORM CARD
======================================*/

.contact-form-card {
    background: rgba(81, 95, 124, 0.182);
    border-radius: 24px;
    padding: 50px 45px;
    box-shadow: 0 4px 30px rgba(0, 0, 0, 0.04);
}

.form-header {
    margin-bottom: 35px;
}

.form-header h2 {
    font-size: 36px;
    font-weight: 700;
    color: #111;
    margin-bottom: 8px;
}

.form-header p {
    font-size: 16px;
    color: #777;
}

/*======================================
        FORM FIELDS
======================================*/

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
}

.form-group {
    margin-bottom: 22px;
}

.form-group label {
    display: block;
    font-size: 14px;
    font-weight: 600;
    margin-bottom: 8px;
    color: #222;
}

.form-group .required {
    color: #ef4444;
    margin-left: 2px;
}

.form-group input,
.form-group textarea {
    width: 100%;
    border: 2px solid #e8e8e8;
    border-radius: 12px;
    background: #fff;
    padding: 0 18px;
    font-size: 15px;
    font-family: 'Poppins', sans-serif;
    outline: none;
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
}

.form-group input {
    height: 50px;
}

.form-group textarea {
    height: 140px;
    resize: vertical;
    padding: 14px 18px;
}

.form-group input:focus,
.form-group textarea:focus {
    border-color: #173A8D;
    box-shadow: 0 0 0 4px rgba(23, 58, 141, 0.08);
}

.form-group input::placeholder,
.form-group textarea::placeholder {
    color: #aaa;
}

/* ── Error States ── */
.form-group.has-error input,
.form-group.has-error textarea {
    border-color: #ef4444;
}

.form-group.has-error input:focus,
.form-group.has-error textarea:focus {
    box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.12);
}

.form-group input.error,
.form-group textarea.error {
    border-color: #ef4444;
}

.error-text {
    display: block;
    margin-top: 6px;
    font-size: 13px;
    color: #ef4444;
}

.error-text i {
    margin-right: 4px;
}

.form-group small {
    display: block;
    margin-top: 4px;
    font-size: 12px;
    color: #888;
}

/* ── Char Count ── */
.char-count-wrapper {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 4px;
}

.char-count-wrapper small {
    margin-top: 0;
}

.char-count {
    font-size: 12px;
    color: #888;
    transition: color 0.3s ease;
}

.char-count-warning {
    color: #f59e0b;
}

/* ── reCAPTCHA ── */
.captcha-container {
    margin-bottom: 24px;
}

.captcha-placeholder {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 12px 18px;
    background: #f5f6f8;
    border-radius: 8px;
    border: 2px dashed #d1d5db;
    color: #6b7280;
    font-size: 14px;
}

.captcha-placeholder i {
    font-size: 20px;
    color: #173A8D;
}

/*======================================
        BUTTON
======================================*/

.contact-btn {
    width: 100%;
    height: 54px;
    border: none;
    border-radius: 12px;
    background: #173A8D;
    color: #fff;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
}

.contact-btn:hover:not(:disabled) {
    background: #0f2a6b;
    transform: translateY(-2px);
    box-shadow: 0 8px 30px rgba(23, 58, 141, 0.25);
}

.contact-btn:active:not(:disabled) {
    transform: scale(0.97);
}

.contact-btn:disabled {
    opacity: 0.7;
    cursor: not-allowed;
}

.contact-btn i {
    font-size: 14px;
}

/*======================================
        SUCCESS/ERROR MESSAGES
======================================*/

.success-message {
    margin-top: 16px;
    padding: 14px 20px;
    background: #22c55e;
    color: #fff;
    border-radius: 12px;
    text-align: center;
    font-weight: 500;
    animation: slideDown 0.4s ease;
}

.success-message i {
    margin-right: 8px;
}

.error-message {
    margin-top: 16px;
    padding: 14px 20px;
    background: #ef4444;
    color: #fff;
    border-radius: 12px;
    text-align: center;
    font-weight: 500;
    animation: slideDown 0.4s ease;
}

.error-message i {
    margin-right: 8px;
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/*======================================
        RIGHT SIDE
======================================*/

.contact-info {
    padding-top: 10px;
}

.contact-info h2 {
    font-size: 56px;
    font-weight: 800;
    line-height: 1.1;
    color: #111;
    margin-bottom: 20px;
}

.contact-description {
    font-size: 16px;
    line-height: 1.7;
    color: #555;
    max-width: 500px;
    margin-bottom: 50px;
}

/*======================================
        GRID - CENTERED
======================================*/

.contact-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 30px 40px;
}

.info-card {
    text-align: center;
    padding: 20px 0;
    border-bottom: 2px solid #f0f0f0;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.info-card:last-child,
.info-card:nth-last-child(2) {
    border-bottom: none;
}

.info-icon {
    width: 48px;
    height: 48px;
    border-radius: 14px;
    background: rgba(81, 95, 124, 0.182);
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 14px;
    margin-left: auto;
    margin-right: auto;
}

.info-icon i {
    font-size: 22px;
    color: #173A8D;
}

.info-card h3 {
    font-size: 20px;
    font-weight: 600;
    color: #888;
    margin-bottom: 4px;
    letter-spacing: 0.5px;
    text-transform: uppercase;
}

.info-card p {
    font-size: 16px;
    font-weight: 500;
    color: #111;
    line-height: 1.4;
}

/*======================================
        MAP SECTION - FULL WIDTH
======================================*/

.map-section {
    width: 100%;
    background: #fff;
}

.map-container {
    width: 100%;
    margin: 0;
    padding: 0;
    position: relative;
}

.map-loader {
    position: absolute;
    inset: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #f5f6f8;
    z-index: 1;
    font-size: 18px;
    color: #666;
}

.map-loader i {
    margin-right: 12px;
    font-size: 24px;
    color: #173A8D;
}

.map-container iframe {
    width: 100%;
    height: 450px;
    border: none;
    display: block;
    position: relative;
    z-index: 2;
}

/*======================================
        RESPONSIVE
======================================*/

@media (max-width: 1100px) {
    .contact-container {
        grid-template-columns: 1fr;
        gap: 50px;
    }

    .contact-info {
        text-align: center;
    }

    .contact-description {
        margin-left: auto;
        margin-right: auto;
    }

    .contact-grid {
        justify-items: center;
    }

    .info-card {
        text-align: center;
    }

    .info-icon {
        margin-left: auto;
        margin-right: auto;
    }

    .contact-info h2 {
        font-size: 42px;
    }
}

@media (max-width: 768px) {
    .contact-section {
        padding: 60px 20px;
    }

    .contact-form-card {
        padding: 30px 22px;
        border-radius: 18px;
    }

    .form-row {
        grid-template-columns: 1fr;
        gap: 0;
    }

    .form-header h2 {
        font-size: 28px;
    }

    .contact-info h2 {
        font-size: 34px;
    }

    .contact-description {
        font-size: 16px;
        margin-bottom: 35px;
    }

    .contact-grid {
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .info-card {
        padding: 16px 0;
    }

    .info-card h3 {
        font-size: 13px;
    }

    .info-card p {
        font-size: 15px;
    }

    .contact-btn {
        height: 48px;
        font-size: 15px;
    }

    .map-container iframe {
        height: 320px;
    }
}

@media (max-width: 480px) {
    .contact-grid {
        grid-template-columns: 1fr;
        gap: 10px;
    }

    .info-card {
        border-bottom: 2px solid #f0f0f0;
        padding: 16px 0;
    }

    .info-card:last-child {
        border-bottom: none;
    }

    .contact-info h2 {
        font-size: 28px;
    }

    .map-container iframe {
        height: 240px;
    }
}

/*======================================
        DARK MODE STYLES
======================================*/

:global(.dark) .contact-section {
    background: #0a1628;
}

:global(.dark) .contact-form-card {
    background: rgba(26, 42, 74, 0.8);
}

:global(.dark) .form-header h2 {
    color: #ffffff;
}

:global(.dark) .form-header p {
    color: #9ca3af;
}

:global(.dark) .form-group label {
    color: #d1d5db;
}

:global(.dark) .form-group input,
:global(.dark) .form-group textarea {
    background: #0a1628;
    border-color: #2a3a5a;
    color: #d1d5db;
}

:global(.dark) .form-group input::placeholder,
:global(.dark) .form-group textarea::placeholder {
    color: #6b7280;
}

:global(.dark) .form-group input:focus,
:global(.dark) .form-group textarea:focus {
    border-color: #1f47d8;
    box-shadow: 0 0 0 4px rgba(31, 71, 216, 0.15);
}

:global(.dark) .form-group.has-error input,
:global(.dark) .form-group.has-error textarea {
    border-color: #ef4444;
}

:global(.dark) .error-text {
    color: #f87171;
}

:global(.dark) .form-group small {
    color: #6b7280;
}

:global(.dark) .char-count {
    color: #6b7280;
}

:global(.dark) .char-count-warning {
    color: #fbbf24;
}

:global(.dark) .captcha-placeholder {
    background: #1a2a4a;
    border-color: #2a3a5a;
    color: #6b7280;
}

:global(.dark) .captcha-placeholder i {
    color: #4a7a9c;
}

:global(.dark) .contact-btn {
    background: #1f47d8;
}

:global(.dark) .contact-btn:hover:not(:disabled) {
    background: #2a5ae8;
    box-shadow: 0 8px 30px rgba(31, 71, 216, 0.4);
}

:global(.dark) .success-message {
    background: #065f46;
}

:global(.dark) .error-message {
    background: #7f1d1d;
}

:global(.dark) .contact-info h2 {
    color: #ffffff;
}

:global(.dark) .contact-description {
    color: #9ca3af;
}

:global(.dark) .info-card {
    border-bottom-color: #2a3a5a;
}

:global(.dark) .info-card:last-child,
:global(.dark) .info-card:nth-last-child(2) {
    border-bottom: none;
}

:global(.dark) .info-icon {
    background: rgba(31, 71, 216, 0.15);
}

:global(.dark) .info-icon i {
    color: #4a7a9c;
}

:global(.dark) .info-card h3 {
    color: #6b7280;
}

:global(.dark) .info-card p {
    color: #d1d5db;
}

:global(.dark) .map-section {
    background: #0a1628;
}

:global(.dark) .map-container {
    background: #0a1628;
}

:global(.dark) .map-loader {
    background: #1a2a4a;
    color: #9ca3af;
}

:global(.dark) .map-loader i {
    color: #4a7a9c;
}

:global(.dark) .map-container iframe {
    filter: brightness(0.8) contrast(1.2) saturate(0.5);
}
</style>