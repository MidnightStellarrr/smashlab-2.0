<template>
    <section class="available-courts">
        <div class="section-title">
            <h2>Find Your Court</h2>
            <p>See real-time availability and book instantly.</p>
        </div>

        <div class="booking-container">
            <!-- Calendar -->
            <div class="calendar">
                <div class="calendar-header">
                    <div class="month">
                        <h3 id="monthDisplay">{{ monthName }}</h3>
                        <span id="yearDisplay">{{ currentYear }}</span>
                    </div>
                    <select v-model="selectedMonth" @change="updateCalendar">
                        <option v-for="(name, index) in monthNames" :key="index" :value="index">
                            {{ name }}
                        </option>
                    </select>
                </div>

                <div class="weekdays">
                    <span>SUN</span>
                    <span>MON</span>
                    <span>TUE</span>
                    <span>WED</span>
                    <span>THU</span>
                    <span>FRI</span>
                    <span>SAT</span>
                </div>

                <div class="days">
                    <div
                        v-for="day in calendarDays"
                        :key="day.key"
                        :class="['day', day.isActive ? 'active' : '', day.isInactive ? 'inactive' : '']"
                        @click="day.isInactive ? null : selectDay(day)"
                    >
                        {{ day.label }}
                    </div>
                </div>
            </div>

            <!-- Court Table -->
            <div class="court-table">
                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th>Time Slot</th>
                                <th>Court 1</th>
                                <th>Court 2</th>
                                <th>Court 3</th>
                                <th>Court 4</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="slot in timeSlots" :key="slot.time">
                                <td>{{ slot.time }}</td>
                                <td><span :class="slot.court1.class">{{ slot.court1.label }}</span></td>
                                <td><span :class="slot.court2.class">{{ slot.court2.label }}</span></td>
                                <td><span :class="slot.court3.class">{{ slot.court3.label }}</span></td>
                                <td><span :class="slot.court4.class">{{ slot.court4.label }}</span></td>
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
        </div>

        <Link href="/book_now" class="book-now-btn">
            + Book now
        </Link>
    </section>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import { ref, computed, onMounted } from 'vue';

const monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
const selectedMonth = ref(11);
const currentYear = ref(2026);
const selectedDay = ref(null);

const monthName = computed(() => monthNames[selectedMonth.value]);

const calendarDays = computed(() => {
    const days = [];
    const firstDay = new Date(currentYear.value, selectedMonth.value, 1).getDay();
    const daysInMonth = new Date(currentYear.value, selectedMonth.value + 1, 0).getDate();
    const daysInPrevMonth = new Date(currentYear.value, selectedMonth.value, 0).getDate();

    // Previous month's trailing days
    const prevMonthStart = daysInPrevMonth - firstDay + 1;
    for (let i = prevMonthStart; i <= daysInPrevMonth; i++) {
        days.push({ label: i, isActive: false, isInactive: true, key: `prev-${i}` });
    }

    // Current month's days
    const today = new Date();
    const isToday = (day) => day === today.getDate() && selectedMonth.value === today.getMonth() && currentYear.value === today.getFullYear();

    for (let i = 1; i <= daysInMonth; i++) {
        const active = isToday(i) || i === selectedDay?.value;
        days.push({ label: i, isActive: active, isInactive: false, key: `current-${i}` });
    }

    // Next month's leading days
    const totalDays = firstDay + daysInMonth;
    const remainingDays = 42 - totalDays;
    for (let i = 1; i <= remainingDays; i++) {
        days.push({ label: i, isActive: false, isInactive: true, key: `next-${i}` });
    }

    return days;
});

const updateCalendar = () => {
    selectedDay.value = null;
};

const selectDay = (day) => {
    selectedDay.value = day.label;
};

const timeSlots = ref([
    {
        time: '10:00 AM',
        court1: { class: 'available', label: 'Available' },
        court2: { class: 'available', label: 'Available' },
        court3: { class: 'reserved', label: 'Reserved' },
        court4: { class: 'available', label: 'Available' }
    },
    {
        time: '11:00 AM',
        court1: { class: 'available', label: 'Available' },
        court2: { class: 'reserved', label: 'Reserved' },
        court3: { class: 'available', label: 'Available' },
        court4: { class: 'reserved', label: 'Reserved' }
    },
    {
        time: '12:00 PM',
        court1: { class: 'available', label: 'Available' },
        court2: { class: 'available', label: 'Available' },
        court3: { class: 'available', label: 'Available' },
        court4: { class: 'reserved', label: 'Reserved' }
    },
    {
        time: '1:00 PM',
        court1: { class: 'reserved', label: 'Reserved' },
        court2: { class: 'available', label: 'Available' },
        court3: { class: 'reserved', label: 'Reserved' },
        court4: { class: 'available', label: 'Available' }
    },
    {
        time: '2:00 PM',
        court1: { class: 'available', label: 'Available' },
        court2: { class: 'reserved', label: 'Reserved' },
        court3: { class: 'available', label: 'Available' },
        court4: { class: 'reserved', label: 'Reserved' }
    },
    {
        time: '3:00 PM',
        court1: { class: 'reserved', label: 'Reserved' },
        court2: { class: 'reserved', label: 'Reserved' },
        court3: { class: 'maintenance', label: 'Maintenance' },
        court4: { class: 'available', label: 'Available' }
    },
    {
        time: '4:00 PM',
        court1: { class: 'reserved', label: 'Reserved' },
        court2: { class: 'available', label: 'Available' },
        court3: { class: 'reserved', label: 'Reserved' },
        court4: { class: 'reserved', label: 'Reserved' }
    },
    {
        time: '5:00 PM',
        court1: { class: 'reserved', label: 'Reserved' },
        court2: { class: 'available', label: 'Available' },
        court3: { class: 'available', label: 'Available' },
        court4: { class: 'reserved', label: 'Reserved' }
    },
    {
        time: '6:00 PM',
        court1: { class: 'available', label: 'Available' },
        court2: { class: 'reserved', label: 'Reserved' },
        court3: { class: 'available', label: 'Available' },
        court4: { class: 'available', label: 'Available' }
    },
    {
        time: '7:00 PM',
        court1: { class: 'reserved', label: 'Reserved' },
        court2: { class: 'available', label: 'Available' },
        court3: { class: 'reserved', label: 'Reserved' },
        court4: { class: 'available', label: 'Available' }
    },
    {
        time: '8:00 PM',
        court1: { class: 'available', label: 'Available' },
        court2: { class: 'available', label: 'Available' },
        court3: { class: 'reserved', label: 'Reserved' },
        court4: { class: 'reserved', label: 'Reserved' }
    },
    {
        time: '9:00 PM',
        court1: { class: 'reserved', label: 'Reserved' },
        court2: { class: 'available', label: 'Available' },
        court3: { class: 'available', label: 'Available' },
        court4: { class: 'reserved', label: 'Reserved' }
    },
    {
        time: '10:00 PM',
        court1: { class: 'available', label: 'Available' },
        court2: { class: 'reserved', label: 'Reserved' },
        court3: { class: 'available', label: 'Available' },
        court4: { class: 'available', label: 'Available' }
    }
]);
</script>

<style scoped>
.available-courts {
    padding: 90px 8%;
    background: #fff;
    text-align: center;
}

.section-title h2 {
    font-size: 64px;
    font-weight: 800;
    color: #000;
}

.section-title p {
    font-size: 22px;
    color: #333;
    margin-top: 8px;
    margin-bottom: 50px;
}

.booking-container {
    background: #dfdede;
    border-radius: 24px;
    padding: 24px;
    display: grid;
    grid-template-columns: 1fr 1.8fr;
    gap: 24px;
    max-width: 1200px;
    margin: 0 auto;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
}

.calendar {
    background: #fff;
    border-radius: 18px;
    padding: 20px;
}

.calendar-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 16px;
}

.month {
    display: flex;
    align-items: end;
    gap: 10px;
}

.month h3 {
    font-size: 28px;
    font-weight: 700;
}

.month span {
    margin-bottom: 4px;
    color: #888;
    font-size: 16px;
}

.calendar-header select {
    border-radius: 20px;
    padding: 6px 14px;
    border: 1px solid #ddd;
    font-size: 14px;
    background: #f5f5f5;
}

.weekdays {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    gap: 8px;
    margin-bottom: 10px;
}

.weekdays span {
    background: #f0f0f0;
    border-radius: 12px;
    padding: 6px;
    font-size: 12px;
    font-weight: 600;
    color: #555;
}

.days {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    gap: 8px;
}

.days .day {
    background: #f5f5f5;
    border-radius: 10px;
    height: 52px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    font-size: 14px;
    font-weight: 500;
    transition: background 0.2s ease;
}

.days .day:hover:not(.inactive) {
    background: #e0e0e0;
}

.days .day.active {
    background: #1f47d8;
    color: #fff;
}

.days .day.inactive {
    color: #ccc;
    cursor: default;
}

.court-table {
    background: #fff;
    border-radius: 18px;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    max-height: 490px;
}

.table-wrapper {
    overflow-y: auto;
    overflow-x: auto;
    border-radius: 18px;
    flex: 1;
}

.table-wrapper::-webkit-scrollbar {
    width: 8px;
}

.table-wrapper::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
}

.table-wrapper::-webkit-scrollbar-thumb {
    background: #1f47d8;
    border-radius: 10px;
}

table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    border: 1px solid #e8e8e8;
    padding: 14px 12px;
    text-align: center;
    font-size: 14px;
}

th {
    background: #f8f8f8;
    font-weight: 600;
    color: #333;
    position: sticky;
    top: 0;
    z-index: 10;
}

.available, .reserved, .maintenance {
    display: inline-block;
    color: #fff;
    padding: 4px 14px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
}

.available { background: #35c400; }
.reserved { background: #ef0000; }
.maintenance { background: #ece300; color: #000; }

.legend {
    display: flex;
    justify-content: flex-end;
    gap: 24px;
    padding: 14px 20px;
    font-size: 13px;
    background: #fff;
    border-top: 1px solid #e8e8e8;
}

.legend div {
    display: flex;
    align-items: center;
    gap: 8px;
    color: #555;
}

.circle {
    width: 12px;
    height: 12px;
    border-radius: 50%;
}

.green { background: #35c400; }
.red { background: #ef0000; }
.yellow { background: #ece300; }

.book-now-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 140px;
    height: 44px;
    background: linear-gradient(90deg, #1f47d8, #17358c);
    color: #fff;
    text-decoration: none;
    padding: 0;
    margin-top: 24px;
    border-radius: 40px;
    font-size: 15px;
    font-weight: 600;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
    letter-spacing: 0.5px;
}

.book-now-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(23, 53, 140, 0.35);
}

/* Dark Mode */
:global(.dark) .available-courts { background: #0a1628; }
:global(.dark) .section-title h2 { color: #ffffff; }
:global(.dark) .section-title p { color: #9ca3af; }
:global(.dark) .booking-container { background: #1a2a4a; }
:global(.dark) .calendar { background: #0a1628; }
:global(.dark) .month h3 { color: #ffffff; }
:global(.dark) .month span { color: #6b7280; }
:global(.dark) .calendar-header select {
    background: #1a2a4a;
    color: #d1d5db;
    border-color: #2a3a5a;
}
:global(.dark) .weekdays span {
    background: #1a2a4a;
    color: #9ca3af;
}
:global(.dark) .days .day {
    background: #1a2a4a;
    color: #d1d5db;
}
:global(.dark) .days .day:hover:not(.inactive) {
    background: #2a3a5a;
}
:global(.dark) .days .day.active {
    background: #1f47d8;
    color: #ffffff;
}
:global(.dark) .days .day.inactive {
    color: #4b5563;
}
:global(.dark) .court-table { background: #0a1628; }
:global(.dark) th {
    background: #1a2a4a;
    color: #d1d5db;
    border-color: #2a3a5a;
}
:global(.dark) td {
    border-color: #2a3a5a;
    color: #d1d5db;
}
:global(.dark) .available { background: #065f46; }
:global(.dark) .reserved { background: #7f1d1d; }
:global(.dark) .maintenance { background: #78350f; color: #ffffff; }
:global(.dark) .legend { background: #0a1628; border-color: #2a3a5a; }
:global(.dark) .legend div { color: #9ca3af; }
:global(.dark) .green { background: #34d399; }
:global(.dark) .red { background: #f87171; }
:global(.dark) .yellow { background: #fbbf24; }
:global(.dark) .book-now-btn {
    background: linear-gradient(90deg, #1f47d8, #1a2a4a);
}

@media (max-width: 1200px) {
    .booking-container {
        grid-template-columns: 1fr 1.5fr;
        max-width: 100%;
        padding: 18px;
    }
}

@media (max-width: 900px) {
    .booking-container {
        grid-template-columns: 1fr;
        gap: 18px;
        padding: 16px;
    }
    .available-courts { padding: 60px 5%; }
    .section-title h2 { font-size: 40px; }
    .section-title p { font-size: 18px; margin-bottom: 30px; }
    .days .day { height: 44px; font-size: 13px; }
    .month h3 { font-size: 22px; }
    .calendar { padding: 14px; }
    th, td { padding: 10px 8px; font-size: 12px; }
}

@media (max-width: 480px) {
    .days .day { height: 36px; font-size: 11px; border-radius: 6px; }
    .weekdays span { font-size: 10px; padding: 4px; }
    th, td { padding: 6px 4px; font-size: 10px; }
    .available, .reserved, .maintenance { font-size: 9px; padding: 3px 8px; }
}
</style>