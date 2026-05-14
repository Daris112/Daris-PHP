<?php
session_start();
require_once 'admin/includes/connect.php';

// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Adjust these paths to where your PHPMailer folder is located
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_SESSION['cart'])) {
    $full_name = htmlspecialchars($_POST['full_name']);
    $email = htmlspecialchars($_POST['email']);
    $address = htmlspecialchars($_POST['address']);
    $city = htmlspecialchars($_POST['city']);
    
    $total_amount = 0;
    foreach($_SESSION['cart'] as $item) {
        $total_amount += $item['price'] * $item['quantity'];
    }

    try {
        $pdo->beginTransaction();

        // 1. Save Order to Database
        $stmt = $pdo->prepare("INSERT INTO orders (user_id, total_amount, shipping_address, status) VALUES (?, ?, ?, 'pending')");
        $stmt->execute([$_SESSION['user_id'] ?? null, $total_amount, "$full_name, $address, $city"]);
        $order_id = $pdo->lastInsertId();

        $itemStmt = $pdo->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
        foreach ($_SESSION['cart'] as $item) {
            $itemStmt->execute([$order_id, $item['id'], $item['quantity'], $item['price']]);
        }

        $pdo->commit();

        // 2. SEND EMAIL VIA PHPMAILER
        $mail = new PHPMailer(true);

        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';         // Use 'sandbox.smtp.mailtrap.io' for testing
        $mail->SMTPAuth   = true;
        $mail->Username   = 'darishodza12@gmail.com';   // Your email
        $mail->Password   = 'zfeb hnns vstr gwci';      // Your Gmail App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Recipients
        $mail->setFrom('darishodza12@gmail.com', 'MAISON Official');
        $mail->addAddress($email, $full_name);

        // Content
        $mail->isHTML(true);
        $mail->Subject = "Order Confirmation #$order_id | MAISON";
        
        // A simple HTML Template
        $mail->Body = "
            <div style='font-family: Arial, sans-serif; max-width: 600px; border: 1px solid #eee; padding: 20px;'>
                <h2 style='text-align: center; letter-spacing: 2px;'>MAISON</h2>
                <p>Hi $full_name,</p>
                <p>Thank you for shopping with us. We've received your order and are getting it ready for shipment.</p>
                <hr style='border:none; border-top: 1px solid #eee;'>
                <p><strong>Order ID:</strong> #$order_id</p>
                <p><strong>Total Amount:</strong> $" . number_format($total_amount, 2) . "</p>
                <p><strong>Shipping to:</strong> $address, $city</p>
                <hr style='border:none; border-top: 1px solid #eee;'>
                <p style='font-size: 12px; color: #888;'>If you have any questions, reply to this email.</p>
            </div>
        ";

        $mail->send();

        // 3. Success and Cleanup
        unset($_SESSION['cart']);
        header("Location: success.php?order=" . $order_id);
        exit();

    } catch (\Throwable $e) {
        if ($pdo->inTransaction()) {
            $pdo->rollBack();
        }
        $errorInfo = isset($mail) ? $mail->ErrorInfo : $e->getMessage();
        echo "Checkout could not be completed. Error: " . htmlspecialchars($errorInfo);
    }
}

header("Location: cart.php");
exit();
