<?php
session_start();

// Перевірка, чи тренер авторизований
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Перевірка ролі користувача
if ($_SESSION['role'] !== 'admin') { 
    echo "У вас недостатньо прав для перегляду цієї сторінки."; // Якщо роль нижчого класу
    exit();
}

// Підключення до бази даних
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_sport";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Обробка відправленої форми редагування
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $height = $_POST['height'];
    $weight = $_POST['weight'];
    $subscription = $_POST['subscription'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $role = $_POST['role'];
    $trainer_type = $_POST['trainer_type'];
    $full_name = $_POST['full_name'];

    // Оновлення даних користувача в базі даних
    $sql_update = "UPDATE clients SET height='$height', weight='$weight', email='$email', subscription='$subscription', username='$username', role='$role', trainer_type='$trainer_type', full_name='$full_name' WHERE id='$id'";
    if ($conn->query($sql_update) === TRUE) {
        header("Location: admin_dashboard.php");
        exit(); // Важливо викликати exit() після перенаправлення, щоб гарантувати зупинку виконання подальшого коду
    } else {
        // Повідомлення про помилку
        echo "Помилка оновлення даних: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="ua">
<head>
    <meta charset="UTF-8">
    <title>Admin DB</title>
    <link rel="stylesheet" href="code/style/style_dashboard_admin.css"> <!-- Посилання на файл стилів -->
</head>
<body>
    <!-- Заголовок та меню -->
    <header class="header" id="header">
        <lion class="lion">
            <a href="#" class="lion__logo">
                <!-- Створює гіперпосилання яке містить іконку та текст "LION." -->
                <i class="fas fa-hiking"></i>LION.
            </a>
            <div class="container">
                <!-- Відкриває контейнер для головного вмісту сторінки -->
                <main>
                    <!-- Відкриває контейнер для групи кнопок -->
                    <div class="button-group">
                        <!-- Створює гіперпосилання на сторінку "dashboard.php" -->
                        <a href="dashboard.php">
                            <button class="btn" id="btn1">Особистий кабінет</button>
                        </a>
                    </div>
                    <div class="button-group">
                        <a href="index.html">
                            <!-- Створює гіперпосилання на сторінку "index.html" -->
                            <button class="btn" id="btn4">Головна сторінка</button>
                        </a>
                    </div>
                    <div class="button-group">
                        <a href="contact_requests.php">
                            <!-- Створює гіперпосилання на сторінку "contact_requests.php" -->
                            <button class="btn" id="btn4">Запити</button>
                        </a>
                    </div>
                </main>
            </div>

            <!-- Підключає зовнішній JavaScript-файл для анімації -->
            <script src="script_button.js"></script>
        </lion>
    </header>

    <br><br><br> 
    <header> 
        <h1>БД</h1> 
    </header> 
    <br>

    <?php
    // Запит до бази даних для отримання списку користувачів з рівнем "client"
    $sqlClient = "SELECT username, email, full_name, height, weight, subscription, trainer_type, id FROM clients WHERE role='client'";
    $resultClient = $conn->query($sqlClient);

    // Запит до бази даних для отримання списку користувачів з рівнем "trainer"
    $sqlTrainer = "SELECT username, email, full_name, height, weight, subscription, trainer_type, id FROM clients WHERE role='trainer'";
    $resultTrainer = $conn->query($sqlTrainer);

    // Запит до бази даних для отримання списку користувачів з рівнем "trainer_edit"
    $sqlTrainerEdit = "SELECT username, email, full_name, height, weight, subscription, trainer_type, id FROM clients WHERE role='trainer_edit'";
    $resultTrainerEdit = $conn->query($sqlTrainerEdit);

    // Запит до бази даних для отримання списку користувачів з рівнем "admin"
    $sqlAdmin = "SELECT username, email, full_name, height, weight, subscription, trainer_type, id FROM clients WHERE role='admin'";
    $resultAdmin = $conn->query($sqlAdmin);
    
    // Запит до бази даних для отримання списку клієнтів та їх тренерів
    $sqlRelationships = "SELECT c.username AS client_username, c.full_name AS client_name, t.username AS trainer_username, t.full_name AS trainer_name, ctr.client_id, ctr.trainer_id
    FROM client_trainer_relationships ctr
    JOIN clients c ON ctr.client_id = c.id
    JOIN clients t ON ctr.trainer_id = t.id";
    $resultRelationships = $conn->query($sqlRelationships);

    // ВИВЕДЕННЯ РІЗНИХ ТИПІВ КОРИСТУВАЧІВ client, trainer, trainer_edit, admin

    // client
    echo "<h2>Список користувачів з роллю 'client':</h2>";
    echo "<table border='1'>";
    // Виведення заголовків стовпців таблиці
    echo "<tr><th>ПІБ</th><th>Зріст</th><th>Вага</th><th>Тип абонементу</th><th>Тип тренувань</th><th>Пошта</th><th>Логін</th><th>ID</th></tr>";
    // Цикл для виведення даних кожного рядка
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

    // trainer
    echo "<h2>Список користувачів з роллю 'trainer':</h2>";
    echo "<table border='1'>";
    // Виведення заголовків стовпців таблиці
    echo "<tr><th>ПІБ</th><th>Зріст</th><th>Вага</th><th>Тип абонементу</th><th>Тип тренувань</th><th>Пошта</th><th>Логін</th><th>ID</th></tr>";
    // Цикл для виведення даних кожного рядка
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

    // trainer_edit
    echo "<h2>Список користувачів з роллю 'trainer_edit':</h2>";
    echo "<table border='1'>";
    // Виведення заголовків стовпців таблиці
    echo "<tr><th>ПІБ</th><th>Зріст</th><th>Вага</th><th>Тип абонементу</th><th>Тип тренувань</th><th>Пошта</th><th>Логін</th><th>ID</th></tr>";
    // Цикл для виведення даних кожного рядка
    while ($row = $resultTrainerEdit->fetch_assoc()) {
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

    // admin
    echo "<h2>Список користувачів з роллю 'admin':</h2>";
    echo "<table border='1'>";
    // Виведення заголовків стовпців таблиці
    echo "<tr><th>ПІБ</th><th>Зріст</th><th>Вага</th><th>Тип абонементу</th><th>Тип тренувань</th><th>Пошта</th><th>Логін</th><th>ID</th></tr>";
    // Цикл для виведення даних кожного рядка
    while ($row = $resultAdmin->fetch_assoc()) {
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
    
    // Обробка відправленої форми редагування
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST['id'];
        $height = $_POST['height'];
        $weight = $_POST['weight'];
        $subscription = $_POST['subscription'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $role = $_POST['role'];
        $trainer_type = $_POST['trainer_type'];
        $full_name = $_POST['full_name'];

        // Оновлення даних користувача в базі даних
        $sql_update = "UPDATE clients SET height='$height', weight='$weight', email='$email', subscription='$subscription', username='$username', role='$role', trainer_type='$trainer_type', full_name='$full_name' WHERE id='$id'";
        if ($conn->query($sql_update) === TRUE) {
            header("Location: admin_dashboard.php");
            exit(); // Важливо викликати exit() після перенаправлення, щоб гарантувати зупинку виконання подальшого коду
        } else {
            // Повідомлення про помилку
            echo "Помилка оновлення даних: " . $conn->error;
        }
    }

// Запит до бази даних для отримання списку користувачів з рівнем "client"
$sql = "SELECT id, username, email, full_name, height, weight, trainer_type, subscription, role FROM clients WHERE role IN ('client', 'trainer', 'trainer_edit', 'admin')";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Виведення списку користувачів у вигляді таблички з формою для редагування
    echo "<h2>Список користувачів для редагування:</h2>";
    echo "<table border='1'>";
    // Виведення заголовків стовпців таблиці
    echo "<tr><th>ID</th><th>ПІБ</th><th>Роль</th><th>Опції</th></tr>";
    // Цикл для виведення даних кожного рядка
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>{$row['id']}</td>"; // Значення ID виводиться як текст
        echo "<td>";
        echo "<form method='post' action=''>"; // Вкладений тег форми
        echo "<input type='hidden' name='id' value='{$row['id']}'>"; // Приховане поле ID
        echo "<input type='text' name='full_name' value='{$row['full_name']}'>"; // Редаговане поле ПІБ
        echo "</td>";
        echo "<td>";
        echo "<select name='role'>";
        echo "<option value='client' " . ($row['role'] == 'client' ? 'selected' : '') . ">Клієнт</option>";
        echo "<option value='trainer' " . ($row['role'] == 'trainer' ? 'selected' : '') . ">Тренер 1</option>";
        echo "<option value='trainer_edit' " . ($row['role'] == 'trainer_edit' ? 'selected' : '') . ">Тренер 2</option>";
        echo "<option value='admin' " . ($row['role'] == 'admin' ? 'selected' : '') . ">Адміністратор</option>";
        echo "</select>";
        echo "</td>";
        echo "<td>";

        // Вкладений тег форми
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
        echo "<input type='submit' value='Оновити'>";
        echo "</form>"; // Закриття вкладеного тегу форми
        echo "</td>";
        echo "</tr>";
    }
    echo "</table>";
    

} else {
    // Повідомлення про помилку
    echo "Немає користувачів.";
}

    // Отримання даних про зв'язки клієнтів із тренерами з бази даних
    $sqlRelationships = "SELECT ctr.client_id, ctr.trainer_id, c.full_name AS client_name, c.username AS client_username, t.full_name AS trainer_name, t.username AS trainer_username
                        FROM client_trainer_relationships ctr
                        JOIN clients c ON ctr.client_id = c.id
                        JOIN clients t ON ctr.trainer_id = t.id";
    $resultClientTrainerRelationships = $conn->query($sqlRelationships);

    // Виведення таблиці зв'язків між клієнтами та тренерами
    echo "<h2>Зв'язки між клієнтами та тренерами:</h2>";
    echo "<table border='1'>";
    echo "<tr><th>Клієнт (роль)</th><th>Тренер (роль)</th><th>Опції</th></tr>";
    while ($row = $resultClientTrainerRelationships->fetch_assoc()) {
        echo "<tr>";
        echo "<td>{$row['client_name']} ({$row['client_username']})</td>";
        echo "<td>{$row['trainer_name']} ({$row['trainer_username']})</td>";
        echo "<td>";
        echo "<form method='post' action=''>";
        echo "<input type='hidden' name='client_id' value='{$row['client_id']}'>";
        echo "<input type='hidden' name='trainer_id' value='{$row['trainer_id']}'>";
        echo "<select name='new_trainer_id'>";
        
        // Запит до бази даних для отримання списку всіх тренерів
        $sqlTrainers = "SELECT id, full_name FROM clients WHERE role IN ('trainer', 'trainer_edit', 'admin')";
        $resultTrainers = $conn->query($sqlTrainers);
        // Виведення варіантів вибору тренера
        while ($trainer = $resultTrainers->fetch_assoc()) {
            $selected = ($trainer['id'] == $row['trainer_id']) ? "selected" : "";
            echo "<option value='{$trainer['id']}' $selected>{$trainer['full_name']}</option>";
        }
        echo "</select>"; 
        echo "<input type='submit' value='Оновити'>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";
    }
    echo "</table>";

    // Обробка відправленої форми оновлення
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['client_id']) && isset($_POST['trainer_id']) && isset($_POST['new_trainer_id'])) {
        $client_id = $_POST['client_id'];
        $trainer_id = $_POST['trainer_id'];
        $new_trainer_id = $_POST['new_trainer_id'];

        // Оновлення зв'язку в базі даних
        $sql_update = "UPDATE client_trainer_relationships SET trainer_id='$new_trainer_id' WHERE client_id='$client_id' AND trainer_id='$trainer_id'";
        if ($conn->query($sql_update) === TRUE) {
            header("Location: admin_dashboard.php");
            exit();
        } else {
            echo "Помилка оновлення зв'язку: " . $conn->error;
        }
    }



// Видалення користувачів по ID з бази даних
echo "<h2>Видалення користувача по ID</h2>";
echo "<form method='post' action='delete_user.php'>";
echo "<label for='delete_id'>ID користувача:</label><br>";
echo "<input type='text' id='delete_id' name='delete_id'><br><br>";
echo "<input type='submit' value='Видалити'>";
echo "</form>";

// Обробка відправленої форми видалення
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];

    // Запит на видалення користувача з бази даних
    $sql_delete = "DELETE FROM clients WHERE id='$delete_id'";
    if ($conn->query($sql_delete) === TRUE) {
        // Перенаправлення на сторінку admin_dashboard.php після видалення
        header("Location: admin_dashboard.php?success=true");
        exit(); // Важливо викликати exit() після перенаправлення, щоб гарантувати зупинку виконання подальшого коду
    } else {
        echo "Помилка видалення користувача: " . $conn->error;
    }
}

// Виведення повідомлення про успішне видалення
if (isset($_GET['success']) && $_GET['success'] == 'true') {
    echo "<p>Інформацію про користувача успішно видалено з БД, сторінка буде перезавантажена через 5 секунд.</p>";
    // Перенаправлення на сторінку admin_dashboard.php через JavaScript через 5 секунд
    echo "<script>setTimeout(function(){window.location.href='admin_dashboard.php';}, 5000);</script>";
}

// Закриття з'єднання з базою даних
    $conn->close();
    ?>

<!-- Оновлення сторінки -->
<script>
function reloadPage() {
    // Отримання форми
    var form = document.getElementById("updateForm");
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

<!-- Анімація у формі -->
<script src="script_button.js"></script>

</body>
</html>