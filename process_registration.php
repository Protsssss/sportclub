<?php
// Підключення до бази даних
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_sport";

$conn = new mysqli($servername, $username, $password, $dbname);

// Перевірка з'єднання
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Обробка реєстрації
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Хешуємо пароль
    $email = $_POST['email'];
    
    // Додаємо користувача до бази даних
    $sql = "INSERT INTO clients (username, password, email) VALUES ('$username', '$password', '$email')";

    if ($conn->query($sql) === TRUE) {
        
        // Редірект на сторінку login.php після успішної реєстрації
        header("Location: login.php");
        exit; 
    } else {
        // Повідомлення про помилку
        echo "Помилка: " . $sql . "<br>" . $conn->error;
    }
}

// Закриття з'єднання
$conn->close();
?>
