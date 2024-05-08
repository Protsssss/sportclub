<?php
session_start();

// Підключення до бази даних
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_sport";

// Створення з'єднання
$conn = new mysqli($servername, $username, $password, $dbname);

// Перевірка з'єднання
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Отримання даних з форми
$product_name = $_POST['product-name'];
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$delivery = $_POST['delivery'];
$quantity = $_POST['quantity'];
$address = isset($_POST['address']) ? $_POST['address'] : ''; // Перевірка наявності адреси
$card = $_POST['card'];
$additional_info = $_POST['additional-info'];
$total_price = floatval(str_replace(['₴', ','], ['', ''], $_POST['total_price']));

// Підготовка запиту з використанням параметрів
$sql = "INSERT INTO shop_purchases (product_name, name, email, phone, delivery, quantity, address, card, additional_info, total_price) 
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

// Підготовка і виконання запиту з параметрами
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssissss", $product_name, $name, $email, $phone, $delivery, $quantity, $address, $card, $additional_info, $total_price);

if ($stmt->execute()) {
    
    // Якщо дані успішно збережені, перенаправляємо користувача на головну сторінку
    header("Location: index.html?purchase=success");
    exit();
} else {
    // Повідомлення про помилку
    echo "Error: " . $stmt->error;
}

// Закриття з'єднання
$conn->close();
?>