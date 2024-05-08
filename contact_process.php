<?php
session_start();

// Підключення до бази даних
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_sport";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// Обробка відправленої форми зв'язку
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $telephone = $_POST['telephone'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Вставка даних у базу даних
    $sql = "INSERT INTO contact_requests (name, telephone, email, subject, message) VALUES ('$name', '$telephone', '$email', '$subject', '$message')";

    if ($conn->query($sql) === TRUE) {
        echo "Ваш запит успішно відправлено!";
    } else {
        echo "Помилка: " . $sql . "<br>" . $conn->error;
    }
}

// Закриття з'єднання з базою даних
$conn->close();
?>