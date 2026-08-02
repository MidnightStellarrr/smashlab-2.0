<template>
    <div class="book-now-page">
        <!-- Hero Section -->
        <HeroSection 
            main-heading="Book Now"
            sub-heading="Reserve your spot at SmashLab — where every game is an adventure."
            bg-image="/images/hero_bg.jpg"
            height="400px"
            :centered="true"
        />

        <!-- Progress Wrapper -->
        <div class="progress-wrapper">
            <div class="form-progress">
                <div v-for="(step, index) in steps" :key="index" class="progress-step" :class="getStepClass(index + 1)">
                    <span class="step-number">{{ String(index + 1).padStart(2, '0') }}</span>
                    <span class="step-label">{{ step.label }}</span>
                    <div v-if="index < steps.length - 1" class="progress-line" :class="{ active: currentStep > index + 1 }"></div>
                </div>
            </div>
        </div>

        <!-- Booking Section -->
        <section class="booking-section">
            <div class="booking-container">
                <!-- LEFT: Schedule Card -->
                <div class="schedule-card">
                    <div class="schedule-date">
                        <i class="fa-regular fa-calendar" @click="openDatePicker"></i>
                        <span>{{ formattedDate }}</span>
                        <input 
                            type="date" 
                            ref="datePickerInput"
                            class="hidden-date-input"
                            v-model="booking.date"
                            :min="today"
                            @change="updateDateFromPicker"
                        >
                    </div>

                    <div class="schedule-table-wrapper">
                        <table class="schedule-table">
                            <thead>
                                <tr>
                                    <th>Time Slot</th>
                                    <th v-for="court in 4" :key="court">Court {{ court }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="slot in filteredTimeSlots" :key="slot.time">
                                    <td>{{ slot.time }}</td>
                                    <td v-for="court in 4" :key="court">
                                        <span :class="slot[`court${court}`].class">{{ slot[`court${court}`].label }}</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="legend">
                        <div><span class="circle green"></span>Available</div>
                        <div><span class="circle red"></span>Reserved</div>
                        <div><span class="circle yellow"></span>Under Maintenance</div>
                    </div>
                </div>

                <!-- RIGHT: Booking Form -->
                <div class="booking-form">
                    <!-- Step 1: Date & Time -->
                    <div v-show="currentStep === 1" class="form-step active">
                        <div class="form-header">
                            <h2>Date & Time</h2>
                            <p>Pick your preferred date and time to get started.</p>
                        </div>
                        <hr>

                        <div class="form-group">
                            <label for="bookingDate">Date</label>
                            <input type="date" id="bookingDate" class="form-input" v-model="booking.date" :min="today">
                            <span v-if="dateError" class="error-message">{{ dateError }}</span>
                        </div>

                        <div class="form-group">
                            <label for="bookingTime">Time</label>
                            <select id="bookingTime" class="form-input" v-model="booking.time">
                                <option value="">Select a time</option>
                                <option v-for="time in timeOptions" :key="time.value" :value="time.value">
                                    {{ time.label }}
                                </option>
                            </select>
                            <span v-if="timeError" class="error-message">{{ timeError }}</span>
                        </div>

                        <button type="button" class="btn-next" @click="nextStep(1)">
                            Next Step <i class="fa-solid fa-arrow-right"></i>
                        </button>
                    </div>

                    <!-- Step 2: Select Court -->
                    <div v-show="currentStep === 2" class="form-step active">
                        <div class="form-header">
                            <h2>Select Court</h2>
                            <p>Choose your preferred court from the available options.</p>
                        </div>
                        <hr>

                        <div class="form-group">
                            <label for="bookingCourt">Court Preference</label>
                            <select id="bookingCourt" class="form-input" v-model="booking.court">
                                <option value="">Any Court</option>
                                <option v-for="court in 4" :key="court" :value="court">Court {{ court }}</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Number of Players</label>
                            <select id="playerCount" class="form-input" v-model="booking.players">
                                <option v-for="n in 8" :key="n" :value="n">{{ n }} {{ n === 1 ? 'Player' : 'Players' }}</option>
                            </select>
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

                    <!-- Step 3: Review and Payment -->
                    <div v-show="currentStep === 3" class="form-step active">
                        <div class="form-header">
                            <h2>Review and Payment</h2>
                            <p>Review your booking details and choose your payment method.</p>
                        </div>
                        <hr>

                        <div class="booking-summary">
                            <div class="summary-row">
                                <span>Date:</span>
                                <span>{{ booking.date ? formatDate(booking.date) : '-' }}</span>
                            </div>
                            <div class="summary-row">
                                <span>Time:</span>
                                <span>{{ booking.time ? getTimeLabel(booking.time) : '-' }}</span>
                            </div>
                            <div class="summary-row">
                                <span>Court:</span>
                                <span>{{ booking.court ? `Court ${booking.court}` : 'Any Court' }}</span>
                            </div>
                            <div class="summary-row">
                                <span>Players:</span>
                                <span>{{ booking.players }} {{ booking.players === 1 ? 'Player' : 'Players' }}</span>
                            </div>
                            <div class="summary-row total">
                                <span>Total:</span>
                                <span>₱{{ totalPrice.toFixed(2) }}</span>
                            </div>
                        </div>

                        <div class="payment-options">
                            <label v-for="method in paymentMethods" :key="method.value" class="payment-option">
                                <input type="radio" name="payment" :value="method.value" v-model="booking.payment">
                                {{ method.label }}
                            </label>
                        </div>

                        <div class="form-actions">
                            <button type="button" class="btn-prev" @click="prevStep">
                                <i class="fa-solid fa-arrow-left"></i> Back
                            </button>
                            <button type="button" class="btn-next" @click="nextStep(3)">
                                Confirm Booking <i class="fa-solid fa-check"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Step 4: Confirmation -->
                    <div v-show="currentStep === 4" class="form-step active">
                        <div class="confirmation-content">
                            <div class="confirmation-icon">
                                <i class="fa-solid fa-check-circle"></i>
                            </div>
                            <h2>Booking Confirmed!</h2>
                            <p>Your court has been successfully reserved.</p>

                            <div class="booking-details">
                                <div class="detail-row">
                                    <span>Booking Reference:</span>
                                    <strong>#BK-2026-{{ String(Math.floor(Math.random() * 1000)).padStart(3, '0') }}</strong>
                                </div>
                                <div class="detail-row">
                                    <span>Date:</span>
                                    <strong>{{ booking.date ? formatDate(booking.date) : '-' }}</strong>
                                </div>
                                <div class="detail-row">
                                    <span>Time:</span>
                                    <strong>{{ booking.time ? getTimeLabel(booking.time) : '-' }}</strong>
                                </div>
                                <div class="detail-row">
                                    <span>Court:</span>
                                    <strong>{{ booking.court ? `Court ${booking.court}` : 'Any Court' }}</strong>
                                </div>
                                <div class="detail-row">
                                    <span>Total Paid:</span>
                                    <strong>₱{{ totalPrice.toFixed(2) }}</strong>
                                </div>
                            </div>

                            <p class="confirmation-note">
                                <i class="fa-regular fa-envelope"></i>
                                A confirmation email has been sent to your registered email address.
                            </p>

                            <Link href="/" class="btn-done">
                                <i class="fa-solid fa-home"></i> Back to Home
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <Footer />
    </div>
</template>

<script setup>
import { ref, computed, onMounted, watch } from 'vue';
import { Link } from '@inertiajs/vue3';
import HeroSection from '@/Components/Home/HeroSection.vue';
import Footer from '@/Components/Home/Footer.vue';

// ── Form Steps ──
const steps = [
    { label: 'Choose Date & Time' },
    { label: 'Select Court' },
    { label: 'Review and Payment' },
    { label: 'Confirmation' }
];

const currentStep = ref(1);

// ── Booking Data ──
const booking = ref({
    date: '',
    time: '',
    court: '',
    players: 2,
    payment: 'gcash'
});

// ── Today's Date ──
const today = computed(() => {
    const d = new Date();
    return d.toISOString().split('T')[0];
});

// ── Formatted Date ──
const formattedDate = ref(new Date().toLocaleDateString('en-US', { 
    year: 'numeric', 
    month: 'long', 
    day: 'numeric' 
}));

// ── Error refs (MUST be defined BEFORE validateDate) ──
const dateError = ref('');
const timeError = ref('');

// ── Reference for date picker ──
const datePickerInput = ref(null);

// ── Open date picker ──
const openDatePicker = () => {
    if (datePickerInput.value) {
        datePickerInput.value.showPicker();
    }
};

// ── Update date from picker ──
const updateDateFromPicker = () => {
    if (booking.value.date) {
        // Update formatted date display
        const d = new Date(booking.value.date);
        formattedDate.value = d.toLocaleDateString('en-US', { 
            year: 'numeric', 
            month: 'long', 
            day: 'numeric' 
        });
        
        // Reset time when date changes
        booking.value.time = '';
        timeError.value = '';
        
        // Check if selected date is past
        validateDate();
    }
};

// ── Date Validation ──
const validateDate = () => {
    if (!booking.value.date) {
        dateError.value = 'Please select a date.';
        return false;
    }
    
    const selected = new Date(booking.value.date);
    const today = new Date();
    today.setHours(0, 0, 0, 0);
    
    if (selected < today) {
        dateError.value = '⚠️ You cannot select a past date. Please choose today or a future date.';
        return false;
    }
    
    dateError.value = '';
    return true;
};

// ── Time Options ──
const timeOptions = [
    { value: '10:00', label: '10:00 AM' },
    { value: '11:00', label: '11:00 AM' },
    { value: '12:00', label: '12:00 PM' },
    { value: '13:00', label: '1:00 PM' },
    { value: '14:00', label: '2:00 PM' },
    { value: '15:00', label: '3:00 PM' },
    { value: '16:00', label: '4:00 PM' },
    { value: '17:00', label: '5:00 PM' },
    { value: '18:00', label: '6:00 PM' },
    { value: '19:00', label: '7:00 PM' },
    { value: '20:00', label: '8:00 PM' },
    { value: '21:00', label: '9:00 PM' },
    { value: '22:00', label: '10:00 PM' }
];

// ── Payment Methods ──
const paymentMethods = [
    { value: 'gcash', label: 'GCash' },
    { value: 'maya', label: 'Maya' },
    { value: 'frontdesk', label: 'Front Desk' }
];

// ── Time Slots (for schedule table) ──
const timeSlots = [
    { time: '10:00 AM', court1: { class: 'available', label: 'Available' }, court2: { class: 'reserved', label: 'Reserved' }, court3: { class: 'available', label: 'Available' }, court4: { class: 'available', label: 'Available' } },
    { time: '11:00 AM', court1: { class: 'available', label: 'Available' }, court2: { class: 'available', label: 'Available' }, court3: { class: 'reserved', label: 'Reserved' }, court4: { class: 'available', label: 'Available' } },
    { time: '12:00 PM', court1: { class: 'reserved', label: 'Reserved' }, court2: { class: 'available', label: 'Available' }, court3: { class: 'available', label: 'Available' }, court4: { class: 'reserved', label: 'Reserved' } },
    { time: '1:00 PM', court1: { class: 'reserved', label: 'Reserved' }, court2: { class: 'available', label: 'Available' }, court3: { class: 'reserved', label: 'Reserved' }, court4: { class: 'available', label: 'Available' } },
    { time: '2:00 PM', court1: { class: 'available', label: 'Available' }, court2: { class: 'reserved', label: 'Reserved' }, court3: { class: 'available', label: 'Available' }, court4: { class: 'reserved', label: 'Reserved' } },
    { time: '3:00 PM', court1: { class: 'reserved', label: 'Reserved' }, court2: { class: 'reserved', label: 'Reserved' }, court3: { class: 'available', label: 'Available' }, court4: { class: 'reserved', label: 'Reserved' } },
    { time: '4:00 PM', court1: { class: 'available', label: 'Available' }, court2: { class: 'available', label: 'Available' }, court3: { class: 'reserved', label: 'Reserved' }, court4: { class: 'available', label: 'Available' } },
    { time: '5:00 PM', court1: { class: 'reserved', label: 'Reserved' }, court2: { class: 'available', label: 'Available' }, court3: { class: 'available', label: 'Available' }, court4: { class: 'reserved', label: 'Reserved' } },
    { time: '6:00 PM', court1: { class: 'available', label: 'Available' }, court2: { class: 'reserved', label: 'Reserved' }, court3: { class: 'available', label: 'Available' }, court4: { class: 'available', label: 'Available' } },
    { time: '7:00 PM', court1: { class: 'reserved', label: 'Reserved' }, court2: { class: 'available', label: 'Available' }, court3: { class: 'reserved', label: 'Reserved' }, court4: { class: 'available', label: 'Available' } },
    { time: '8:00 PM', court1: { class: 'available', label: 'Available' }, court2: { class: 'available', label: 'Available' }, court3: { class: 'reserved', label: 'Reserved' }, court4: { class: 'reserved', label: 'Reserved' } },
    { time: '9:00 PM', court1: { class: 'reserved', label: 'Reserved' }, court2: { class: 'available', label: 'Available' }, court3: { class: 'available', label: 'Available' }, court4: { class: 'reserved', label: 'Reserved' } },
    { time: '10:00 PM', court1: { class: 'available', label: 'Available' }, court2: { class: 'reserved', label: 'Reserved' }, court3: { class: 'available', label: 'Available' }, court4: { class: 'available', label: 'Available' } }
];

// ── Future Date Availability (different from current) ──
const futureTimeSlots = [
    { time: '10:00 AM', court1: { class: 'available', label: 'Available' }, court2: { class: 'available', label: 'Available' }, court3: { class: 'available', label: 'Available' }, court4: { class: 'available', label: 'Available' } },
    { time: '11:00 AM', court1: { class: 'available', label: 'Available' }, court2: { class: 'available', label: 'Available' }, court3: { class: 'available', label: 'Available' }, court4: { class: 'available', label: 'Available' } },
    { time: '12:00 PM', court1: { class: 'available', label: 'Available' }, court2: { class: 'available', label: 'Available' }, court3: { class: 'available', label: 'Available' }, court4: { class: 'available', label: 'Available' } },
    { time: '1:00 PM', court1: { class: 'available', label: 'Available' }, court2: { class: 'available', label: 'Available' }, court3: { class: 'available', label: 'Available' }, court4: { class: 'available', label: 'Available' } },
    { time: '2:00 PM', court1: { class: 'available', label: 'Available' }, court2: { class: 'available', label: 'Available' }, court3: { class: 'available', label: 'Available' }, court4: { class: 'available', label: 'Available' } },
    { time: '3:00 PM', court1: { class: 'available', label: 'Available' }, court2: { class: 'available', label: 'Available' }, court3: { class: 'available', label: 'Available' }, court4: { class: 'available', label: 'Available' } },
    { time: '4:00 PM', court1: { class: 'available', label: 'Available' }, court2: { class: 'available', label: 'Available' }, court3: { class: 'available', label: 'Available' }, court4: { class: 'available', label: 'Available' } },
    { time: '5:00 PM', court1: { class: 'available', label: 'Available' }, court2: { class: 'available', label: 'Available' }, court3: { class: 'available', label: 'Available' }, court4: { class: 'available', label: 'Available' } },
    { time: '6:00 PM', court1: { class: 'available', label: 'Available' }, court2: { class: 'available', label: 'Available' }, court3: { class: 'available', label: 'Available' }, court4: { class: 'available', label: 'Available' } },
    { time: '7:00 PM', court1: { class: 'available', label: 'Available' }, court2: { class: 'available', label: 'Available' }, court3: { class: 'available', label: 'Available' }, court4: { class: 'available', label: 'Available' } },
    { time: '8:00 PM', court1: { class: 'available', label: 'Available' }, court2: { class: 'available', label: 'Available' }, court3: { class: 'available', label: 'Available' }, court4: { class: 'available', label: 'Available' } },
    { time: '9:00 PM', court1: { class: 'available', label: 'Available' }, court2: { class: 'available', label: 'Available' }, court3: { class: 'available', label: 'Available' }, court4: { class: 'available', label: 'Available' } },
    { time: '10:00 PM', court1: { class: 'available', label: 'Available' }, court2: { class: 'available', label: 'Available' }, court3: { class: 'available', label: 'Available' }, court4: { class: 'available', label: 'Available' } }
];

// ── Total Price ──
const totalPrice = computed(() => {
    let basePrice = 200;
    if (booking.value.players > 4) basePrice += 50;
    return basePrice;
});

// ── Filtered Time Slots based on selected date ──
const filteredTimeSlots = computed(() => {
    if (!booking.value.date) return timeSlots;
    
    const selected = new Date(booking.value.date);
    const today = new Date();
    today.setHours(0, 0, 0, 0);
    
    // If date is in the past, mark all as unavailable
    if (selected < today) {
        return timeSlots.map(slot => {
            const newSlot = { ...slot };
            for (let i = 1; i <= 4; i++) {
                newSlot[`court${i}`] = { 
                    class: 'reserved', 
                    label: 'Unavailable' 
                };
            }
            return newSlot;
        });
    }
    
    // If date is more than 7 days in the future, use future availability
    const sevenDaysLater = new Date();
    sevenDaysLater.setDate(sevenDaysLater.getDate() + 7);
    
    if (selected > sevenDaysLater) {
        return futureTimeSlots;
    }
    
    // For today and up to 7 days ahead, use current time slots
    return timeSlots;
});

// ── Step Functions ──
const getStepClass = (step) => {
    if (step === currentStep.value) return 'active';
    if (step < currentStep.value) return 'completed';
    return '';
};

const nextStep = (step) => {
    // Validate based on current step
    if (step === 1) {
        if (!booking.value.date) {
            alert('Please select a date.');
            return;
        }
        if (!booking.value.time) {
            alert('Please select a time.');
            return;
        }
        // Check if date is past
        const selected = new Date(booking.value.date);
        const today = new Date();
        today.setHours(0, 0, 0, 0);
        if (selected < today) {
            alert('⚠️ You cannot select a past date. Please choose today or a future date.');
            return;
        }
    }
    
    if (step === 2) {
        if (!booking.value.court) {
            alert('Please select a court.');
            return;
        }
    }
    
    if (step === 3) {
        if (!booking.value.payment) {
            alert('Please select a payment method.');
            return;
        }
        // Final step - show confirmation
        currentStep.value = 4;
        return;
    }
    
    currentStep.value = step + 1;
};

const prevStep = () => {
    currentStep.value = currentStep.value - 1;
};

// ── Helpers ──
const formatDate = (dateStr) => {
    if (!dateStr) return '-';
    const d = new Date(dateStr);
    return d.toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' });
};

const getTimeLabel = (time) => {
    const option = timeOptions.find(t => t.value === time);
    return option ? option.label : time;
};

// ── Set default date on mount ──
onMounted(() => {
    booking.value.date = today.value;
});

// ── Watch for date changes ──
watch(() => booking.value.date, (newVal) => {
    if (newVal) {
        validateDate();
        // Reset time selection when date changes
        booking.value.time = '';
        timeError.value = '';
        
        // Update formatted date
        const d = new Date(newVal);
        formattedDate.value = d.toLocaleDateString('en-US', { 
            year: 'numeric', 
            month: 'long', 
            day: 'numeric' 
        });
    }
});
</script>

<style scoped>
/* ============================================
   PROGRESS WRAPPER
   ============================================ */
.progress-wrapper {
    width: 100%;
    padding: 30px 8% 10px;
    background: #fff;
}

.form-progress {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin: 0 auto;
    padding: 0 10px;
    max-width: 700px;
    width: 100%;
}

.progress-step {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 6px;
    position: relative;
    flex: 1;
}

.step-number {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: #e8eaed;
    color: #888;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 12px;
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
    font-size: 11px;
    font-weight: 500;
    color: #888;
    font-family: 'Poppins', sans-serif;
    text-align: center;
    transition: all 0.3s ease;
    max-width: 80px;
    line-height: 1.2;
}

.progress-step.active .step-label {
    color: #173A8D;
    font-weight: 600;
}

.progress-line {
    flex: 1;
    height: 2px;
    background: #e8eaed;
    margin: 0 4px;
    margin-bottom: 24px;
    transition: all 0.3s ease;
    min-width: 20px;
}

.progress-line.active {
    background: #173A8D;
}

/* ============================================
   BOOKING SECTION
   ============================================ */
.booking-section {
    padding: 0 8% 100px;
    background: #fff;
}

.booking-container {
    max-width: 1400px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: 1fr 480px;
    gap: 50px;
    align-items: start;
}

/* ============================================
   SCHEDULE CARD
   ============================================ */
.schedule-card {
    background: #f0f0f0;
    padding: 20px;
    border-radius: 20px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
}

.schedule-date {
    background: #fff;
    border-radius: 12px;
    padding: 14px 20px;
    display: flex;
    align-items: center;
    gap: 12px;
    font-weight: 600;
    font-size: 16px;
    color: #333;
    margin-bottom: 18px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.04);
    position: relative;
}

.schedule-date i {
    color: #173A8D;
    font-size: 18px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.schedule-date i:hover {
    transform: scale(1.1);
    color: #0f2a6b;
}

.hidden-date-input {
    position: absolute;
    opacity: 0;
    width: 0;
    height: 0;
    pointer-events: none;
}

.schedule-table-wrapper {
    background: #fff;
    border-radius: 12px;
    padding: 16px;
    max-height: 520px;
    overflow-y: auto;
}

.schedule-table-wrapper::-webkit-scrollbar {
    width: 6px;
}

.schedule-table-wrapper::-webkit-scrollbar-track {
    background: #f0f0f0;
    border-radius: 10px;
}

.schedule-table-wrapper::-webkit-scrollbar-thumb {
    background: #173A8D;
    border-radius: 10px;
}

.schedule-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 14px;
}

.schedule-table thead {
    background: #f8f9fa;
    position: sticky;
    top: 0;
    z-index: 5;
}

.schedule-table th,
.schedule-table td {
    border: 1px solid #e8e8e8;
    text-align: center;
    padding: 10px 12px;
}

.schedule-table th {
    background: #f8f9fa;
    font-weight: 600;
    color: #333;
    position: sticky;
    top: 0;
    z-index: 10;
    border-bottom: 2px solid #173A8D;
}

.schedule-table td {
    color: #555;
    background: #fff;
}

/* Status Badges */
.available,
.reserved,
.maintenance {
    display: inline-block;
    padding: 4px 14px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    color: #fff;
}

.available { background: #35c400; }
.reserved { background: #ef0000; }
.maintenance { background: #ece300; color: #000; }

/* Legend */
.legend {
    display: flex;
    justify-content: flex-end;
    gap: 24px;
    margin-top: 16px;
    padding: 12px 8px 0;
    font-size: 13px;
    color: #555;
}

.legend div {
    display: flex;
    align-items: center;
    gap: 8px;
}

.circle {
    width: 12px;
    height: 12px;
    border-radius: 50%;
}

.circle.green { background: #35c400; }
.circle.red { background: #ef0000; }
.circle.yellow { background: #ece300; }

/* ============================================
   BOOKING FORM
   ============================================ */
.booking-form {
    background: #f0f0f0;
    border-radius: 20px;
    padding: 35px 30px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
}

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
    margin-bottom: 20px;
}

.form-header h2 {
    font-size: 28px;
    font-weight: 800;
    color: #111;
    margin-bottom: 4px;
    font-family: 'Poppins', sans-serif;
}

.form-header p {
    font-size: 15px;
    color: #666;
    font-family: 'Poppins', sans-serif;
}

.booking-form hr {
    border: none;
    border-top: 1px solid #e8e8e8;
    margin-bottom: 22px;
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    margin-bottom: 6px;
    font-weight: 600;
    font-size: 14px;
    color: #333;
    font-family: 'Poppins', sans-serif;
}

.form-input {
    width: 100%;
    height: 46px;
    padding: 0 16px;
    border: 2px solid #e0e0e0;
    border-radius: 12px;
    font-size: 15px;
    font-family: 'Poppins', sans-serif;
    background: #fff;
    transition: all 0.3s ease;
    color: #333;
    appearance: none;
    -webkit-appearance: none;
}

.form-input:focus {
    border-color: #173A8D;
    outline: none;
    box-shadow: 0 0 0 4px rgba(23, 58, 141, 0.08);
}

.form-input.error {
    border-color: #ef4444;
}

.form-input[type="date"] {
    color-scheme: light;
}

.error-message {
    display: block;
    color: #ef4444;
    font-size: 13px;
    margin-top: 6px;
    font-weight: 500;
}

/* Buttons */
.btn-prev,
.btn-next {
    padding: 12px 32px;
    border: none;
    border-radius: 40px;
    font-size: 15px;
    font-weight: 600;
    font-family: 'Poppins', sans-serif;
    cursor: pointer;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 10px;
}

.btn-prev {
    background: #ffffff;
    color: #000000;
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

.form-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 30px;
    padding-top: 20px;
    border-top: 1px solid #e8eaed;
}

/* Booking Summary */
.booking-summary {
    background: #ffffff;
    border-radius: 12px;
    padding: 20px;
    margin-bottom: 24px;
}

.summary-row {
    display: flex;
    justify-content: space-between;
    padding: 8px 0;
    border-bottom: 1px solid #e8eaed;
    font-size: 15px;
    color: #333;
}

.summary-row:last-child {
    border-bottom: none;
}

.summary-row.total {
    font-weight: 700;
    font-size: 18px;
    padding-top: 12px;
    border-top: 2px solid #173A8D;
    margin-top: 4px;
}

.summary-row.total span:last-child {
    color: #173A8D;
}

/* Payment Options */
.payment-options {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    gap: 12px;
    padding: 12px;
    border: 2px solid #e8eaed;
    border-radius: 12px;
    transition: border-color 0.3s ease;
}

.payment-option {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 10px 16px;
    border-radius: 40px;
    background: #ffffff;
    font-size: 14px;
    font-weight: 500;
    font-family: 'Poppins', sans-serif;
    cursor: pointer;
    transition: all 0.3s ease;
}

.payment-option input[type="radio"] {
    display: none;
}

.payment-option:has(input:checked) {
    background: #173A8D;
    color: #fff;
}

/* Confirmation */
.confirmation-content {
    text-align: center;
}

.confirmation-icon {
    font-size: 72px;
    color: #22c55e;
    margin-bottom: 5px;
}

.confirmation-content h2 {
    font-size: 32px;
    font-weight: 800;
    color: #111;
    margin-bottom: 8px;
}

.confirmation-content > p {
    font-size: 16px;
    color: #666;
    margin-bottom: 30px;
}

.booking-details {
    background: #ffffff;
    border-radius: 12px;
    padding: 20px 24px;
    text-align: left;
    margin-bottom: 24px;
}

.detail-row {
    display: flex;
    justify-content: space-between;
    padding: 8px 0;
    border-bottom: 1px solid #e8eaed;
    font-size: 15px;
    color: #555;
}

.detail-row:last-child {
    border-bottom: none;
}

.detail-row strong {
    color: #111;
}

.confirmation-note {
    font-size: 14px;
    color: #888;
    margin-bottom: 24px;
}

.confirmation-note i {
    color: #173A8D;
    margin-right: 8px;
}

.btn-done {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 14px 40px;
    border-radius: 40px;
    background: #173A8D;
    color: #fff;
    text-decoration: none;
    font-size: 16px;
    font-weight: 600;
    font-family: 'Poppins', sans-serif;
    transition: all 0.3s ease;
}

.btn-done:hover {
    background: #0f2a6b;
    transform: translateY(-3px);
    box-shadow: 0 8px 30px rgba(23, 58, 141, 0.3);
}

/* ============================================
   DARK MODE
   ============================================ */
:global(.dark) .progress-wrapper {
    background: #0a1628;
}

:global(.dark) .step-number {
    background: #1a2a4a;
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
    background: #1a2a4a;
}

:global(.dark) .progress-line.active {
    background: #1f47d8;
}

:global(.dark) .booking-section {
    background: #0a1628;
}

:global(.dark) .schedule-card {
    background: #1a2a4a;
}

:global(.dark) .schedule-date {
    background: #0a1628;
    color: #d1d5db;
}

:global(.dark) .schedule-date i {
    color: #4a7a9c;
}

:global(.dark) .schedule-table-wrapper {
    background: #0a1628;
}

:global(.dark) .schedule-table th {
    background: #1a2a4a;
    color: #d1d5db;
    border-color: #2a3a5a;
}

:global(.dark) .schedule-table td {
    color: #9ca3af;
    background: #0a1628;
    border-color: #2a3a5a;
}

:global(.dark) .available {
    background: #065f46;
    color: #34d399;
}

:global(.dark) .reserved {
    background: #7f1d1d;
    color: #f87171;
}

:global(.dark) .maintenance {
    background: #78350f;
    color: #fbbf24;
}

:global(.dark) .legend {
    color: #9ca3af;
}

:global(.dark) .circle.green { background: #34d399; }
:global(.dark) .circle.red { background: #f87171; }
:global(.dark) .circle.yellow { background: #fbbf24; }

:global(.dark) .booking-form {
    background: #1a2a4a;
}

:global(.dark) .form-header h2 {
    color: #ffffff;
}

:global(.dark) .form-header p {
    color: #9ca3af;
}

:global(.dark) .booking-form hr {
    border-color: #2a3a5a;
}

:global(.dark) .form-group label {
    color: #d1d5db;
}

:global(.dark) .form-input {
    background: #0a1628;
    border-color: #2a3a5a;
    color: #d1d5db;
}

:global(.dark) .form-input:focus {
    border-color: #1f47d8;
    box-shadow: 0 0 0 4px rgba(31, 71, 216, 0.15);
}

:global(.dark) .form-input[type="date"] {
    color-scheme: dark;
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

:global(.dark) .booking-summary {
    background: #0a1628;
}

:global(.dark) .summary-row {
    color: #d1d5db;
    border-color: #2a3a5a;
}

:global(.dark) .summary-row.total {
    border-color: #1f47d8;
}

:global(.dark) .summary-row.total span:last-child {
    color: #4a7a9c;
}

:global(.dark) .payment-options {
    border-color: #2a3a5a;
}

:global(.dark) .payment-option {
    background: #0a1628;
    color: #9ca3af;
}

:global(.dark) .payment-option:has(input:checked) {
    background: #1f47d8;
    color: #ffffff;
}

:global(.dark) .confirmation-icon {
    color: #34d399;
}

:global(.dark) .confirmation-content h2 {
    color: #ffffff;
}

:global(.dark) .confirmation-content > p {
    color: #9ca3af;
}

:global(.dark) .booking-details {
    background: #0a1628;
}

:global(.dark) .detail-row {
    color: #9ca3af;
    border-color: #2a3a5a;
}

:global(.dark) .detail-row strong {
    color: #ffffff;
}

:global(.dark) .confirmation-note {
    color: #6b7280;
}

:global(.dark) .confirmation-note i {
    color: #4a7a9c;
}

:global(.dark) .btn-done {
    background: #1f47d8;
}

:global(.dark) .btn-done:hover {
    background: #2a5ae8;
    box-shadow: 0 8px 30px rgba(31, 71, 216, 0.4);
}

:global(.dark) .schedule-table-wrapper::-webkit-scrollbar-track {
    background: #1a2a4a;
}

:global(.dark) .schedule-table-wrapper::-webkit-scrollbar-thumb {
    background: #1f47d8;
}

/* ============================================
   RESPONSIVE
   ============================================ */
@media (max-width: 1200px) {
    .booking-container {
        grid-template-columns: 1fr 400px;
        gap: 40px;
    }
}

@media (max-width: 992px) {
    .booking-container {
        grid-template-columns: 1fr;
        gap: 40px;
    }

    .booking-form {
        max-width: 600px;
        margin: 0 auto;
        width: 100%;
    }

    .schedule-card {
        max-width: 100%;
        overflow-x: auto;
    }

    .schedule-table-wrapper {
        max-height: 400px;
    }
}

@media (max-width: 768px) {
    .booking-section {
        padding: 20px 5% 60px;
    }

    .schedule-card {
        padding: 14px;
        border-radius: 14px;
    }

    .schedule-table-wrapper {
        padding: 10px;
        max-height: 350px;
    }

    .schedule-table th,
    .schedule-table td {
        padding: 8px 6px;
        font-size: 12px;
    }

    .available,
    .reserved,
    .maintenance {
        font-size: 10px;
        padding: 3px 10px;
    }

    .legend {
        justify-content: center;
        gap: 16px;
        font-size: 12px;
        flex-wrap: wrap;
    }

    .booking-form {
        padding: 24px 18px;
        border-radius: 14px;
    }

    .form-progress {
        flex-wrap: wrap;
        gap: 8px;
        justify-content: center;
        max-width: 100%;
    }

    .progress-step {
        flex-direction: row;
        gap: 8px;
    }

    .progress-line {
        display: none;
    }

    .step-number {
        width: 28px;
        height: 28px;
        font-size: 11px;
    }

    .step-label {
        font-size: 10px;
        max-width: 100%;
    }

    .form-header h2 {
        font-size: 24px;
    }

    .form-input {
        height: 42px;
        font-size: 14px;
    }

    .form-actions {
        flex-direction: column;
        gap: 10px;
    }

    .btn-prev,
    .btn-next {
        width: 100%;
        justify-content: center;
    }

    .payment-options {
        grid-template-columns: 1fr;
        gap: 8px;
    }

    .confirmation-icon {
        font-size: 56px;
    }

    .confirmation-content h2 {
        font-size: 26px;
    }

    .btn-done {
        width: 100%;
        justify-content: center;
    }
}

@media (max-width: 480px) {
    .booking-section {
        padding: 20px 4% 50px;
    }

    .schedule-date {
        font-size: 14px;
        padding: 10px 14px;
    }

    .schedule-table th,
    .schedule-table td {
        padding: 6px 4px;
        font-size: 11px;
    }

    .available,
    .reserved,
    .maintenance {
        font-size: 9px;
        padding: 2px 8px;
    }

    .form-progress {
        flex-direction: column;
        gap: 6px;
        align-items: flex-start;
        padding: 0;
    }

    .progress-step {
        flex-direction: row;
        gap: 10px;
        width: 100%;
    }

    .step-label {
        font-size: 13px;
        max-width: 100%;
    }

    .form-header h2 {
        font-size: 20px;
    }

    .form-input {
        height: 38px;
        font-size: 13px;
        padding: 0 12px;
    }

    .confirmation-icon {
        font-size: 48px;
    }

    .confirmation-content h2 {
        font-size: 22px;
    }
}
</style>