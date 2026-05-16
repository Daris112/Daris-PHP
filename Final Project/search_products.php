<?php
require_once 'admin/includes/connect.php';
require_once 'includes/product_images.php';

header('Content-Type: application/json');

$query = trim($_GET['q'] ?? '');

if ($query === '') {
    echo json_encode(array());
    exit();
}

try {
    $search = '%' . $query . '%';
    $stmt = $pdo->prepare(
        "SELECT p.id, p.name, p.price, p.image_url, c.name AS category_name
         FROM products p
         LEFT JOIN categories c ON p.category_id = c.id
         WHERE p.name LIKE ? OR p.description LIKE ? OR c.name LIKE ?
         ORDER BY p.name ASC
         LIMIT 6"
    );
    $stmt->execute(array($search, $search, $search));

    $products = $stmt->fetchAll();

    foreach ($products as &$product) {
        $product['image_src'] = product_image_src($product['image_url']);
    }

    echo json_encode($products);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(array('error' => 'Search failed'));
}
