<?php
session_start();

// Перевірка, чи користувач авторизований
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Перевірка ролі користувача
if (!in_array($_SESSION['role'], ['trainer', 'trainer_edit', 'admin'])) {
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

// Перевірка, чи користувач авторизований
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];

// Запит до бази даних, щоб отримати дані користувача
$sql = "SELECT role FROM clients WHERE username='$username'";
$result = $conn->query($sql);

$sql_purchases = "SELECT * FROM purchases";
$result_purchases = $conn->query($sql_purchases);

$sql_shop_purchases = "SELECT * FROM shop_purchases";
$result_shop_purchases = $conn->query($sql_shop_purchases);


if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $role = $row['role']; // Отримуємо роль користувача
} else {
    // Обробка помилки: користувача з таким логіном не знайдено або відсутні дані про роль
    echo "Помилка: користувача з таким логіном не знайдено або відсутні дані про роль";
    exit();
}


// Запит до бази даних для вибору всіх записів з таблиці contact_requests
$sql = "SELECT * FROM contact_requests";
$result = $conn->query($sql);
?>


<!DOCTYPE html>
<html lang="ua">
<link rel="stylesheet" href="code/style/style_dashboard.css"> <!-- Посилання на файл стилів -->
<head>
    <meta charset="UTF-8">
    <title>Список зв'язків</title>
</head>

<body>
  <!-- Логотип та меню -->
<header class="header" id="header">
  <lion class="lion">
    <a href="#" class="lion__logo"> <i class="fas fa-hiking"></i>LION.</a>
    <div class="container">
      <main>

        <!-- Кнопка для переходу до особистого кабінету -->
        <div class="button-group">
          <a href="dashboard.php"><button class="btn" id="btn1">Особистий кабінет</button></a>
        </div>

        <!-- Кнопка для переходу на головну сторінку -->
        <div class="button-group">
          <a href="index.html"><button class="btn" id="btn4">Головна сторінка</button></a>
        </div>
        <?php

        // Перевірка ролі користувача і відображення відповідної кнопки для доступу до бази даних
        if ($role === 'trainer') {
          echo '<div class="button-group"><a href="trainer_dashboard.php"><button class="btn" id="btn2">До Бази Даних</button></a></div>';
        } elseif ($role === 'trainer_edit') {
          echo '<div class="button-group"><a href="trainer_edit_dashboard.php"><button class="btn" id="btn2">До Бази Даних</button></a></div>';
        } elseif ($role === 'admin') {
          echo '<div class="button-group"><a href="admin_dashboard.php"><button class="btn" id="btn2">До Бази Даних</button></a></div>';
        }
        ?>
      </main>
    </div>
  </lion>
</header>

<!-- Підключає зовнішній JavaScript-файл для анімації -->
<script src="script_button.js"></script>
</body>



<!-- Необхідний відступ сторінки -->
<br><br><br><br>

<!-- [1] Заголовок таблиці запитів -->
<h2>Список запитів</h2>

<!-- Таблиця для відображення даних про запити -->
<table>
    <tr>
      <!-- Заголовки стовпців -->
        <th>Дата та час запиту</th>
        <th>ID</th>
        <th>Ім'я</th>
        <th>Телефон</th>
        <th>Електронна пошта</th>
        <th>Тип запиту</th>
        <th>Повідомлення</th>
    </tr>
    
    <?php
    // Перевірка, чи є результати запиту до бази даних
    if ($result->num_rows > 0) {

        // Вивід даних кожного рядка, якщо результати є
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["created_at"] . "</td>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["name"] . "</td>";
            echo "<td>" . $row["telephone"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";
            echo "<td>" . $row["subject"] . "</td>";
            echo "<td>" . $row["message"] . "</td>";
            echo "</tr>";
        }
    } else {
      // Вивід повідомлення про відсутність результатів
        echo "0 results";
    }
    ?>
</table>

<br><br> <!-- Необхідний відступ сторінки -->

<!-- [2] Заголовок таблиці запитів на абонементи -->
<h2>Список запитів на Абонементи</h2>
<table>
    <tr>
      <!-- Заголовки стовпців -->
        <th>Дата та час покупки</th>
        <th>ID</th>
        <th>ПІБ</th>
        <th>Телефон</th>
        <th>Електронна пошта</th>
        <th>Номер карти</th>
        <th>Тип абонементу</th>
        <th>Додаткова інформація</th>
    </tr>
    
    <?php
    // Перевірка, чи є результати запиту до бази даних
    if ($result_purchases->num_rows > 0) {

      // вивід даних кожного рядка
      while($row = $result_purchases->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["purchase_date"] . "</td>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["name"] . "</td>";
        echo "<td>" . $row["phone"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        echo "<td>" . $row["card"] . "</td>";
        echo "<td>" . $row["abonement_type"] . "</td>";
        echo "<td>" . $row["additional_info"] . "</td>";
        echo "</tr>";
      }
    } else {
      // Вивід повідомлення про відсутність результатів
      echo "0 results";
    }
    ?>
    </table>


<!-- [3] Заголовок таблиці онлай замовлень -->
<h2>Список запитів на онлай замовлення</h2>
<table>
    <tr>
      <!-- Заголовки стовпців -->
      <th>Дата та час покупки</th>
      <th>ID</th>
      <th>ПІБ</th>
      <th>Телефон</th>
      <th>Електронна пошта</th>
      <th>Номер карти</th>
      <th>Товар</th>
      <th>Загальна ціна</th>
      <th>Адреса</th>
      <th>Кількість</th>
      <th>Тип доставки</th>
      <th>Додаткова інформація</th>
    </tr>
    
    <?php
    // Перевірка, чи є результати запиту до бази даних
    if ($result_shop_purchases->num_rows > 0) {
      
      // Вивід даних кожного рядка, якщо результати є
      while($row = $result_shop_purchases->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["purchase_date"] . "</td>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["name"] . "</td>";
        echo "<td>" . $row["phone"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        echo "<td>" . $row["card"] . "</td>";
        echo "<td>" . $row["product_name"] . "</td>";
        echo "<td>" . $row["total_price"] . "</td>";
        echo "<td>" . $row["address"] . "</td>";
        echo "<td>" . $row["quantity"] . "</td>";
        echo "<td>" . $row["delivery"] . "</td>";
        echo "<td>" . $row["additional_info"] . "</td>";
        echo "</tr>";
      }
    } else {
      // Вивід повідомлення про відсутність результатів
      echo "0 results";
    }
    
    ?>
    </table>
    
    <!-- Закриття з'єднання з базою даних -->
    <?php
    $conn->close();
    ?>
    
  </body>
</html>
