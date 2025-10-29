<?php
require_once 'config.php';

// Only allow POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit();
}

// Get the raw POST data
$input = file_get_contents('php://input');
$order_data = json_decode($input, true);

// Validate the order data
if (!$order_data || !isset($order_data['customer_email']) || !isset($order_data['items']) || !isset($order_data['total'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Invalid order data']);
    exit();
}

try {
    // Save the order
    $result = save_order($order_data);
    
    if ($result) {
        // Log the order
        log_activity("Order placed: {$order_data['order_id']} by {$order_data['customer_email']} - Total: ₹{$order_data['total']}");
        
        echo json_encode(['success' => true, 'message' => 'Order saved successfully']);
    } else {
        throw new Exception('Failed to save order to file');
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>