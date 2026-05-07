<?php
session_start();

// Initialize cart if empty
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

if (isset($_POST['add_to_cart'])) {
    header('Content-Type: application/json');

    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];

    $exists = false;
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['id'] == $product_id) {
            $item['quantity']++;
            $exists = true;
            break;
        }
    }

    if (!$exists) {
        $_SESSION['cart'][] = array(
            'id' => $product_id,
            'name' => $product_name,
            'price' => $product_price,
            'image' => $product_image,
            'quantity' => 1
        );
    }

    // Send a JSON response back to JavaScript
    echo json_encode([
        'status' => 'success',
        'cart_count' => count($_SESSION['cart'])
    ]);
    exit();
}

if (isset($_GET['remove'])) {
    $remove_id = $_GET['remove'];

    $_SESSION['cart'] = array_values(array_filter($_SESSION['cart'], function ($item) use ($remove_id) {
        return $item['id'] != $remove_id;
    }));

    header("Location: cart.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');
    echo json_encode(['status' => 'error', 'message' => 'No data received']);
}
