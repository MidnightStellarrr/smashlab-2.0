<template>
    <div class="enroll-page">
        <Navbar />

        <!-- Hero Section -->
        <section class="hero-section">
            <div class="hero-overlay"></div>
            <!-- White Diagonal Shape -->
            <div class="hero-shape"></div>
            <div class="hero-container">
                <!-- Left Content -->
                <div class="hero-content">
                    <h1>Enroll Now</h1>
                    <p>
                        Start your badminton journey with us. Fill in the form below and
                        we'll get you started on the right track.
                    </p>
                    <Link href="/classes" class="hero-btn">
                        Browse Classes <i class="fa-solid fa-arrow-right"></i>
                    </Link>
                </div>
                <!-- Right Image -->
                <div class="hero-image">
                    <img
                        src="/images/enroll_hero.png"
                        alt="Badminton Player"
                    >
                </div>
            </div>
        </section>

        <!-- Enrollment Form -->
        <section class="enroll-section">
            <div class="enroll-container">

                <!-- Form Progress -->
                <div class="form-progress">
                    <div v-for="(step, index) in steps" :key="index" class="progress-step" :class="getStepClass(index + 1)">
                        <span class="step-number">{{ index + 1 }}</span>
                        <span class="step-label">{{ step.label }}</span>
                        <div v-if="index < steps.length - 1" class="progress-line" :class="{ active: currentStep > index + 1 }"></div>
                    </div>
                </div>

                <form id="enrollmentForm" class="enrollment-form" @submit.prevent="submitForm">

                    <!-- Step 1: Personal Details -->
                    <div v-show="currentStep === 1" class="form-step active" data-step="1">
                        <div class="form-header">
                            <h2>Personal Details</h2>
                            <p>Tell us a little about yourself so we can get to know you better.</p>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label>First Name <span class="required">*</span></label>
                                <input type="text" v-model="form.first_name" placeholder="e.g. Juan" required>
                            </div>
                            <div class="form-group">
                                <label>Last Name <span class="required">*</span></label>
                                <input type="text" v-model="form.last_name" placeholder="e.g. Dela Cruz" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label>Date of Birth <span class="required">*</span></label>
                                <input type="date" v-model="form.dob" required>
                            </div>
                            <div class="form-group">
                                <label>Gender</label>
                                <select v-model="form.gender">
                                    <option value="">Select Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="prefer-not-say">Prefer not to say</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label>Phone Number <span class="required">*</span></label>
                                <input type="tel" v-model="form.phone" placeholder="e.g. +63 912 345 6789" required>
                            </div>
                            <div class="form-group">
                                <label>Email Address <span class="required">*</span></label>
                                <input type="email" v-model="form.email" placeholder="e.g. juan@email.com" required>
                            </div>
                        </div>

                        <!-- Guardian (Under 18) -->
                        <div class="form-row guardian-section">
                            <div class="form-group">
                                <label>Guardian's Name</label>
                                <input type="text" v-model="form.guardian_name" placeholder="e.g. Maria Dela Cruz">
                            </div>
                            <div class="form-group">
                                <label>Relationship with Guardian</label>
                                <input type="text" v-model="form.guardian_relationship" placeholder="e.g. Mother">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label>Emergency Contact Name <span class="required">*</span></label>
                                <input type="text" v-model="form.emergency_name" placeholder="e.g. Maria Dela Cruz" required>
                            </div>
                            <div class="form-group">
                                <label>Emergency Contact Number <span class="required">*</span></label>
                                <input type="tel" v-model="form.emergency_phone" placeholder="e.g. +63 912 345 6789" required>
                            </div>
                        </div>

                        <button type="button" class="btn-next" @click="nextStep(1)">
                            Next Step <i class="fa-solid fa-arrow-right"></i>
                        </button>
                    </div>

                    <!-- Step 2: Skills & Experience -->
                    <div v-show="currentStep === 2" class="form-step" data-step="2">
                        <div class="form-header">
                            <h2>Skills & Experience</h2>
                            <p>Tell us about your badminton background so we can place you in the right class.</p>
                        </div>

                        <!-- Class Selection -->
                        <div class="form-group">
                            <label>Select Class <span class="required">*</span></label>
                            <select v-model="form.class_type" id="classType" required>
                                <option value="">Select a class</option>
                                <option value="beginner">Beginner Class</option>
                                <option value="intermediate">Intermediate Class</option>
                                <option value="advanced">Advanced Class</option>
                            </select>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label>Skill Level <span class="required">*</span></label>
                                <select v-model="form.skill_level" required>
                                    <option value="">Select your skill level</option>
                                    <option value="beginner">Beginner — No experience needed</option>
                                    <option value="intermediate">Intermediate — Basic knowledge required</option>
                                    <option value="advanced">Advanced — Tournament experience recommended</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Previous Experience (Optional)</label>
                                <input type="text" v-model="form.previous_experience" placeholder="e.g. Played in school tournaments">
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Health Conditions (Optional)</label>
                            <textarea v-model="form.health_conditions" placeholder="List any health conditions we should know about..."></textarea>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label>Preferred Days</label>
                                <div class="checkbox-group">
                                    <label><input type="checkbox" v-model="form.days" value="mon"> Mon/Wed/Fri</label>
                                    <label><input type="checkbox" v-model="form.days" value="tue"> Tue/Thu</label>
                                    <label><input type="checkbox" v-model="form.days" value="weekend"> Weekends</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Preferred Time</label>
                                <select v-model="form.preferred_time">
                                    <option value="">Select preferred time</option>
                                    <option value="morning">Morning</option>
                                    <option value="afternoon">Afternoon</option>
                                    <option value="evening">Evening</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="button" class="btn-prev" @click="prevStep">
                                <i class="fa-solid fa-arrow-left"></i> Back
                            </button>
                            <button type="button" class="btn-next" @click="nextStep(2)">
                                Next Step <i class="fa-solid fa-arrow-right"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Step 3: Payment & Commitment -->
                    <div v-show="currentStep === 3" class="form-step" data-step="3">
                        <div class="form-header">
                            <h2>Payment & Commitment</h2>
                            <p>Choose a package that works for you and complete your enrollment.</p>
                        </div>

                        <!-- Package Selection -->
                        <div class="form-group">
                            <label>Package Selection <span class="required">*</span></label>
                            <div class="package-options" id="packageOptions">
                                <div v-for="(pkg, index) in packages" :key="index" 
                                    class="package-option" :class="{ 'popular-package': pkg.popular }"
                                    @click="selectPackage(pkg)">
                                    <span v-if="pkg.popular" class="package-badge">Most Popular</span>
                                    <input type="radio" name="package" :value="pkg.name.toLowerCase()" v-model="form.package">
                                    <div class="package-content">
                                        <h3>{{ pkg.name }}</h3>
                                        <span class="package-price">{{ pkg.price }}</span>
                                        <span class="package-desc">{{ pkg.desc }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Method -->
                        <div class="form-group">
                            <label>Payment Method <span class="required">*</span></label>
                            <div class="payment-methods">
                                <div v-for="method in paymentMethods" :key="method.value" class="payment-option">
                                    <input type="radio" name="payment_method" :id="'payment-' + method.value" :value="method.value" v-model="form.payment_method">
                                    <label :for="'payment-' + method.value">
                                        <i :class="method.icon"></i> {{ method.label }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Waiver -->
                        <div class="form-group waiver-group">
                            <label class="checkbox-label">
                                <input type="checkbox" v-model="form.waiver" required>
                                I have read and agree to the <a href="#" class="waiver-link">Waiver and Consent Form</a>
                            </label>
                            <label class="checkbox-label">
                                <input type="checkbox" v-model="form.terms" required>
                                I agree to the <a href="#" class="terms-link">Terms and Regulations</a> of Smash Lab
                            </label>
                        </div>

                        <div class="form-actions">
                            <button type="button" class="btn-prev" @click="prevStep">
                                <i class="fa-solid fa-arrow-left"></i> Back
                            </button>
                            <button type="submit" class="btn-submit">
                                <i class="fa-solid fa-check"></i> Enroll Now
                            </button>
                        </div>
                    </div>

                </form>

            </div>
        </section>

        <!-- Footer -->
        <Footer />
    </div>
</template>

<script setup>
import { ref, computed, watch, onMounted } from 'vue';
import { Link } from '@inertiajs/vue3';
import Navbar from '@/Components/Home/Navbar.vue';
import Footer from '@/Components/Home/Footer.vue';

// ── Form Steps ──
const steps = [
    { label: 'Personal Details' },
    { label: 'Skills & Experience' },
    { label: 'Payment & Commitment' }
];

const currentStep = ref(1);

// ── Form Data ──
const form = ref({
    first_name: '',
    last_name: '',
    dob: '',
    gender: '',
    phone: '',
    email: '',
    guardian_name: '',
    guardian_relationship: '',
    emergency_name: '',
    emergency_phone: '',
    class_type: '',
    skill_level: '',
    previous_experience: '',
    health_conditions: '',
    days: [],
    preferred_time: '',
    package: '',
    payment_method: '',
    waiver: false,
    terms: false
});

// ── Packages Data ──
const classPackages = {
    beginner: [
        { name: 'Drop-in', price: '₱150', desc: 'per session', popular: false },
        { name: 'Monthly', price: '₱500', desc: 'per month', popular: true },
        { name: 'Quarterly', price: '₱1,350', desc: 'per quarter', popular: false }
    ],
    intermediate: [
        { name: 'Drop-in', price: '₱180', desc: 'per session', popular: false },
        { name: 'Monthly', price: '₱600', desc: 'per month', popular: true },
        { name: 'Quarterly', price: '₱1,620', desc: 'per quarter', popular: false }
    ],
    advanced: [
        { name: 'Drop-in', price: '₱250', desc: 'per session', popular: false },
        { name: 'Monthly', price: '₱800', desc: 'per month', popular: true },
        { name: 'Quarterly', price: '₱2,160', desc: 'per quarter', popular: false }
    ]
};

const packages = ref([]);

// ── Payment Methods ──
const paymentMethods = [
    { value: 'gcash', label: 'GCash', icon: 'fa-solid fa-mobile-screen-button' },
    { value: 'maya', label: 'Maya', icon: 'fa-solid fa-credit-card' },
    { value: 'frontdesk', label: 'Front Desk', icon: 'fa-solid fa-building' }
];

// ── Watch Class Type Change ──
watch(() => form.value.class_type, (newVal) => {
    if (newVal) {
        packages.value = classPackages[newVal] || classPackages.beginner;
        // Auto-select first package (popular one)
        const popularPkg = packages.value.find(p => p.popular);
        if (popularPkg) {
            form.value.package = popularPkg.name.toLowerCase();
        } else if (packages.value.length > 0) {
            form.value.package = packages.value[0].name.toLowerCase();
        }
    }
});

// ── Select Package ──
const selectPackage = (pkg) => {
    form.value.package = pkg.name.toLowerCase();
};

// ── Step Functions ──
const getStepClass = (step) => {
    if (step === currentStep.value) return 'active';
    if (step < currentStep.value) return 'completed';
    return '';
};

const nextStep = (step) => {
    if (validateStep(step)) {
        currentStep.value = step + 1;
    }
};

const prevStep = () => {
    currentStep.value = currentStep.value - 1;
};

// ── Validation ──
const validateStep = (step) => {
    let isValid = true;
    const stepFields = {
        1: ['first_name', 'last_name', 'dob', 'phone', 'email', 'emergency_name', 'emergency_phone'],
        2: ['class_type', 'skill_level'],
        3: ['package', 'payment_method']
    };

    const fields = stepFields[step] || [];
    fields.forEach(field => {
        if (!form.value[field] || form.value[field] === '') {
            isValid = false;
            // Add error class to the input
            const input = document.querySelector(`[name="${field}"]`);
            if (input) {
                input.classList.add('error');
                setTimeout(() => input.classList.remove('error'), 3000);
            }
        }
    });

    // Special validation for step 3
    if (step === 3) {
        if (!form.value.waiver || !form.value.terms) {
            isValid = false;
            document.querySelector('.waiver-group')?.classList.add('error');
            setTimeout(() => document.querySelector('.waiver-group')?.classList.remove('error'), 3000);
        }
    }

    if (!isValid) {
        alert('Please fill in all required fields.');
    }

    return isValid;
};

// ── Form Submit ──
const submitForm = () => {
    if (validateStep(3)) {
        alert('🎉 Enrollment successful! You will receive a confirmation email shortly.');
        // In production, you would submit the form data to the server here
        // axios.post('/api/enroll', form.value)
    }
};

// ── Set default class from URL ──
onMounted(() => {
    const urlParams = new URLSearchParams(window.location.search);
    const classParam = urlParams.get('class');
    if (classParam && ['beginner', 'intermediate', 'advanced'].includes(classParam)) {
        form.value.class_type = classParam;
        packages.value = classPackages[classParam] || classPackages.beginner;
    } else {
        // Default to beginner packages
        packages.value = classPackages.beginner;
    }
});
</script>

<style scoped>
/*============================================
    GLOBAL
============================================*/
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Poppins', sans-serif;
    background: #f5f6f8;
}

/*======================================
        HERO SECTION
=======================================*/
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

.hero-content {
    max-width: 560px;
    color: #fff;
    margin-top: 130px;
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

.hero-image {
    flex: 1;
    display: flex;
    justify-content: flex-end;
    align-items: flex-end;
    height: 100%;
}

.hero-image img {
    height: 700px;
    width: 1000px;
    max-width: 100%;
    object-fit: contain;
    position: relative;
    bottom: -100px;
    z-index: 5;
    margin-right: -200px;
}

/* ── Hero Button ── */
.hero-btn {
    display: inline-flex;
    align-items: center;
    gap: 12px;
    padding: 14px 40px;
    margin-top: 28px;
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

/*============================================
    ENROLL SECTION
============================================*/
.enroll-section {
    padding: 60px 8% 100px;
    background: #f5f6f8;
}

.enroll-container {
    max-width: 900px;
    margin: 0 auto;
    background: #fff;
    border-radius: 24px;
    padding: 50px 60px;
    box-shadow: 0 4px 30px rgba(0, 0, 0, 0.06);
}

/*============================================
    FORM PROGRESS
============================================*/
.form-progress {
    display: grid;
    grid-template-columns: 1fr auto 1fr auto 1fr;
    align-items: start;
    margin-bottom: 50px;
    padding: 0 160px;
    width: 100%;
    gap: 150px;
}

.progress-step {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 8px;
    position: relative;
}

.progress-step:nth-child(1) { grid-column: 1; }
.progress-step:nth-child(3) { grid-column: 3; }
.progress-step:nth-child(5) { grid-column: 5; }

.progress-line {
    height: 2px;
    background: #e8eaed;
    transition: all 0.3s ease;
    align-self: center;
    margin-bottom: 30px;
    width: 100%;
    min-width: 30px;
}

.progress-line:nth-child(2) { grid-column: 2; }
.progress-line:nth-child(4) { grid-column: 4; }

.progress-line.active {
    background: #173A8D;
}

.step-number {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: #e8eaed;
    color: #888;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
    font-weight: 700;
    font-family: 'Poppins', sans-serif;
    transition: all 0.3s ease;
}

.progress-step.active .step-number {
    background: #173A8D;
    color: #fff;
    box-shadow: 0 4px 16px rgba(23, 58, 141, 0.3);
}

.progress-step.completed .step-number {
    background: #22c55e;
    color: #fff;
}

.step-label {
    font-size: 14px;
    font-weight: 500;
    color: #888;
    font-family: 'Poppins', sans-serif;
    transition: all 0.3s ease;
    
}

.progress-step.active .step-label {
    color: #173A8D;
    font-weight: 600;
}

.progress-line {
    flex: 1;
    height: 2px;
    background: #e8eaed;
    margin: 0 10px;
    margin-bottom: 30px;
    transition: all 0.3s ease;
}

.progress-line.active {
    background: #173A8D;
}

/*============================================
    FORM STEPS
============================================*/
.form-step {
    display: none;
    animation: fadeIn 0.4s ease;
}

.form-step.active {
    display: block;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

.form-header {
    margin-bottom: 35px;
}

.form-header h2 {
    font-size: 30px;
    font-weight: 800;
    color: #111;
    margin-bottom: 6px;
    font-family: 'Poppins', sans-serif;
}

.form-header p {
    font-size: 16px;
    color: #666;
    font-family: 'Poppins', sans-serif;
}

/*============================================
    FORM FIELDS
============================================*/
.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 24px;
    margin-bottom: 24px;
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: 6px;
}

.form-group label {
    font-size: 14px;
    font-weight: 600;
    color: #333;
    font-family: 'Poppins', sans-serif;
}

.form-group .required {
    color: #ef4444;
}

.form-group input,
.form-group select,
.form-group textarea {
    padding: 12px 16px;
    border: 2px solid #e8eaed;
    border-radius: 12px;
    font-size: 15px;
    font-family: 'Poppins', sans-serif;
    transition: all 0.3s ease;
    background: #fff;
    width: 100%;
    color: #333;
}

.form-group input::placeholder,
.form-group textarea::placeholder {
    color: #aaa;
    font-family: 'Poppins', sans-serif;
}

.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
    border-color: #173A8D;
    outline: none;
    box-shadow: 0 0 0 4px rgba(23, 58, 141, 0.08);
}

.form-group input.error,
.form-group select.error,
.form-group textarea.error {
    border-color: #ef4444;
}

.form-group textarea {
    resize: vertical;
    min-height: 100px;
}

/* ── Checkbox Group ── */
.checkbox-group {
    display: flex;
    gap: 16px;
    flex-wrap: wrap;
    padding-top: 6px;
}

.checkbox-group label {
    display: flex;
    align-items: center;
    gap: 8px;
    font-weight: 400;
    font-size: 14px;
    color: #555;
    font-family: 'Poppins', sans-serif;
    cursor: pointer;
}

.checkbox-group input[type="checkbox"] {
    width: 18px;
    height: 18px;
    accent-color: #173A8D;
    cursor: pointer;
}

/* ── Guardian Section ── */
.guardian-section {
    background: #f8f9fa;
    padding: 16px;
    border-radius: 12px;
    margin-bottom: 24px;
}

.guardian-section label {
    font-size: 13px;
    font-family: 'Poppins', sans-serif;
}

/*============================================
    PACKAGE OPTIONS
============================================*/
.package-options {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 16px;
    margin-top: 8px;
}

.package-option {
    position: relative;
    border: 2px solid #e8eaed;
    border-radius: 16px;
    padding: 20px 16px;
    text-align: center;
    cursor: pointer;
    transition: all 0.3s ease;
}

.package-option:hover {
    border-color: #173A8D;
}

.package-option input[type="radio"] {
    display: none;
}

.package-option .package-content h3 {
    font-size: 18px;
    font-weight: 700;
    color: #111;
    margin-bottom: 4px;
    font-family: 'Poppins', sans-serif;
}

.package-option .package-price {
    font-size: 28px;
    font-weight: 800;
    color: #173A8D;
    font-family: 'Poppins', sans-serif;
}

.package-option .package-desc {
    font-size: 13px;
    color: #888;
    font-family: 'Poppins', sans-serif;
}

.package-option:has(input:checked) {
    border-color: #173A8D;
    background: rgba(23, 58, 141, 0.04);
    box-shadow: 0 4px 20px rgba(23, 58, 141, 0.08);
}

.package-option.popular-package {
    border-color: #173A8D;
    position: relative;
}

.package-badge {
    position: absolute;
    top: -10px;
    left: 50%;
    transform: translateX(-50%);
    background: #173A8D;
    color: #fff;
    padding: 2px 16px;
    border-radius: 40px;
    font-size: 11px;
    font-weight: 600;
    font-family: 'Poppins', sans-serif;
    text-transform: uppercase;
    white-space: nowrap;
}

/*============================================
    PAYMENT METHODS
============================================*/
.payment-methods {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 16px;
    margin-top: 8px;
    padding: 12px;
    border: 2px solid #e8eaed;
    border-radius: 12px;
    transition: border-color 0.3s ease;
}

.payment-option {
    display: flex;
    align-items: center;
    justify-content: center;
}

.payment-option input[type="radio"] {
    display: none;
}

.payment-option label {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 12px 20px;
    border-radius: 40px;
    background: #f5f6f8;
    font-size: 15px;
    font-weight: 500;
    font-family: 'Poppins', sans-serif;
    cursor: pointer;
    transition: all 0.3s ease;
    width: 100%;
    justify-content: center;
}

.payment-option label i {
    font-size: 20px;
    color: #173A8D;
}

.payment-option:has(input:checked) label {
    background: #173A8D;
    color: #fff;
}

.payment-option:has(input:checked) label i {
    color: #fff;
}

/*============================================
    WAIVER
============================================*/
.waiver-group {
    margin-top: 24px;
    padding: 20px;
    background: #f8f9fa;
    border-radius: 12px;
    border: 2px solid transparent;
    transition: border-color 0.3s ease;
}

.waiver-group.error {
    border-color: #ef4444;
}

.checkbox-label {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 14px;
    color: #555;
    font-family: 'Poppins', sans-serif;
    cursor: pointer;
    padding: 6px 0;
}

.checkbox-label input[type="checkbox"] {
    width: 18px;
    height: 18px;
    accent-color: #173A8D;
    cursor: pointer;
    flex-shrink: 0;
}

.checkbox-label a {
    color: #173A8D;
    text-decoration: underline;
    font-family: 'Poppins', sans-serif;
}

/*============================================
    FORM ACTIONS
============================================*/
.form-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 40px;
    padding-top: 24px;
    border-top: 1px solid #e8eaed;
}

.btn-prev,
.btn-next,
.btn-submit {
    padding: 14px 36px;
    border: none;
    border-radius: 40px;
    font-size: 16px;
    font-weight: 600;
    font-family: 'Poppins', sans-serif;
    cursor: pointer;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 10px;
}

.btn-prev {
    background: #f5f6f8;
    color: #555;
}

.btn-prev:hover {
    background: #e8eaed;
}

.btn-next {
    background: #173A8D;
    color: #fff;
}

.btn-next:hover {
    background: #0f2a6b;
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(23, 58, 141, 0.3);
}

.btn-submit {
    background: #22c55e;
    color: #fff;
}

.btn-submit:hover {
    background: #16a34a;
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(34, 197, 94, 0.3);
}

/*============================================
    DARK MODE STYLES
============================================*/
:global(.dark) .hero-section {
    background: linear-gradient(90deg, #0a1628 0%, #0a1628 45%, #1a2a4a 100%);
}

:global(.dark) .hero-overlay {
    background: linear-gradient(90deg, rgba(0,0,0,0.5), rgba(0,0,0,0.3));
}

:global(.dark) .hero-shape {
    background: #1a2a4a;
}

:global(.dark) .hero-content h1 {
    color: #ffffff;
}

:global(.dark) .hero-content p {
    color: #9ca3af;
}

:global(.dark) .hero-btn {
    background: #1f47d8;
    color: #ffffff;
}

:global(.dark) .hero-btn:hover {
    box-shadow: 0 8px 30px rgba(31, 71, 216, 0.4);
}

:global(.dark) .enroll-section {
    background: #0a1628;
}

:global(.dark) .enroll-container {
    background: #1a2a4a;
    box-shadow: 0 4px 30px rgba(0, 0, 0, 0.3);
}

:global(.dark) .step-number {
    background: #2a3a5a;
    color: #6b7280;
}

:global(.dark) .progress-step.active .step-number {
    background: #1f47d8;
    color: #fff;
    box-shadow: 0 4px 16px rgba(31, 71, 216, 0.3);
}

:global(.dark) .progress-step.completed .step-number {
    background: #065f46;
    color: #34d399;
}

:global(.dark) .step-label {
    color: #6b7280;
}

:global(.dark) .progress-step.active .step-label {
    color: #4a7a9c;
}

:global(.dark) .progress-line {
    background: #2a3a5a;
}

:global(.dark) .progress-line.active {
    background: #1f47d8;
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
:global(.dark) .form-group select,
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
:global(.dark) .form-group select:focus,
:global(.dark) .form-group textarea:focus {
    border-color: #1f47d8;
    box-shadow: 0 0 0 4px rgba(31, 71, 216, 0.15);
}

:global(.dark) .form-group input[type="date"] {
    color-scheme: dark;
}

:global(.dark) .form-group input[type="date"]::-webkit-calendar-picker-indicator {
    filter: invert(1);
}

:global(.dark) .guardian-section {
    background: #0a1628;
}

:global(.dark) .checkbox-group label {
    color: #d1d5db;
}

:global(.dark) .checkbox-group input[type="checkbox"] {
    accent-color: #1f47d8;
}

:global(.dark) .package-option {
    border-color: #2a3a5a;
}

:global(.dark) .package-option:hover {
    border-color: #1f47d8;
}

:global(.dark) .package-option .package-content h3 {
    color: #ffffff;
}

:global(.dark) .package-option .package-price {
    color: #4a7a9c;
}

:global(.dark) .package-option .package-desc {
    color: #6b7280;
}

:global(.dark) .package-option:has(input:checked) {
    border-color: #1f47d8;
    background: rgba(31, 71, 216, 0.1);
    box-shadow: 0 4px 20px rgba(31, 71, 216, 0.15);
}

:global(.dark) .package-option.popular-package {
    border-color: #1f47d8;
}

:global(.dark) .package-badge {
    background: #1f47d8;
}

:global(.dark) .payment-methods {
    border-color: #2a3a5a;
}

:global(.dark) .payment-option label {
    background: #0a1628;
    color: #9ca3af;
}

:global(.dark) .payment-option label i {
    color: #4a7a9c;
}

:global(.dark) .payment-option:has(input:checked) label {
    background: #1f47d8;
    color: #ffffff;
}

:global(.dark) .payment-option:has(input:checked) label i {
    color: #ffffff;
}

:global(.dark) .waiver-group {
    background: #0a1628;
}

:global(.dark) .checkbox-label {
    color: #9ca3af;
}

:global(.dark) .checkbox-label input[type="checkbox"] {
    accent-color: #1f47d8;
}

:global(.dark) .checkbox-label a {
    color: #4a7a9c;
}

:global(.dark) .form-actions {
    border-color: #2a3a5a;
}

:global(.dark) .btn-prev {
    background: #2a3a5a;
    color: #9ca3af;
}

:global(.dark) .btn-prev:hover {
    background: #3a4a6a;
}

:global(.dark) .btn-next {
    background: #1f47d8;
}

:global(.dark) .btn-next:hover {
    background: #2a5ae8;
    box-shadow: 0 8px 25px rgba(31, 71, 216, 0.4);
}

:global(.dark) .btn-submit {
    background: #065f46;
    color: #34d399;
}

:global(.dark) .btn-submit:hover {
    background: #0a7a5a;
    box-shadow: 0 8px 25px rgba(6, 95, 70, 0.4);
}

/*============================================
    RESPONSIVE
============================================*/
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

@media (max-width: 992px) {
    .enroll-container {
        padding: 35px 30px;
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
        margin-right: 0;
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

@media (max-width: 768px) {
    .enroll-section {
        padding: 40px 5% 60px;
    }

    .enroll-container {
        padding: 30px 20px;
        border-radius: 16px;
    }

    .form-progress {
        flex-direction: column;
        gap: 12px;
        padding: 0;
        margin-bottom: 30px;
    }

    .progress-step {
        flex-direction: row;
        width: 100%;
        justify-content: flex-start;
        gap: 12px;
    }

    .progress-line {
        display: none;
    }

    .form-row {
        grid-template-columns: 1fr;
        gap: 16px;
    }

    .package-options {
        grid-template-columns: 1fr;
        gap: 12px;
    }

    .payment-methods {
        grid-template-columns: 1fr;
        gap: 10px;
    }

    .payment-option label {
        padding: 10px 16px;
    }

    .form-actions {
        flex-direction: column;
        gap: 12px;
    }

    .btn-prev,
    .btn-next,
    .btn-submit {
        width: 100%;
        justify-content: center;
    }

    .guardian-section {
        padding: 12px;
    }

    .checkbox-group {
        flex-direction: column;
        gap: 8px;
    }
}

@media (max-width: 480px) {
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

    .enroll-container {
        padding: 20px 16px;
    }

    .form-header h2 {
        font-size: 24px;
    }

    .step-number {
        width: 34px;
        height: 34px;
        font-size: 14px;
    }

    .step-label {
        font-size: 13px;
    }

    .package-option .package-price {
        font-size: 24px;
    }

    .package-option {
        padding: 16px 12px;
    }
}
</style>