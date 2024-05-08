<!DOCTYPE html>
<html lang="ua">
<head>
    <meta charset="UTF-8">
    <title>Список користувачів</title>
    <link rel="stylesheet" href="code/style/style_dashboard.css"> <!-- Посилання на файл стилів -->
</head>


<!-- Тіло сторінки -->
<body>

<!-- Заголовок та меню -->
<header class="header" id="header">
  <lion class="lion">
    <a href="#" class="lion__logo"> 
      <!-- Створює гіперпосилання яке містить іконку та текст "LION." -->  
      <i class="fas fa-hiking"></i>LION.</a>
      <div class="container">

        <!-- Відкриває контейнер для головного вмісту сторінки -->
        <main>
        <!-- Відкриває контейнер для групи кнопок -->
          <div class="button-group">
            <!-- Створює гіперпосилання на сторінку "dashboard.php" -->
            <a href="dashboard.php"><button class="btn" id="btn1">Особистий кабінет</button></a>
          </div>
          <div class="button-group">
            <!-- Створює гіперпосилання на сторінку "index.html" -->
            <a href="index.html"><button class="btn" id="btn4">Головна сторінка</button></a>
          </div>
          <div class="button-group">
            <a href="contact_requests.php">
              <!-- Створює гіперпосилання на сторінку "contact_requests.php" -->
              <button class="btn" id="btn4">Запити</button></a>
          </div>

        </main>
      </div>
      
      <!-- Підключає зовнішній JavaScript-файл для анімації -->
      <script src="script_button.js"></script>
    </lion>
  </header>
</body>
    
<body> 
<br><br><br> <header> <h1>БД</h1> </header> <br>
</body>

<body>
    <?php
    session_start();

    // Перевірка, чи тренер авторизований
    if (!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit();
    }

    // Перевірка ролі користувача
    if ($_SESSION['role'] !== 'trainer') {
        echo "У вас недостатньо прав для перегляду цієї сторінки.";
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

    // Запит до бази даних для отримання списку користувачів з рівнем "client"
    $sql = "SELECT username, email, full_name, height, weight, subscription, trainer_type, id FROM clients WHERE role='client'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
    
    // Виведення таблиці зв'язків між клієнтами та їх тренерами
    echo "<h2>Список користувачів:</h2>";
    echo "<table border='1'>";
    // Виведення заголовків стовпців таблиці
    echo "<tr><th>ПІБ</th><th>Зріст</th><th>Вага</th><th>Тип абонементу</th><th>Тип тренувань</th><th>Пошта</th><th>Логін</th><th>ID</th></tr>";
    // Цикл для виведення даних кожного рядка
    while ($row = $result->fetch_assoc()) {
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
} else {
  // Повідомлення про помилку
    echo "Немає користувачів з рівнем 'client'.";
}

// Закриття з'єднання з базою даних
$conn->close();
?>
</body>
</html>