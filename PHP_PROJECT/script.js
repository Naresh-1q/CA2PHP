// JavaScript for interactive elements
document.addEventListener('DOMContentLoaded', function () {
    // Category buttons
    const categoryButtons = document.querySelectorAll('.category-btn');
    const menuCategories = document.querySelectorAll('.menu-category');

    categoryButtons.forEach(button => {
        button.addEventListener('click', function () {
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
    const addToOrderButtons = document.querySelectorAll('.add-to-order');
    const yourOrderBtn = document.getElementById('yourOrderBtn');
    const orderSummary = document.getElementById('orderSummary');
    const closeOrderBtn = document.getElementById('closeOrderBtn');
    const confirmOrderBtn = document.getElementById('confirmOrderBtn');

    let currentOrder = [];

    // Show order summary when "Your Order" button is clicked
    yourOrderBtn.addEventListener('click', function () {
        orderSummary.classList.add('active');
    });

    // Close order summary
    closeOrderBtn.addEventListener('click', function () {
        orderSummary.classList.remove('active');
    });

    // Confirm order
    confirmOrderBtn.addEventListener('click', function () {
        if (currentOrder.length === 0) {
            alert('Please add items to your order first!');
            return;
        }

        alert('Your order has been placed successfully! Total: ' + orderTotal.textContent);
        currentOrder = [];
        updateOrderDisplay();
        orderSummary.classList.remove('active');
    });

    // Add items to order
    addToOrderButtons.forEach(button => {
        button.addEventListener('click', function () {
            const name = this.getAttribute('data-name');
            const price = parseFloat(this.getAttribute('data-price'));

            // Add item to order
            currentOrder.push({ name, price });

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

    function updateOrderDisplay() {
        // Clear current display
        orderItems.innerHTML = '';

        if (currentOrder.length === 0) {
            orderItems.innerHTML = '<div class="empty-order">No items added yet</div>';
            orderTotal.textContent = '₹0.00';
            return;
        }

        // Calculate total
        let total = 0;

        // Add each item to display
        currentOrder.forEach((item, index) => {
            total += item.price;

            const orderItem = document.createElement('div');
            orderItem.className = 'order-item';
            orderItem.innerHTML = `
                        <div class="order-item-info">
                            <div class="order-item-name">${item.name}</div>
                            <div class="order-item-price">₹${item.price.toFixed(2)}</div>
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
            button.addEventListener('click', function () {
                const index = parseInt(this.getAttribute('data-index'));
                deleteOrderItem(index);
            });
        });

        // Update total
        orderTotal.textContent = `₹${total.toFixed(2)}`;
    }
});
