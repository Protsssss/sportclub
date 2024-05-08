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
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$card = $_POST['card'];
$additionalInfo = $_POST['additional-info'];
$abonementType = $_POST['abonement-type'];

// Підготовка запиту з використанням параметрів
$sql = "INSERT INTO purchases (name, email, phone, card, additional_info, abonement_type, purchase_date) 
VALUES (?, ?, ?, ?, ?, ?, NOW())"; // Додано NOW() для purchase_date

// Підготовка і виконання запиту з параметрами
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssss", $name, $email, $phone, $card, $additionalInfo, $abonementType);

if ($stmt->execute()) {

    // Якщо дані успішно збережені, перенаправляємо користувача на головну сторінку
    header("Location: index.html");
    exit();
} else {
    // Повідомлення про помилку
    echo "Error: " . $stmt->error;
}

// Закриття з'єднання
$conn->close();
?>
