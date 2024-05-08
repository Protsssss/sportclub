<!DOCTYPE html>
<html lang="ua">
<head>
    <meta charset="UTF-8">
    <title>Список користувачів</title>
    <link rel="stylesheet" href="code/style/style_dashboard.css"> <!-- Посилання на файл стилів -->
</head>

<body>

<header class="header" id="header">
    <lion class="lion">
        <a href="#" class="lion__logo"> 
            <i class="fas fa-hiking"></i>LION.</a>
        <div class="container">
            <main>
                <div class="button-group">
                    <a href="dashboard.php">
                        <button class="btn" id="btn1">Особистий кабінет</button>
                    </a>
                </div>
                <div class="button-group">
                    <a href="index.html">
                        <button class="btn" id="btn4">Головна сторінка</button>
                    </a>
                </div>
                <div class="button-group">
                    <a href="contact_requests.php">
                        <button class="btn" id="btn4">Запити</button>
                    </a>
                </div>
            </main>
        </div>
        <script src="script_button.js"></script>
    </lion>
</header>

<br><br><br> 
<header> 
    <h1>БД</h1> 
</header> 
<br>

<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if ($_SESSION['role'] !== 'trainer_edit') {
    echo "У вас недостатньо прав для перегляду цієї сторінки.";
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_sport";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sqlClient = "SELECT username, email, full_name, height, weight, subscription, trainer_type, id FROM clients WHERE role='client'";
$resultClient = $conn->query($sqlClient);

$sqlTrainer = "SELECT username, email, full_name, height, weight, subscription, trainer_type, id FROM clients WHERE role='trainer'";
$resultTrainer = $conn->query($sqlTrainer);

echo "<h2>Список користувачів з роллю 'client':</h2>";
echo "<table border='1'>";
echo "<tr><th>ПІБ</th><th>Зріст</th><th>Вага</th><th>Тип абонементу</th><th>Тип тренувань</th><th>Пошта</th><th>Логін</th><th>ID</th></tr>";
while ($row = $resultClient->fetch_assoc()) {
    echo "<tr>";
    echo "<td>{$row['full_name']}</td>";
    echo "<td>{$row['height']}</td>";
    echo "<td>{$row['weight']}</td>";
    echo "<td>{$row['subscription']}</td>";
    echo "<td>{$row['trainer_type']}</td>";
    echo "<td>{$row['email']}</td>";
    echo "<td>{$row['username']}</td>";
    echo "<td>{$row['id']}</td>";
    echo "</tr>";
}
echo "</table>";

echo "<h2>Список користувачів з роллю 'trainer':</h2>";
echo "<table border='1'>";
echo "<tr><th>ПІБ</th><th>Зріст</th><th>Вага</th><th>Тип абонементу</th><th>Тип тренувань</th><th>Пошта</th><th>Логін</th><th>ID</th></tr>";
while ($row = $resultTrainer->fetch_assoc()) {
    echo "<tr>";
    echo "<td>{$row['full_name']}</td>";
    echo "<td>{$row['height']}</td>";
    echo "<td>{$row['weight']}</td>";
    echo "<td>{$row['subscription']}</td>";
    echo "<td>{$row['trainer_type']}</td>";
    echo "<td>{$row['email']}</td>";
    echo "<td>{$row['username']}</td>";
    echo "<td>{$row['id']}</td>";
    echo "</tr>";
}
echo "</table>";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $height = $_POST['height'];
    $weight = $_POST['weight'];
    $subscription = $_POST['subscription'];
    $trainer_type = $_POST['trainer_type'];

    $sql_update = "UPDATE clients SET full_name='$full_name', username='$username', email='$email', height='$height', weight='$weight', subscription='$subscription', trainer_type='$trainer_type' WHERE id='$id'";
    if ($conn->query($sql_update) === TRUE) {
        echo "<div class='success-message'>Дані користувача успішно оновлено.</div>";
    } else {
        echo "<div class='error-message'>Помилка оновлення даних: " . $conn->error . "</div>";
    }
}

$sql = "SELECT id, username, email, full_name, height, weight, trainer_type, subscription FROM clients WHERE role='client'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Виведення списку користувачів у вигляді таблички з формою для редагування
    echo "<h2>Список користувачів для редагування:</h2>";
    echo "<table border='1'>";
    // Виведення заголовків стовпців таблиці
    echo "<tr><th>ID</th><th>ПІБ</th><th>Опції</th></tr>";
    // Цикл для виведення даних кожного рядка
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>{$row['id']}</td>";
        echo "<td>";
        echo "<form method='post' action='' id='updateForm{$row['id']}'>"; // Додано id='updateForm{$row['id']}'
        echo "<input type='hidden' name='id' value='{$row['id']}'>";
        echo "<input type='text' name='full_name' value='{$row['full_name']}'>";
        echo "</td>";
        echo "<td>";
        echo "username: <input type='text' name='username' value='{$row['username']}'> ";
        echo "Пошта: <input type='text' name='email' value='{$row['email']}'> ";
        echo "Тип абонементу: ";
        echo "<select name='subscription'>";
        echo "<option value='None' " . ($row['subscription'] == 'None' ? 'selected' : '') . "> - </option>";
        echo "<option value='Sport' " . ($row['subscription'] == 'Sport' ? 'selected' : '') . ">Sport</option>";
        echo "<option value='Sport+Pool' " . ($row['subscription'] == 'Sport+Pool' ? 'selected' : '') . ">Sport+Pool</option>";
        echo "<option value='Full' " . ($row['subscription'] == 'Full' ? 'selected' : '') . ">Full</option>";
        echo "<option value='Trainer' " . ($row['subscription'] == 'Trainer' ? 'selected' : '') . ">Trainer</option>";
        echo "</select>";
        echo "Тип тренувань: ";
        echo "<select name='trainer_type'>";
        echo "<option value='Fitness' " . ($row['trainer_type'] == 'Fitness' ? 'selected' : '') . ">Fitness</option>";
        echo "<option value='Sport' " . ($row['trainer_type'] == 'Sport' ? 'selected' : '') . ">Sport</option>";
        echo "<option value='Personal' " . ($row['trainer_type'] == 'Personal' ? 'selected' : '') . ">Personal</option>";
        echo "<option value='Other' " . ($row['trainer_type'] == 'Other' ? 'selected' : '') . ">Other</option>";
        echo "</select>";
        echo "Зріст: <input type='text' name='height' value='{$row['height']}'> ";
        echo "Вага: <input type='text' name='weight' value='{$row['weight']}'> ";
        echo "<input type='button' value='Оновити' id='reloadButton{$row['id']}' name='reloadButton' onclick='reloadPage({$row['id']})'>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Немає користувачів з рівнем 'client'.";
}

$conn->close();
?>

<script>
function reloadPage(id) {
    // Отримання форми
    var form = document.getElementById("updateForm" + id); // Змінено id="updateForm" на id="updateForm" + id

    // Відправлення даних форми на сервер за допомогою AJAX
    var formData = new FormData(form);
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "", true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            // Якщо відправлення даних було успішним, оновіть сторінку
            location.reload();
        } else {
            // Якщо сталася помилка при відправленні даних на сервер, виведіть повідомлення про помилку
            console.error("Помилка при відправленні даних на сервер.");
        }
    };
    xhr.send(formData);
}
</script>

</body>
</html>
