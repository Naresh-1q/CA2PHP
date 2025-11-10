<?php
require_once 'config.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];
$email = $_SESSION['email'];
$login_time = $_SESSION['login_time'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fun  Bytes - Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

:root {
    --primary: #ff6b00;
    --secondary: #ffcc00;
    --dark: #333333;
    --light: #f8f8f8;
    --success: #28a745;
}

/* User Info Bar */
.user-info-bar {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 15px 0;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    position: relative;
    z-index: 101;
}

.user-info-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

.user-details {
    display: flex;
    gap: 20px;
    align-items: center;
    flex-wrap: wrap;
}

.info-item {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 14px;
}

.logout-btn {
    background: rgba(255, 255, 255, 0.2);
    color: white;
    border: 1px solid rgba(255, 255, 255, 0.3);
    padding: 8px 20px;
    border-radius: 20px;
    cursor: pointer;
    transition: all 0.3s;
    text-decoration: none;
    display: inline-block;
}

.logout-btn:hover {
    background: rgba(255, 255, 255, 0.3);
    transform: translateY(-2px);
}

body {
    background-color: #f5f5f5;
    color: var(--dark);
    line-height: 1.6;
}

.container {
    width: 90%;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 15px;
}

header {
    background-color: white;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    position: sticky;
    top: 0;
    z-index: 100;
}

.header-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 0;
}

.logo {
    display: flex;
    align-items: center;
    gap: 10px;
}

.logo i {
    color: var(--primary);
    font-size: 28px;
}

.logo h1 {
    font-size: 24px;
    color: var(--dark);
}

.logo span {
    color: var(--primary);
}

nav ul {
    display: flex;
    list-style: none;
    gap: 25px;
}

nav a {
    text-decoration: none;
    color: var(--dark);
    font-weight: 500;
    transition: color 0.3s;
}

nav a:hover {
    color: var(--primary);
}

.header-actions {
    display: flex;
    gap: 15px;
    align-items: center;
}

.btn {
    padding: 8px 20px;
    border-radius: 30px;
    border: none;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s;
}

.btn-primary {
    background-color: var(--primary);
    color: white;
}

.btn-primary:hover {
    background-color: #e55e00;
    transform: translateY(-2px);
}

.hero {
    background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('https://images.unsplash.com/photo-1571091718767-18b5b1457add?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1172&q=80');
    background-size: cover;
    background-position: center;
    color: white;
    padding: 100px 0;
    text-align: center;
    position: relative;
}

.hero h2 {
    font-size: 3.5rem;
    margin-bottom: 20px;
    font-weight: 700;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
}

.hero p {
    font-size: 1.3rem;
    max-width: 700px;
    margin: 0 auto 40px;
    opacity: 0.9;
    line-height: 1.8;
}

.btn-large {
    padding: 15px 40px;
    font-size: 1.2rem;
    background: var(--primary);
    border: none;
    border-radius: 50px;
    color: white;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s;
    box-shadow: 0 5px 15px rgba(255, 107, 0, 0.3);
}
.btn-large a{
    text-decoration: none;
    color: black;
}
.btn-large:hover {
    background: #e55e00;
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(255, 107, 0, 0.4);
    
}

/* Menu Section */
.section-title {
    text-align: center;
    margin: 80px 0 50px;
    padding: 0 20px;
}

.section-title h2 {
    font-size: 3rem;
    color: var(--dark);
    margin-bottom: 15px;
    font-weight: 700;
}

.section-title p {
    color: #666;
    font-size: 1.2rem;
    max-width: 600px;
    margin: 0 auto;
    line-height: 1.6;
}

.menu-categories {
    display: flex;
    justify-content: center;
    gap: 15px;
    margin-bottom: 50px;
    flex-wrap: wrap;
    padding: 0 20px;
}

.category-btn {
    padding: 12px 25px;
    background-color: white;
    border: 2px solid #e0e0e0;
    border-radius: 30px;
    cursor: pointer;
    transition: all 0.3s;
    font-weight: 600;
    font-size: 1rem;
}

.category-btn.active {
    background-color: var(--primary);
    color: white;
    border-color: var(--primary);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(255, 107, 0, 0.3);
}

.category-btn:hover:not(.active) {
    border-color: var(--primary);
    color: var(--primary);
}

.menu-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 30px;
    margin-bottom: 80px;
    padding: 0 20px;
}

.menu-item {
    background-color: white;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
    position: relative;
}

.menu-item:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
}

.item-image {
    height: 220px;
    width: 100%;
    background-color: #f8f8f8;
    background-size: cover;
    background-position: center;
    transition: transform 0.3s ease;
}

.menu-item:hover .item-image {
    transform: scale(1.05);
}

.item-details {
    padding: 25px;
}

.item-details h3 {
    margin-bottom: 12px;
    font-size: 1.4rem;
    color: var(--dark);
    font-weight: 600;
}

.item-details p {
    color: #666;
    margin-bottom: 20px;
    font-size: 0.95rem;
    line-height: 1.6;
}

.item-price {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.price {
    font-weight: 700;
    font-size: 1.3rem;
    color: var(--primary);
}

.add-to-order {
    background-color: var(--secondary);
    color: var(--dark);
    border: none;
    padding: 10px 20px;
    border-radius: 25px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s;
    font-weight: 600;
    gap: 8px;
}

.add-to-order:hover {
    background-color: var(--primary);
    color: white;
    transform: scale(1.05);
}

/* Order Summary */
.order-summary {
    position: fixed;
    top: 180px;
    right: 20px;
    background-color: white;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    padding: 25px;
    width: 380px;
    z-index: 1000;
    max-height: 500px;
    overflow-y: auto;
    display: none;
    border: 1px solid #e0e0e0;
}

.order-summary.active {
    display: block;
    animation: slideIn 0.3s ease;
}

@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateX(100px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

.order-summary h3 {
    margin-bottom: 20px;
    padding-bottom: 15px;
    border-bottom: 2px solid #eee;
    color: var(--dark);
    font-size: 1.4rem;
    position: sticky;
    top: 0;
    background: white;
    z-index: 1;
    padding-top: 5px;
}

.order-items {
    margin-bottom: 20px;
    max-height: 300px;
    overflow-y: auto;
}

.order-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
    padding-bottom: 15px;
    border-bottom: 1px solid #f0f0f0;
}

.order-item-info {
    flex: 1;
}

.order-item-name {
    font-weight: 600;
    font-size: 1rem;
    margin-bottom: 5px;
}

.order-item-price {
    font-weight: 600;
    color: var(--primary);
    font-size: 1rem;
}

.order-item-quantity {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-top: 8px;
}

.quantity-btn {
    background: #f8f8f8;
    border: 1px solid #ddd;
    width: 28px;
    height: 28px;
    border-radius: 50%;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    transition: all 0.2s;
}

.quantity-btn:hover {
    background: var(--primary);
    color: white;
    border-color: var(--primary);
}

.delete-item {
    background: none;
    border: none;
    color: #ff4444;
    cursor: pointer;
    font-size: 1.1rem;
    transition: all 0.3s;
    padding: 8px;
    border-radius: 50%;
    width: 32px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.delete-item:hover {
    background-color: #ffebee;
    transform: scale(1.1);
}

.order-total {
    display: flex;
    justify-content: space-between;
    font-weight: 700;
    font-size: 1.3rem;
    padding-top: 15px;
    border-top: 2px solid #eee;
    margin-bottom: 20px;
    color: var(--dark);
}

.empty-order {
    text-align: center;
    color: #999;
    padding: 40px 0;
    font-size: 1.1rem;
}

.order-actions {
    display: flex;
    gap: 12px;
    margin-top: 20px;
}

.btn-secondary {
    background-color: #f8f8f8;
    color: var(--dark);
    border: 1px solid #ddd;
}

.btn-secondary:hover {
    background-color: #e8e8e8;
    transform: translateY(-2px);
}

/* Success Modal */
.success-modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.7);
    z-index: 2000;
    justify-content: center;
    align-items: center;
    backdrop-filter: blur(5px);
}

.success-modal.active {
    display: flex;
    animation: fadeIn 0.3s ease;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

.modal-content {
    background: white;
    padding: 40px;
    border-radius: 20px;
    text-align: center;
    max-width: 450px;
    width: 90%;
    box-shadow: 0 20px 50px rgba(0,0,0,0.3);
    transform: scale(0.9);
    animation: scaleIn 0.3s ease forwards;
}

@keyframes scaleIn {
    to { transform: scale(1); }
}

.modal-icon {
    font-size: 4rem;
    color: var(--success);
    margin-bottom: 20px;
}

.modal-content h3 {
    margin-bottom: 15px;
    color: var(--dark);
    font-size: 1.8rem;
    font-weight: 700;
}

.modal-content p {
    margin-bottom: 25px;
    color: #666;
    font-size: 1.1rem;
    line-height: 1.6;
}

/* Footer */
footer {
    background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
    color: white;
    padding: 60px 0 20px;
    margin-top: 50px;
}

.footer-content {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 40px;
    margin-bottom: 40px;
}

.footer-column h3 {
    font-size: 1.4rem;
    margin-bottom: 25px;
    position: relative;
    padding-bottom: 12px;
    font-weight: 600;
}

.footer-column h3::after {
    content: '';
    position: absolute;
    left: 0;
    bottom: 0;
    width: 50px;
    height: 3px;
    background-color: var(--primary);
}

.footer-column p {
    color: #bbb;
    line-height: 1.7;
    margin-bottom: 20px;
}

.footer-column ul {
    list-style: none;
}

.footer-column ul li {
    margin-bottom: 12px;
}

.footer-column a {
    color: #bbb;
    text-decoration: none;
    transition: all 0.3s;
    display: flex;
    align-items: center;
    gap: 10px;
}

.footer-column a:hover {
    color: var(--primary);
    transform: translateX(5px);
}

.copyright {
    text-align: center;
    padding-top: 30px;
    border-top: 1px solid #3a506b;
    color: #bbb;
    font-size: 0.95rem;
}

/* Responsive Styles */
@media (max-width: 1024px) {
    .hero h2 {
        font-size: 3rem;
    }
    
    .menu-grid {
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    }
}

@media (max-width: 768px) {
    .header-container {
        flex-direction: column;
        gap: 20px;
        text-align: center;
    }

    nav ul {
        gap: 20px;
        flex-wrap: wrap;
        justify-content: center;
    }

    .hero {
        padding: 80px 0;
    }

    .hero h2 {
        font-size: 2.5rem;
    }

    .hero p {
        font-size: 1.1rem;
    }

    .section-title h2 {
        font-size: 2.5rem;
    }

    .menu-grid {
        grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
        gap: 25px;
    }

    .order-summary {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 90%;
        max-width: 400px;
        max-height: 80vh;
        right: auto;
    }

    .user-info-content {
        flex-direction: column;
        gap: 15px;
        text-align: center;
    }
}

@media (max-width: 576px) {
    .hero h2 {
        font-size: 2rem;
    }

    .hero p {
        font-size: 1rem;
    }

    .section-title h2 {
        font-size: 2rem;
    }

    .section-title p {
        font-size: 1rem;
    }

    .menu-categories {
        gap: 10px;
    }

    .category-btn {
        padding: 10px 20px;
        font-size: 0.9rem;
    }

    .menu-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }

    .footer-content {
        grid-template-columns: 1fr;
        gap: 30px;
    }
}

/* Menu Category Sections */
.menu-category {
    display: none;
    animation: fadeInUp 0.5s ease;
}

.menu-category.active {
    display: block;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Scrollbar Styling */
.order-items::-webkit-scrollbar {
    width: 6px;
}

.order-items::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
}

.order-items::-webkit-scrollbar-thumb {
    background: var(--primary);
    border-radius: 10px;
}

.order-items::-webkit-scrollbar-thumb:hover {
    background: #e55e00;
}
</style>
</head>
<body>
    <!-- User Info Bar -->
    <div class="user-info-bar">
        <div class="user-info-content">
            <div class="user-details">
                <div class="info-item">
                    <i class="fas fa-user"></i>
                    <span>Welcome, <?php echo htmlspecialchars($username); ?></span>
                </div>
                <div class="info-item">
                    <i class="fas fa-envelope"></i>
                    <span><?php echo htmlspecialchars($email); ?></span>
                </div>
                <div class="info-item">
                    <i class="fas fa-clock"></i>
                    <span>Session: <span id="sessionTimer">0</span>s</span>
                </div>
            </div>
            <a href="logout.php" class="logout-btn">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </div>
    </div>

    <!-- Header -->
    <header>
        <div class="container header-container">
            <div class="logo">
                <i class="fas fa-utensils"></i>
                <h1>Fun<span> Bytes</span></h1>
            </div>
            <nav>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#menuu">Menu</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#about">Contact</a></li>
                </ul>
            </nav>
            <div class="header-actions">
                <button class="btn btn-primary" id="yourOrderBtn">
                    <i class="fas fa-shopping-cart"></i> Your Order 
                    <span id="orderCount" style="margin-left: 5px; background: white; color: var(--primary); border-radius: 50%; width: 20px; height: 20px; display: inline-flex; align-items: center; justify-content: center; font-size: 12px;">0</span>
                </button>
            </div>
        </div>
    </header>

    <!-- Order Summary -->
    <div class="order-summary" id="orderSummary">
        <h3>Your Order</h3>
        <div class="order-items" id="orderItems">
            <div class="empty-order">No items added yet</div>
        </div>
        <div class="order-total">
            <span>Total:</span>
            <span id="orderTotal">₹0.00</span>
        </div>
        <div class="order-actions">
            <button class="btn btn-secondary" id="closeOrderBtn">Close</button>
            <button class="btn btn-primary" id="confirmOrderBtn">Confirm Order</button>
        </div>
    </div>

    <!-- Success Modal -->
    <div class="success-modal" id="successModal">
        <div class="modal-content">
            <div class="modal-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <h3>Order Confirmed!</h3>
            <p>Your order has been successfully placed and saved to our system.</p>
            <p><strong>Order Total: <span id="modalTotal">₹0.00</span></strong></p>
            <button class="btn btn-primary" id="closeModalBtn">Continue Shopping</button>
        </div>
    </div>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <h2>Delicious Fast Food Delivered Fast</h2>
            <p>Enjoy our mouth-watering burgers, crispy fries, tasty noodles, and delicious momos from the comfort of your home</p>
            <button class="btn-large"><a href="#menuu">Order Online</a></button>
        </div>
    </section>

    <!-- Menu Section -->
    <section class="menu" id="menuu">
        <div class="container">
            <div class="section-title">
                <h2>Our Delicious Menu</h2>
                <p>Choose from our wide variety of freshly prepared fast food favorites</p>
            </div>
            <div class="menu-categories">
                <button class="category-btn active" data-category="all">All</button>
                <button class="category-btn" data-category="burgers">Burgers</button>
                <button class="category-btn" data-category="fries">Fries</button>
                <button class="category-btn" data-category="noodles">Noodles</button>
                <button class="category-btn" data-category="momo">Momo</button>
            </div>
            
   <!-- All Items (Default View) -->
            <div class="menu-category active" id="all">
                <div class="menu-grid">
                    <!-- Burgers from Burgers Category -->
                    <div class="menu-item" data-category="burgers">
                        <div class="item-image" style="background-image: url('https://images.unsplash.com/photo-1568901346375-23c9450c58cd?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=999&q=80')"></div>
                        <div class="item-details">
                            <h3>Classic Burger</h3>
                            <p>Juicy patty with lettuce, tomato, and our special sauce</p>
                            <div class="item-price">
                                <span class="price">₹40.0</span>
                                <button class="add-to-order" data-name="Classic Burger" data-price="40.0">
                                    <i class="fas fa-plus"></i> Add to Order
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="menu-item" data-category="burgers">
                        <div class="item-image" style="background-image: url('https://images.unsplash.com/photo-1572802419224-296b0aeee0d9?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1115&q=80')"></div>
                        <div class="item-details">
                            <h3>Classic Double Patty</h3>
                            <p>Double patty with lettuce, tomato and sauce</p>
                            <div class="item-price">
                                <span class="price">₹50.0</span>
                                <button class="add-to-order" data-name="Classic Double Patty" data-price="50.0">
                                    <i class="fas fa-plus"></i> Add to Order
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="menu-item" data-category="burgers">
                        <div class="item-image" style="background-image: url('https://www.food2gotruck.ca/cdn/shop/files/926c2eb7-9b69-4d16-8dcd-6003d2886d6b.jpg?v=1743662128&width=713')"></div>
                        <div class="item-details">
                            <h3>Noodles Burger</h3>
                            <p>Plant-based patty with fresh vegetables and noodles</p>
                            <div class="item-price">
                                <span class="price">₹40.0</span>
                                <button class="add-to-order" data-name="Noodles Burger" data-price="40.0">
                                    <i class="fas fa-plus"></i> Add to Order
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="menu-item" data-category="burgers">
                        <div class="item-image" style="background-image: url('https://upload.wikimedia.org/wikipedia/commons/4/4d/Cheeseburger.jpg')"></div>
                        <div class="item-details">
                            <h3>Cheese Burger</h3>
                            <p>Filled with cheese, patty and sauce in a soft bun</p>
                            <div class="item-price">
                                <span class="price">₹60.0</span>
                                <button class="add-to-order" data-name="Cheese Burger" data-price="60.0">
                                    <i class="fas fa-plus"></i> Add to Order
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Fries from Fries Category -->
                    <div class="menu-item" data-category="fries">
                        <div class="item-image" style="background-image: url('https://images.unsplash.com/photo-1573080496219-bb080dd4f877?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=987&q=80')"></div>
                        <div class="item-details">
                            <h3>Classic Fries</h3>
                            <p>Golden crispy fries with a pinch of salt, perfectly cooked</p>
                            <div class="item-price">
                                <span class="price">₹50.0</span>
                                <button class="add-to-order" data-name="Classic Fries" data-price="50.0">
                                    <i class="fas fa-plus"></i> Add to Order
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="menu-item" data-category="fries">
                        <div class="item-image" style="background-image: url('https://fussfreeflavours.com/wp-content/uploads/2022/06/Peri-Peri-Fries-Featured-500x500.jpg')"></div>
                        <div class="item-details">
                            <h3>Peri-Peri Fries</h3>
                            <p>Crispy fries topped with peri-peri masala</p>
                            <div class="item-price">
                                <span class="price">₹60.0</span>
                                <button class="add-to-order" data-name="Peri-Peri Fries" data-price="60.0">
                                    <i class="fas fa-plus"></i> Add to Order
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="menu-item" data-category="fries">
                        <div class="item-image" style="background-image: url('https://i.ytimg.com/vi/HToinNNWISU/maxresdefault.jpg')"></div>
                        <div class="item-details">
                            <h3>Honey Chilli Fries</h3>
                            <p>Fries topped with cheese, chilli and sour cream</p>
                            <div class="item-price">
                                <span class="price">₹70.0</span>
                                <button class="add-to-order" data-name="Honey Chilli Fries" data-price="70.0">
                                    <i class="fas fa-plus"></i> Add to Order
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="menu-item" data-category="fries">
                        <div class="item-image" style="background-image: url('https://images.getrecipekit.com/20220414214337-sweet_potato_fries_web.webp?aspect_ratio=16:9&quality=90&')"></div>
                        <div class="item-details">
                            <h3>Spicy Fries</h3>
                            <p>Fries seasoned with chilli spices and served with mayo</p>
                            <div class="item-price">
                                <span class="price">₹60.0</span>
                                <button class="add-to-order" data-name="Spicy Fries" data-price="60.0">
                                    <i class="fas fa-plus"></i> Add to Order
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="menu-item" data-category="fries">
                        <div class="item-image" style="background-image: url('https://www.thespruceeats.com/thmb/A-huemxQJh41MFe-2YnKDKmodbA=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/sweet-potato-fries-3061587-hero-01-a8a7c65e49924b9887ab31a78799a43d.jpg')"></div>
                        <div class="item-details">
                            <h3>Sweet Potato Fries</h3>
                            <p>Healthy alternative with sweet potato fries and honey dip</p>
                            <div class="item-price">
                                <span class="price">₹70.0</span>
                                <button class="add-to-order" data-name="Sweet Potato Fries" data-price="70.0">
                                    <i class="fas fa-plus"></i> Add to Order
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Noodles from Noodles Category -->
                    <div class="menu-item" data-category="noodles">
                        <div class="item-image" style="background-image: url('https://c.ndtvimg.com/2024-02/e6841gn_noodles_625x300_09_February_24.jpg?im=FeatureCrop,algorithm=dnn,width=620,height=350?im=FaceCrop,algorithm=dnn,width=1200,height=886')"></div>
                        <div class="item-details">
                            <h3>Veg Noodles</h3>
                            <p>Stir-fried noodles with fresh vegetables</p>
                            <div class="item-price">
                                <span class="price">₹50.0</span>
                                <button class="add-to-order" data-name="Veg Noodles" data-price="50.0">
                                    <i class="fas fa-plus"></i> Add to Order
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="menu-item" data-category="noodles">
                        <div class="item-image" style="background-image: url('https://fuddins.com/wp-content/uploads/2023/03/08d212a72c1cd6c0d8a96485ebb12765.jpg')"></div>
                        <div class="item-details">
                            <h3>Paneer Noodles</h3>
                            <p>Fiery noodles with Paneer and mixed vegetables</p>
                            <div class="item-price">
                                <span class="price">₹70.0</span>
                                <button class="add-to-order" data-name="Paneer Noodles" data-price="70.0">
                                    <i class="fas fa-plus"></i> Add to Order
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="menu-item" data-category="noodles">
                        <div class="item-image" style="background-image: url('https://c.ndtvimg.com/2022-04/sigvgq2g_noodles_625x300_27_April_22.jpg')"></div>
                        <div class="item-details">
                            <h3>Mushroom Noodles</h3>
                            <p>Stir-fried noodles with Mushroom and oriental spices</p>
                            <div class="item-price">
                                <span class="price">₹70.0</span>
                                <button class="add-to-order" data-name="Mushroom Noodles" data-price="70.0">
                                    <i class="fas fa-plus"></i> Add to Order
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="menu-item" data-category="noodles">
                        <div class="item-image" style="background-image: url('https://www.chefkunalkapur.com/wp-content/uploads/2021/12/Veg-Chowmein-scaled.jpg?v=1638771610')"></div>
                        <div class="item-details">
                            <h3>Chilli Garlic Noodles</h3>
                            <p>Soft noodles tossed with Extra chilli sauce and Garlic</p>
                            <div class="item-price">
                                <span class="price">₹70.0</span>
                                <button class="add-to-order" data-name="Chilli Garlic Noodles" data-price="70.0">
                                    <i class="fas fa-plus"></i> Add to Order
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="menu-item" data-category="noodles">
                        <div class="item-image" style="background-image: url('https://images.unsplash.com/photo-1585032226651-759b368d7246?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1592&q=80')"></div>
                        <div class="item-details">
                            <h3>Hakka Noodles</h3>
                            <p>Classic noodles with Chinese Style and spring onions</p>
                            <div class="item-price">
                                <span class="price">₹70.0</span>
                                <button class="add-to-order" data-name="Hakka Noodles" data-price="70.0">
                                    <i class="fas fa-plus"></i> Add to Order
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Momo from Momo Category -->
                    <div class="menu-item" data-category="momo">
                        <div class="item-image" style="background-image: url('https://newhongkong.in/wp-content/uploads/2020/12/Easy-Steamed-Vegetable-Dumplings.jpeg')"></div>
                        <div class="item-details">
                            <h3>Steamed Veg Momo</h3>
                            <p>Delicate steamed Momo filled with vegetable filling</p>
                            <div class="item-price">
                                <span class="price">₹50.0</span>
                                <button class="add-to-order" data-name="Steamed Veg Momo" data-price="50.0">
                                    <i class="fas fa-plus"></i> Add to Order
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="menu-item" data-category="momo">
                        <div class="item-image" style="background-image: url('https://i0.wp.com/bakaasur.com/wp-content/uploads/2022/12/fried-momo-recipe.jpg?resize=780%2C439&ssl=1')"></div>
                        <div class="item-details">
                            <h3>Fried Veg Momo</h3>
                            <p>Crispy fried Momo with vegetable filling, served with spicy sauce</p>
                            <div class="item-price">
                                <span class="price">₹50.0</span>
                                <button class="add-to-order" data-name="Fried Veg Momo" data-price="50.0">
                                    <i class="fas fa-plus"></i> Add to Order
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="menu-item" data-category="momo">
                        <div class="item-image" style="background-image: url('https://www.hindustantimes.com/ht-img/img/2025/02/06/550x309/ccc_1738844487445_1738844504789.jpg')"></div>
                        <div class="item-details">
                            <h3>Spicy Jhol Momo</h3>
                            <p>Steamed momo with spicy vegetables filling and chili sauce</p>
                            <div class="item-price">
                                <span class="price">₹50.0</span>
                                <button class="add-to-order" data-name="Spicy Jhol Momo" data-price="50.0">
                                    <i class="fas fa-plus"></i> Add to Order
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="menu-item" data-category="momo">
                        <div class="item-image" style="background-image: url('https://c.ndtvimg.com/2020-09/2ajd7pe_tandoori-momos_625x300_02_September_20.jpg')"></div>
                        <div class="item-details">
                            <h3>Tandoori Momo</h3>
                            <p>Fried momo in tandoor and vegetable filling</p>
                            <div class="item-price">
                                <span class="price">₹70.0</span>
                                <button class="add-to-order" data-name="Tandoori Momo" data-price="70.0">
                                    <i class="fas fa-plus"></i> Add to Order
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="menu-item" data-category="momo">
                        <div class="item-image" style="background-image: url('https://www.chefkunalkapur.com/wp-content/uploads/2021/07/CW0_7613.jpg?v=1627703755')"></div>
                        <div class="item-details">
                            <h3>Paneer Momo</h3>
                            <p>Steamed momo with Paneer filling inside it.</p>
                            <div class="item-price">
                                <span class="price">₹70.0</span>
                                <button class="add-to-order" data-name="Paneer Momo" data-price="70.0">
                                    <i class="fas fa-plus"></i> Add to Order
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Burgers Category -->
            <div class="menu-category" id="burgers">
                <div class="menu-grid">
                    <div class="menu-item">
                        <div class="item-image" style="background-image: url('https://images.unsplash.com/photo-1568901346375-23c9450c58cd?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=999&q=80')"></div>
                        <div class="item-details">
                            <h3>Classic Burger</h3>
                            <p>Juicy patty with lettuce, tomato, and our special sauce</p>
                            <div class="item-price">
                                <span class="price">₹40.0</span>
                                <button class="add-to-order" data-name="Classic Burger" data-price="40.0">
                                    <i class="fas fa-plus"></i> Add to Order
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="menu-item">
                        <div class="item-image" style="background-image: url('https://images.unsplash.com/photo-1572802419224-296b0aeee0d9?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1115&q=80')"></div>
                        <div class="item-details">
                            <h3>Classic Double Patty</h3>
                            <p>Double patty with lettuce, tomato and sauce</p>
                            <div class="item-price">
                                <span class="price">₹50.0</span>
                                <button class="add-to-order" data-name="Classic Double Patty" data-price="50.0">
                                    <i class="fas fa-plus"></i> Add to Order
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="menu-item">
                        <div class="item-image" style="background-image: url('https://www.food2gotruck.ca/cdn/shop/files/926c2eb7-9b69-4d16-8dcd-6003d2886d6b.jpg?v=1743662128&width=713')"></div>
                        <div class="item-details">
                            <h3>Noodles Burger</h3>
                            <p>Plant-based patty with fresh vegetables and noodles</p>
                            <div class="item-price">
                                <span class="price">₹40.0</span>
                                <button class="add-to-order" data-name="Noodles Burger" data-price="40.0">
                                    <i class="fas fa-plus"></i> Add to Order
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="menu-item">
                        <div class="item-image" style="background-image: url('https://upload.wikimedia.org/wikipedia/commons/4/4d/Cheeseburger.jpg')"></div>
                        <div class="item-details">
                            <h3>Cheese Burger</h3>
                            <p>Filled with cheese, patty and sauce in a soft bun</p>
                            <div class="item-price">
                                <span class="price">₹60.0</span>
                                <button class="add-to-order" data-name="Cheese Burger" data-price="60.0">
                                    <i class="fas fa-plus"></i> Add to Order
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Fries Category -->
            <div class="menu-category" id="fries">
                <div class="menu-grid">
                    <div class="menu-item">
                        <div class="item-image" style="background-image: url('https://images.unsplash.com/photo-1573080496219-bb080dd4f877?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=987&q=80')"></div>
                        <div class="item-details">
                            <h3>Classic Fries</h3>
                            <p>Golden crispy fries with a pinch of salt, perfectly cooked</p>
                            <div class="item-price">
                                <span class="price">₹50.0</span>
                                <button class="add-to-order" data-name="Classic Fries" data-price="50.0">
                                    <i class="fas fa-plus"></i> Add to Order
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="menu-item">
                        <div class="item-image" style="background-image: url('https://fussfreeflavours.com/wp-content/uploads/2022/06/Peri-Peri-Fries-Featured-500x500.jpg')"></div>
                        <div class="item-details">
                            <h3>Peri-Peri Fries</h3>
                            <p>Crispy fries topped with peri-peri masala</p>
                            <div class="item-price">
                                <span class="price">₹60.0</span>
                                <button class="add-to-order" data-name="Peri-Peri Fries" data-price="60.0">
                                    <i class="fas fa-plus"></i> Add to Order
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="menu-item">
                        <div class="item-image" style="background-image: url('https://i.ytimg.com/vi/HToinNNWISU/maxresdefault.jpg')"></div>
                        <div class="item-details">
                            <h3>Honey Chilli Fries</h3>
                            <p>Fries topped with cheese, chilli and sour cream</p>
                            <div class="item-price">
                                <span class="price">₹70.0</span>
                                <button class="add-to-order" data-name="Honey Chilli Fries" data-price="70.0">
                                    <i class="fas fa-plus"></i> Add to Order
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="menu-item">
                        <div class="item-image" style="background-image: url('https://images.getrecipekit.com/20220414214337-sweet_potato_fries_web.webp?aspect_ratio=16:9&quality=90&')"></div>
                        <div class="item-details">
                            <h3>Spicy Fries</h3>
                            <p>Fries seasoned with chilli spices and served with mayo</p>
                            <div class="item-price">
                                <span class="price">₹60.0</span>
                                <button class="add-to-order" data-name="Spicy Fries" data-price="60.0">
                                    <i class="fas fa-plus"></i> Add to Order
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="menu-item">
                        <div class="item-image" style="background-image: url('https://www.thespruceeats.com/thmb/A-huemxQJh41MFe-2YnKDKmodbA=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/sweet-potato-fries-3061587-hero-01-a8a7c65e49924b9887ab31a78799a43d.jpg')"></div>
                        <div class="item-details">
                            <h3>Sweet Potato Fries</h3>
                            <p>Healthy alternative with sweet potato fries and honey dip</p>
                            <div class="item-price">
                                <span class="price">₹70.0</span>
                                <button class="add-to-order" data-name="Sweet Potato Fries" data-price="70.0">
                                    <i class="fas fa-plus"></i> Add to Order
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Noodles Category -->
            <div class="menu-category" id="noodles">
                <div class="menu-grid">
                    <div class="menu-item">
                        <div class="item-image" style="background-image: url('https://c.ndtvimg.com/2024-02/e6841gn_noodles_625x300_09_February_24.jpg?im=FeatureCrop,algorithm=dnn,width=620,height=350?im=FaceCrop,algorithm=dnn,width=1200,height=886')"></div>
                        <div class="item-details">
                            <h3>Veg Noodles</h3>
                            <p>Stir-fried noodles with fresh vegetables</p>
                            <div class="item-price">
                                <span class="price">₹50.0</span>
                                <button class="add-to-order" data-name="Veg Noodles" data-price="50.0">
                                    <i class="fas fa-plus"></i> Add to Order
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="menu-item">
                        <div class="item-image" style="background-image: url('https://fuddins.com/wp-content/uploads/2023/03/08d212a72c1cd6c0d8a96485ebb12765.jpg')"></div>
                        <div class="item-details">
                            <h3>Paneer Noodles</h3>
                            <p>Fiery noodles with Paneer and mixed vegetables</p>
                            <div class="item-price">
                                <span class="price">₹70.0</span>
                                <button class="add-to-order" data-name="Paneer Noodles" data-price="70.0">
                                    <i class="fas fa-plus"></i> Add to Order
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="menu-item">
                        <div class="item-image" style="background-image: url('https://c.ndtvimg.com/2022-04/sigvgq2g_noodles_625x300_27_April_22.jpg')"></div>
                        <div class="item-details">
                            <h3>Mushroom Noodles</h3>
                            <p>Stir-fried noodles with Mushroom and oriental spices</p>
                            <div class="item-price">
                                <span class="price">₹70.0</span>
                                <button class="add-to-order" data-name="Mushroom Noodles" data-price="70.0">
                                    <i class="fas fa-plus"></i> Add to Order
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="menu-item">
                        <div class="item-image" style="background-image: url('https://www.chefkunalkapur.com/wp-content/uploads/2021/12/Veg-Chowmein-scaled.jpg?v=1638771610')"></div>
                        <div class="item-details">
                            <h3>Chilli Garlic Noodles</h3>
                            <p>Soft noodles tossed with Extra chilli sauce and Garlic</p>
                            <div class="item-price">
                                <span class="price">₹70.0</span>
                                <button class="add-to-order" data-name="Chilli Garlic Noodles" data-price="70.0">
                                    <i class="fas fa-plus"></i> Add to Order
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="menu-item">
                        <div class="item-image" style="background-image: url('https://images.unsplash.com/photo-1585032226651-759b368d7246?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1592&q=80')"></div>
                        <div class="item-details">
                            <h3>Hakka Noodles</h3>
                            <p>Classic noodles with Chinese Style and spring onions</p>
                            <div class="item-price">
                                <span class="price">₹70.0</span>
                                <button class="add-to-order" data-name="Hakka Noodles" data-price="70.0">
                                    <i class="fas fa-plus"></i> Add to Order
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Momo Category -->
            <div class="menu-category" id="momo">
                <div class="menu-grid">
                    <div class="menu-item">
                        <div class="item-image" style="background-image: url('https://newhongkong.in/wp-content/uploads/2020/12/Easy-Steamed-Vegetable-Dumplings.jpeg')"></div>
                        <div class="item-details">
                            <h3>Steamed Veg Momo</h3>
                            <p>Delicate steamed Momo filled with vegetable filling</p>
                            <div class="item-price">
                                <span class="price">₹50.0</span>
                                <button class="add-to-order" data-name="Steamed Veg Momo" data-price="50.0">
                                    <i class="fas fa-plus"></i> Add to Order
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="menu-item">
                        <div class="item-image" style="background-image: url('https://i0.wp.com/bakaasur.com/wp-content/uploads/2022/12/fried-momo-recipe.jpg?resize=780%2C439&ssl=1')"></div>
                        <div class="item-details">
                            <h3>Fried Veg Momo</h3>
                            <p>Crispy fried Momo with vegetable filling, served with spicy sauce</p>
                            <div class="item-price">
                                <span class="price">₹50.0</span>
                                <button class="add-to-order" data-name="Fried Veg Momo" data-price="50.0">
                                    <i class="fas fa-plus"></i> Add to Order
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="menu-item">
                        <div class="item-image" style="background-image: url('https://www.hindustantimes.com/ht-img/img/2025/02/06/550x309/ccc_1738844487445_1738844504789.jpg')"></div>
                        <div class="item-details">
                            <h3>Spicy Jhol Momo</h3>
                            <p>Steamed momo with spicy vegetables filling and chili sauce</p>
                            <div class="item-price">
                                <span class="price">₹50.0</span>
                                <button class="add-to-order" data-name="Spicy Jhol Momo" data-price="50.0">
                                    <i class="fas fa-plus"></i> Add to Order
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="menu-item">
                        <div class="item-image" style="background-image: url('https://c.ndtvimg.com/2020-09/2ajd7pe_tandoori-momos_625x300_02_September_20.jpg')"></div>
                        <div class="item-details">
                            <h3>Tandoori Momo</h3>
                            <p>Fried momo in tandoor and vegetable filling</p>
                            <div class="item-price">
                                <span class="price">₹70.0</span>
                                <button class="add-to-order" data-name="Tandoori Momo" data-price="70.0">
                                    <i class="fas fa-plus"></i> Add to Order
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="menu-item">
                        <div class="item-image" style="background-image: url('https://www.chefkunalkapur.com/wp-content/uploads/2021/07/CW0_7613.jpg?v=1627703755')"></div>
                        <div class="item-details">
                            <h3>Paneer Momo</h3>
                            <p>Steamed momo with Paneer filling inside it.</p>
                            <div class="item-price">
                                <span class="price">₹70.0</span>
                                <button class="add-to-order" data-name="Paneer Momo" data-price="70.0">
                                    <i class="fas fa-plus"></i> Add to Order
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Footer -->
    <footer id="about">
        <div class="container">
            <div class="footer-content">
                <div class="footer-column">
                    <h3>Fun Bytes</h3>
                    <p>Serving delicious fast food since 2020. Quality ingredients, great taste, and fast delivery guaranteed.</p>

                </div>
                <div class="footer-column">
                    <h3>Quick Links</h3>
                    <ul>
                        <li><a href="#"><i class="fas fa-chevron-right"></i> Home</a></li>
                        <li><a href="#menuu"><i class="fas fa-chevron-right"></i> Menu</a></li>
                        <li><a href="#about"><i class="fas fa-chevron-right"></i> About Us</a></li>
                        <li><a href="#about"><i class="fas fa-chevron-right"></i> Contact</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h3>Contact Info</h3>
                    <ul>
                        <li><a href="#"><i class="fas fa-map-marker-alt"></i> Building no 34 Canteen Area, LPU, Phagwara</a></li>
                        <li><a href="tel:9034289398"><i class="fas fa-phone"></i> +91 9988952911</a></li>
                        <li><a href="#"><i class="fas fa-clock"></i> Mon-Sun: 9AM - 11PM</a></li>
                    </ul>
                </div>
            </div>
            <div class="copyright">
                <p>&copy; 2025 Fun Bytes. All Rights Reserved. | Designed with <i class="fas fa-heart" style="color: #ff4444;"></i></p>
            </div>
        </div>
    </footer>

    <script>
        // Session timer
        const loginTime = <?php echo $login_time; ?>;
        function updateTimer() {
            const now = Math.floor(Date.now() / 1000);
            const duration = now - loginTime;
            document.getElementById('sessionTimer').textContent = duration;
        }
        setInterval(updateTimer, 1000);
        updateTimer();

        // JavaScript for interactive elements
        document.addEventListener('DOMContentLoaded', function() {
            // Category buttons
            const categoryButtons = document.querySelectorAll('.category-btn');
            const menuCategories = document.querySelectorAll('.menu-category');
            
            categoryButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const category = this.getAttribute('data-category');
                    
                    // Update active button
                    categoryButtons.forEach(btn => btn.classList.remove('active'));
                    this.classList.add('active');
                    
                    // Show selected category
                    menuCategories.forEach(cat => {
                        if (cat.id === category) {
                            cat.classList.add('active');
                        } else {
                            cat.classList.remove('active');
                        }
                    });
                });
            });
            
            // Order management
            const orderItems = document.getElementById('orderItems');
            const orderTotal = document.getElementById('orderTotal');
            const orderCount = document.getElementById('orderCount');
            const addToOrderButtons = document.querySelectorAll('.add-to-order');
            const yourOrderBtn = document.getElementById('yourOrderBtn');
            const orderSummary = document.getElementById('orderSummary');
            const closeOrderBtn = document.getElementById('closeOrderBtn');
            const confirmOrderBtn = document.getElementById('confirmOrderBtn');
            const successModal = document.getElementById('successModal');
            const closeModalBtn = document.getElementById('closeModalBtn');
            const modalTotal = document.getElementById('modalTotal');
            
            let currentOrder = [];
            
            // Show order summary when "Your Order" button is clicked
            yourOrderBtn.addEventListener('click', function() {
                orderSummary.classList.add('active');
            });
            
            // Close order summary
            closeOrderBtn.addEventListener('click', function() {
                orderSummary.classList.remove('active');
            });
            
            // Close success modal
            closeModalBtn.addEventListener('click', function() {
                successModal.classList.remove('active');
            });
            
            // Confirm order
            confirmOrderBtn.addEventListener('click', function() {
                if (currentOrder.length === 0) {
                    alert('Please add items to your order first!');
                    return;
                }
                
                // Calculate total
                const total = currentOrder.reduce((sum, item) => sum + (item.price * item.quantity), 0);
                
                // Prepare order data
                const orderData = {
                    order_id: 'ORD' + Date.now(),
                    customer_name: '<?php echo $username; ?>',
                    customer_email: '<?php echo $email; ?>',
                    items: currentOrder,
                    total: total,
                    order_time: new Date().toISOString(),
                    status: 'confirmed'
                };
                
                // Send order data to server
                fetch('save_order.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(orderData)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Show success modal
                        modalTotal.textContent = '₹' + total.toFixed(2);
                        successModal.classList.add('active');
                        orderSummary.classList.remove('active');
                        
                        // Reset order
                        currentOrder = [];
                        updateOrderDisplay();
                        
                        // Log the order
                        console.log('Order saved:', data);
                    } else {
                        alert('Error saving order: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error saving order. Please try again.');
                });
            });
            
            // Add items to order
            addToOrderButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const name = this.getAttribute('data-name');
                    const price = parseFloat(this.getAttribute('data-price'));
                    
                    // Check if item already exists in order
                    const existingItem = currentOrder.find(item => item.name === name);
                    
                    if (existingItem) {
                        // Increase quantity
                        existingItem.quantity += 1;
                    } else {
                        // Add new item
                        currentOrder.push({
                            name: name,
                            price: price,
                            quantity: 1
                        });
                    }
                    
                    // Update order display
                    updateOrderDisplay();
                    
                    // Simple animation
                    this.style.transform = 'scale(1.05)';
                    setTimeout(() => {
                        this.style.transform = 'scale(1)';
                    }, 200);
                });
            });
            
            // Function to delete an item from the order
            function deleteOrderItem(index) {
                currentOrder.splice(index, 1);
                updateOrderDisplay();
            }
            
            // Function to update item quantity
            function updateQuantity(index, change) {
                const item = currentOrder[index];
                item.quantity += change;
                
                if (item.quantity <= 0) {
                    currentOrder.splice(index, 1);
                }
                
                updateOrderDisplay();
            }
            
            function updateOrderDisplay() {
                // Clear current display
                orderItems.innerHTML = '';
                
                if (currentOrder.length === 0) {
                    orderItems.innerHTML = '<div class="empty-order">No items added yet</div>';
                    orderTotal.textContent = '₹0.00';
                    orderCount.textContent = '0';
                    return;
                }
                
                // Calculate total and item count
                let total = 0;
                let itemCount = 0;
                
                // Add each item to display
                currentOrder.forEach((item, index) => {
                    const itemTotal = item.price * item.quantity;
                    total += itemTotal;
                    itemCount += item.quantity;
                    
                    const orderItem = document.createElement('div');
                    orderItem.className = 'order-item';
                    orderItem.innerHTML = `
                        <div class="order-item-info">
                            <div class="order-item-name">${item.name}</div>
                            <div class="order-item-price">₹${itemTotal.toFixed(2)}</div>
                            <div class="order-item-quantity">
                                <button class="quantity-btn" data-index="${index}" data-change="-1">-</button>
                                <span>${item.quantity}</span>
                                <button class="quantity-btn" data-index="${index}" data-change="1">+</button>
                            </div>
                        </div>
                        <button class="delete-item" data-index="${index}">
                            <i class="fas fa-trash"></i>
                        </button>
                    `;
                    orderItems.appendChild(orderItem);
                });
                
                // Add event listeners to delete buttons
                const deleteButtons = document.querySelectorAll('.delete-item');
                deleteButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        const index = parseInt(this.getAttribute('data-index'));
                        deleteOrderItem(index);
                    });
                });
                
                // Add event listeners to quantity buttons
                const quantityButtons = document.querySelectorAll('.quantity-btn');
                quantityButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        const index = parseInt(this.getAttribute('data-index'));
                        const change = parseInt(this.getAttribute('data-change'));
                        updateQuantity(index, change);
                    });
                });
                
                // Update total and count
                orderTotal.textContent = `₹${total.toFixed(2)}`;
                orderCount.textContent = itemCount;
            }
        });
    </script>
</body>
</html>