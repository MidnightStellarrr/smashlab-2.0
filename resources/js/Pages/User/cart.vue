<template>
    <div class="cart-page">
        <!-- Navbar -->
        <Navbar />

        <!-- Hero Section -->
        <Hero 
            main-heading="Your Cart"
            sub-heading="Review your items before checkout."
            bg-image="/images/hero_bg.jpg"
            height="590px"
            :centered="true"
        />

        <!-- ========================================
                CART SECTION
        ======================================== -->

        <section class="cart-section">
            <div class="cart-container">
                <!-- ── Cart Header ── -->
                <div class="cart-header">
                    <h2>Shopping Cart</h2>
                    <span class="cart-item-count">{{ cartItems.length }} items</span>
                </div>

                <!-- ── Cart Items ── -->
                <div v-if="cartItems.length > 0" class="cart-items">
                    <div 
                        v-for="item in cartItems" 
                        :key="item.id"
                        class="cart-item"
                    >
                        <div class="cart-item-image">
                            <img :src="item.image" :alt="item.name">
                        </div>
                        <div class="cart-item-details">
                            <h3>{{ item.name }}</h3>
                            <p class="item-description">{{ item.description }}</p>
                            <div class="item-actions">
                                <div class="quantity-control">
                                    <button 
                                        class="qty-btn" 
                                        @click="updateQuantity(item, item.quantity - 1)"
                                        :disabled="item.quantity <= 1"
                                    >
                                        −
                                    </button>
                                    <span class="qty-number">{{ item.quantity }}</span>
                                    <button 
                                        class="qty-btn" 
                                        @click="updateQuantity(item, item.quantity + 1)"
                                    >
                                        +
                                    </button>
                                </div>
                                <button class="remove-btn" @click="removeItem(item.id)">
                                    <i class="fa-regular fa-trash-can"></i> Remove
                                </button>
                            </div>
                        </div>
                        <div class="cart-item-price">
                            <span class="item-price">₱{{ formatPrice(item.price) }}</span>
                            <span class="item-subtotal">₱{{ formatPrice(item.price * item.quantity) }}</span>
                        </div>
                    </div>
                </div>

                <!-- ── Empty Cart State ── -->
                <div v-else class="empty-cart">
                    <div class="empty-cart-icon">
                        <i class="fa-regular fa-cart-shopping"></i>
                    </div>
                    <h3>Your cart is empty</h3>
                    <p>Looks like you haven't added any items to your cart yet.</p>
                    <Link href="/shop" class="btn-shop">
                        <i class="fa-solid fa-arrow-left"></i> Start Shopping
                    </Link>
                </div>

                <!-- ── Cart Summary ── -->
                <div v-if="cartItems.length > 0" class="cart-summary">
                    <div class="summary-header">
                        <h3>Order Summary</h3>
                    </div>

                    <div class="summary-row">
                        <span>Subtotal</span>
                        <span class="summary-amount">₱{{ formatPrice(subtotal) }}</span>
                    </div>

                    <div class="summary-row">
                        <span>Service Fee</span>
                        <span class="summary-amount">₱{{ formatPrice(serviceFee) }}</span>
                    </div>

                    <div class="summary-divider"></div>

                    <div class="summary-row total">
                        <span>Total</span>
                        <span class="summary-amount">₱{{ formatPrice(total) }}</span>
                    </div>

                    <div class="summary-actions">
                        <Link href="/shop" class="btn-continue">
                            <i class="fa-solid fa-arrow-left"></i> Continue Shopping
                        </Link>
                        <Link href="/checkout" class="btn-checkout">
                            Proceed to Checkout <i class="fa-solid fa-arrow-right"></i>
                        </Link>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <Footer />
    </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import { Link } from '@inertiajs/vue3';
import Navbar from '@/Components/Home/Navbar.vue';
import Hero from '@/Components/Home/HeroSection.vue';
import Footer from '@/Components/Home/Footer.vue';

// ── Cart State ──
const cartItems = ref([
    {
        id: 1,
        name: 'Premium Racket',
        description: 'Carbon-fiber frame. Lightweight and durable.',
        price: 150,
        quantity: 1,
        image: '/images/badminton_gear.jpg'
    },
    {
        id: 2,
        name: 'Shuttlecocks Tube',
        description: 'Tournament-grade shuttlecocks. Consistent flight.',
        price: 80,
        quantity: 2,
        image: '/images/badminton_gear.jpg'
    },
    {
        id: 3,
        name: 'Sports Drink',
        description: 'Electrolyte-infused drink. Stay hydrated.',
        price: 60,
        quantity: 1,
        image: '/images/badminton_gear.jpg'
    }
]);

// ── Computed Properties ──
const subtotal = computed(() => {
    return cartItems.value.reduce((sum, item) => sum + (item.price * item.quantity), 0);
});

const serviceFee = computed(() => {
    return cartItems.value.length > 0 ? 30 : 0;
});

const total = computed(() => {
    return subtotal.value + serviceFee.value;
});

// ── Methods ──
const formatPrice = (price) => {
    return price.toFixed(2);
};

const updateQuantity = (item, newQuantity) => {
    if (newQuantity < 1) return;
    item.quantity = newQuantity;
    // Here you would update the cart in your store/backend
    console.log(`Updated ${item.name} quantity to ${newQuantity}`);
};

const removeItem = (itemId) => {
    const item = cartItems.value.find(i => i.id === itemId);
    cartItems.value = cartItems.value.filter(i => i.id !== itemId);
    console.log(`Removed ${item?.name} from cart`);
};

// ── Load Cart from Store (optional) ──
// If using a store, you would load cart items here
// onMounted(() => {
//     cartStore.loadCart();
// });
</script>

<style scoped>
/*============================================
    CART SECTION
============================================*/

.cart-section {
    padding: 60px 8% 100px;
    background: #fff;
}

.cart-container {
    max-width: 1200px;
    margin: 0 auto;
}

/*============================================
    CART HEADER
============================================*/

.cart-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-bottom: 20px;
    border-bottom: 2px solid #f0f0f0;
    margin-bottom: 30px;
}

.cart-header h2 {
    font-size: 32px;
    font-weight: 700;
    color: #111;
}

.cart-item-count {
    font-size: 15px;
    color: #888;
    background: #f5f6f8;
    padding: 6px 18px;
    border-radius: 40px;
}

/*============================================
    CART ITEMS
============================================*/

.cart-items {
    margin-bottom: 40px;
}

.cart-item {
    display: grid;
    grid-template-columns: 120px 1fr 180px;
    gap: 24px;
    padding: 20px 0;
    border-bottom: 1px solid #f0f0f0;
    align-items: center;
}

.cart-item:last-child {
    border-bottom: none;
}

/* ── Item Image ── */

.cart-item-image {
    width: 100%;
    height: 100px;
    border-radius: 12px;
    overflow: hidden;
    background: #f5f6f8;
}

.cart-item-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* ── Item Details ── */

.cart-item-details h3 {
    font-size: 18px;
    font-weight: 700;
    color: #111;
    margin-bottom: 4px;
}

.item-description {
    font-size: 14px;
    color: #888;
    margin-bottom: 12px;
}

.item-actions {
    display: flex;
    align-items: center;
    gap: 16px;
}

/* ── Quantity Control ── */

.quantity-control {
    display: flex;
    align-items: center;
    gap: 10px;
    border: 1px solid #e0e0e0;
    border-radius: 40px;
    padding: 4px 8px;
}

.qty-btn {
    width: 28px;
    height: 28px;
    border: none;
    border-radius: 50%;
    background: #f5f6f8;
    color: #333;
    font-size: 16px;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
}

.qty-btn:hover:not(:disabled) {
    background: #e0e0e0;
}

.qty-btn:disabled {
    opacity: 0.4;
    cursor: not-allowed;
}

.qty-number {
    font-size: 15px;
    font-weight: 600;
    min-width: 24px;
    text-align: center;
    font-family: 'Poppins', sans-serif;
}

/* ── Remove Button ── */

.remove-btn {
    background: none;
    border: none;
    color: #888;
    font-size: 14px;
    cursor: pointer;
    transition: all 0.3s ease;
    font-family: 'Poppins', sans-serif;
}

.remove-btn:hover {
    color: #ef4444;
}

.remove-btn i {
    margin-right: 4px;
}

/* ── Item Price ── */

.cart-item-price {
    text-align: right;
}

.item-price {
    display: block;
    font-size: 14px;
    color: #888;
    text-decoration: line-through;
    margin-bottom: 4px;
}

.item-subtotal {
    display: block;
    font-size: 20px;
    font-weight: 700;
    color: #173A8D;
}

/*============================================
    EMPTY CART STATE
============================================*/

.empty-cart {
    text-align: center;
    padding: 80px 20px;
}

.empty-cart-icon {
    font-size: 64px;
    color: #ddd;
    margin-bottom: 20px;
}

.empty-cart h3 {
    font-size: 24px;
    font-weight: 700;
    color: #111;
    margin-bottom: 8px;
}

.empty-cart p {
    font-size: 16px;
    color: #888;
    margin-bottom: 30px;
}

.btn-shop {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 14px 40px;
    border: none;
    border-radius: 40px;
    background: #173A8D;
    color: #fff;
    text-decoration: none;
    font-size: 16px;
    font-weight: 600;
    transition: all 0.3s ease;
    font-family: 'Poppins', sans-serif;
}

.btn-shop:hover {
    background: #0f2a6b;
    transform: translateY(-3px);
    box-shadow: 0 8px 30px rgba(23, 58, 141, 0.3);
}

/*============================================
    CART SUMMARY
============================================*/

.cart-summary {
    background: #f8f9fa;
    border-radius: 16px;
    padding: 30px 35px;
    max-width: 450px;
    margin-left: auto;
}

.summary-header h3 {
    font-size: 20px;
    font-weight: 700;
    color: #111;
    margin-bottom: 20px;
    padding-bottom: 16px;
    border-bottom: 1px solid #e0e0e0;
}

.summary-row {
    display: flex;
    justify-content: space-between;
    padding: 10px 0;
    font-size: 16px;
    color: #555;
}

.summary-row .summary-amount {
    font-weight: 500;
}

.summary-divider {
    border-top: 1px solid #e0e0e0;
    margin: 12px 0;
}

.summary-row.total {
    font-size: 20px;
    font-weight: 700;
    color: #111;
    padding-top: 16px;
    padding-bottom: 20px;
}

.summary-row.total .summary-amount {
    color: #173A8D;
    font-weight: 700;
}

/* ── Summary Actions ── */

.summary-actions {
    display: flex;
    flex-direction: column;
    gap: 12px;
    margin-top: 20px;
}

.btn-continue {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 12px 24px;
    border: 2px solid #e0e0e0;
    border-radius: 40px;
    background: transparent;
    color: #555;
    text-decoration: none;
    font-size: 15px;
    font-weight: 500;
    transition: all 0.3s ease;
    font-family: 'Poppins', sans-serif;
}

.btn-continue:hover {
    background: #f0f0f0;
}

.btn-checkout {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 14px 32px;
    border: none;
    border-radius: 40px;
    background: linear-gradient(90deg, #1d46da, #17358c);
    color: #fff;
    text-decoration: none;
    font-size: 16px;
    font-weight: 600;
    transition: all 0.3s ease;
    font-family: 'Poppins', sans-serif;
}

.btn-checkout:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 30px rgba(23, 58, 141, 0.3);
}

.btn-checkout i {
    font-size: 14px;
    transition: transform 0.3s ease;
}

.btn-checkout:hover i {
    transform: translateX(4px);
}

/*============================================
    RESPONSIVE
============================================*/

@media (max-width: 992px) {
    .cart-item {
        grid-template-columns: 80px 1fr 140px;
        gap: 16px;
    }

    .cart-item-image {
        height: 80px;
    }

    .cart-item-details h3 {
        font-size: 16px;
    }

    .item-subtotal {
        font-size: 18px;
    }

    .cart-summary {
        max-width: 100%;
        margin-left: 0;
    }
}

@media (max-width: 768px) {
    .cart-section {
        padding: 40px 5% 60px;
    }

    .cart-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
    }

    .cart-header h2 {
        font-size: 26px;
    }

    .cart-item {
        grid-template-columns: 1fr;
        gap: 12px;
        text-align: center;
        padding: 16px 0;
    }

    .cart-item-image {
        height: 120px;
        max-width: 200px;
        margin: 0 auto;
    }

    .cart-item-details h3 {
        font-size: 17px;
    }

    .item-actions {
        justify-content: center;
    }

    .cart-item-price {
        text-align: center;
    }

    .cart-summary {
        padding: 24px 20px;
    }

    .summary-actions {
        flex-direction: column;
    }

    .btn-continue,
    .btn-checkout {
        width: 100%;
        justify-content: center;
    }

    .cart-item-count {
        font-size: 13px;
        padding: 4px 14px;
    }
}

@media (max-width: 480px) {
    .cart-section {
        padding: 30px 4% 50px;
    }

    .cart-header h2 {
        font-size: 22px;
    }

    .cart-item-image {
        height: 100px;
        max-width: 150px;
    }

    .item-actions {
        flex-wrap: wrap;
        gap: 10px;
    }

    .quantity-control {
        padding: 2px 6px;
    }

    .qty-btn {
        width: 24px;
        height: 24px;
        font-size: 14px;
    }

    .remove-btn {
        font-size: 13px;
    }

    .cart-summary {
        padding: 20px 16px;
    }

    .summary-row {
        font-size: 14px;
    }

    .summary-row.total {
        font-size: 18px;
    }

    .btn-checkout {
        font-size: 14px;
        padding: 12px 24px;
    }

    .btn-continue {
        font-size: 13px;
        padding: 10px 18px;
    }
}

/*============================================
    DARK MODE STYLES
============================================*/

:global(.dark) .cart-section {
    background: #0a1628;
}

:global(.dark) .cart-header {
    border-bottom-color: #2a3a5a;
}

:global(.dark) .cart-header h2 {
    color: #ffffff;
}

:global(.dark) .cart-item-count {
    background: #1a2a4a;
    color: #9ca3af;
}

:global(.dark) .cart-item {
    border-bottom-color: #2a3a5a;
}

:global(.dark) .cart-item-image {
    background: #1a2a4a;
}

:global(.dark) .cart-item-details h3 {
    color: #ffffff;
}

:global(.dark) .item-description {
    color: #9ca3af;
}

:global(.dark) .quantity-control {
    border-color: #2a3a5a;
}

:global(.dark) .qty-btn {
    background: #1a2a4a;
    color: #d1d5db;
}

:global(.dark) .qty-btn:hover:not(:disabled) {
    background: #2a3a5a;
}

:global(.dark) .qty-btn:disabled {
    opacity: 0.3;
}

:global(.dark) .qty-number {
    color: #d1d5db;
}

:global(.dark) .remove-btn {
    color: #6b7280;
}

:global(.dark) .remove-btn:hover {
    color: #f87171;
}

:global(.dark) .item-price {
    color: #6b7280;
}

:global(.dark) .item-subtotal {
    color: #4a7a9c;
}

:global(.dark) .cart-summary {
    background: #1a2a4a;
}

:global(.dark) .summary-header h3 {
    color: #ffffff;
    border-bottom-color: #2a3a5a;
}

:global(.dark) .summary-row {
    color: #9ca3af;
}

:global(.dark) .summary-divider {
    border-top-color: #2a3a5a;
}

:global(.dark) .summary-row.total {
    color: #ffffff;
}

:global(.dark) .summary-row.total .summary-amount {
    color: #4a7a9c;
}

:global(.dark) .btn-continue {
    border-color: #2a3a5a;
    color: #9ca3af;
}

:global(.dark) .btn-continue:hover {
    background: #2a3a5a;
}

:global(.dark) .btn-checkout {
    background: linear-gradient(90deg, #1f47d8, #1a2a4a);
}

:global(.dark) .btn-checkout:hover {
    box-shadow: 0 8px 30px rgba(31, 71, 216, 0.4);
}

:global(.dark) .empty-cart-icon {
    color: #4b5563;
}

:global(.dark) .empty-cart h3 {
    color: #ffffff;
}

:global(.dark) .empty-cart p {
    color: #9ca3af;
}

:global(.dark) .btn-shop {
    background: #1f47d8;
}

:global(.dark) .btn-shop:hover {
    background: #2a5ae8;
    box-shadow: 0 8px 30px rgba(31, 71, 216, 0.4);
}
</style>