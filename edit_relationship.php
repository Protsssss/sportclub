<?php
    // Підключення до бази даних
    $servername = "localhost"; 
    $username = "root";
    $password = "";
    $dbname = "db_sport";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Отримання параметрів client_id і trainer_id з URL
    $client_id = $_GET['client_id'];

    // Обробка форми редагування зв'язку між клієнтом і тренером
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $new_trainer_id = $_POST['trainer_id'];

        // Оновлення запису в таблиці client_trainer_relationships
        $sql_update = "UPDATE client_trainer_relationships SET trainer_id='$new_trainer_id' WHERE client_id='$client_id'";
        
        if ($conn->query($sql_update) === TRUE) {
            header("Location: admin_dashboard.php");
            exit();
        } else {
            echo "Помилка оновлення даних: " . $conn->error;
        }
    }

    // Запит до бази даних для отримання списку всіх тренерів
    $sqlTrainers = "SELECT id, full_name FROM clients WHERE role='trainer'";
    $resultTrainers = $conn->query($sqlTrainers);

    // Виведення форми для редагування зв'язку
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редагування зв'язків</title>
</head>
<body>
    <h2>Редагування зв'язку між клієнтом і тренером:</h2>
    <form method="post" action="">
        <label for="trainer_id">Оберіть нового тренера:</label><br>
        <select name="trainer_id" id="trainer_id">
            <?php
            // Вивід варіантів вибору тренера
            while ($row = $resultTrainers->fetch_assoc()) {
                echo "<option value='{$row['id']}'>{$row['full_name']}</option>";
            }
            ?>
        </select>
        <br><br>
        <input type="submit" value="Оновити зв'язок">
    </form>
</body>
</html>
<?php
    // Закриття з'єднання з базою даних
    $conn->close();
?>
