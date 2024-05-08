<?php
// Підключення до бази даних
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_sport";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {

    // Перевірка наявності помилок під час з'єднання з базою даних
    die("Connection failed: " . $conn->connect_error);
}

// Обробка відправленої форми видалення
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];

    // Запит на видалення користувача з бази даних
    $sql_delete = "DELETE FROM clients WHERE id='$delete_id'";
    if ($conn->query($sql_delete) === TRUE) {

        // Перенаправлення на сторінку admin_dashboard.php з успішним повідомленням
        header("Location: admin_dashboard.php?success=true");
    } else {

        // Повідомлення про помилку
        echo "Помилка видалення користувача: " . $conn->error;
    }
}

// Закриття з'єднання з базою даних
$conn->close();
?>
