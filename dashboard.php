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

// Перевірка, чи користувач авторизований
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];

// Обробка оновлення даних користувача
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST['full_name'];
    $height = $_POST['height'];
    $weight = $_POST['weight'];

    // Оновлення даних користувача в базі даних
    $sql = "UPDATE clients SET full_name='$full_name', height='$height', weight='$weight' WHERE username='$username'";

    if ($conn->query($sql) === TRUE) {
        // Оновлення відбулося успішно, оновіть дані користувача
        header("Refresh:0"); // Перезавантаження сторінки
    } else {
        echo "Помилка під час оновлення даних: " . $conn->error;
    }
}

// Запит до бази даних, щоб отримати дані користувача
$sql = "SELECT * FROM clients WHERE username='$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $full_name = $row['full_name']; // Отримуємо імя
    $email = $row['email']; // Отримуємо пошту користувача
    $role = $row['role']; // Отримуємо роль користувача
    $height = $row['height']; // Отримуємо зріст користувача
    $weight = $row['weight']; // Отримуємо вагу користувача
    $subscription = $row['subscription']; // Отримуємо абонемент користувача
    $trainer_type = $row['trainer_type']; // Отримуємо тип тренера користувача
}

// Запит до бази даних, щоб отримати дані користувача та його тренера
$sql = "SELECT clients.*, trainers.full_name AS trainer_name
        FROM clients
        INNER JOIN client_trainer_relationships ON clients.id = client_trainer_relationships.client_id
        INNER JOIN clients AS trainers ON client_trainer_relationships.trainer_id = trainers.id
        WHERE clients.username='$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    // Отримуємо дані
    $full_name = $row['full_name'];
    $email = $row['email'];
    $role = $row['role'];
    $height = $row['height'];
    $weight = $row['weight'];
    $subscription = $row['subscription'];
    $trainer_type = $row['trainer_type'];
    $trainer_name = $row['trainer_name']; 
} 

// Закриття з'єднання з базою даних
$conn->close();
?>


<!DOCTYPE html>
<html lang="ua">
<head>
    <meta charset="UTF-8">
    <title>Особистий кабінет</title>
    <link rel="stylesheet" href="code/style/personal_account.css"> <!-- Посилання на файл стилів -->
</head>


<!-- Тіло верхньої частини сторінки -->
<body>
    <!-- Верхня частина сторінки -->
    <header class="header" id="header">
        <lion class="lion">
            <!-- Логотип з посиланням -->
            <a href="#" class="lion__logo"> <i class="fas fa-hiking"></i>LION.</a>
            <div class="container">
                <main>
                    <div class="button-group">
                        <!-- Кнопка для переходу на головну сторінку -->
                        <a href="index.html"><button class="btn" id="btn4">На головну</button></a>
                    </div>
                    <div class="button-group">
                        <!-- Кнопка для відображення налаштуван -->
                        <button onclick="showSettings()" class="btn" id="btn4">Налаштування</button>
                    </div>
                    <div class="button-group">
                        <!-- Кнопка для виходу -->
                        <a href="login.php"><button id="logoutBtn" class="btn" id="btn4"> Вийти </button></a>
                    </div>
                </main>
            </div>

            <!-- Анімація кнопок -->
            <script src="script_button.js"></script> 

        </lion>
    </header>
</body>


<!-- Тіло налаштуваннь -->
<body>
    <!-- Декілька рядків пропуску -->
    <br><br><br><br><br><br>

    <!-- Розділ особистого кабінету -->
    <section class="shop container section" id="abonement">
    <h1>Особистий кабінет</h1>

    <!-- Форма налаштувань, спочатку прихована -->
    <div id="settingsForm" style="display:none;">
    <section class="shop container section" id="abonement">
        <div class="shop__container">
            <div class="swiper-wrapper">
                <article class="block_side"></article>

                <!-- Форма для редагування особистих даних -->
                <article class="shop__card swiper-slide">
                    <h2>Редагування даних</h2>
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

                    <!-- Поля для введення особистих даних -->
                    <label for="full_name">Повне ім'я:</label>
                    <input type="text" id="full_name" name="full_name" value="<?php echo $full_name; ?>" required><br><br>
            
                    <label for="height">Зріст:</label>
                    <input type="number" id="height" name="height" value="<?php echo $height; ?>" required><br><br>
            
                    <label for="weight">Вага:</label>
                    <input type="number" id="weight" name="weight" value="<?php echo $weight; ?>" required><br><br>

                    <!-- Відображення поточної пошти та ролі -->
                    <p>Електронна пошта: <?php echo $email; ?></p>
                    <p>Ваша поточна роль: <?php echo ucfirst($role); ?></p> 
            
                    <!-- Кнопка для збереження змін -->
                    <br><button type="submit">Зберегти зміни</button>
                </form>
            </div>
        </div>
    </section>
</div>

<!-- Блок з основним контентом -->
<div class="shop__container">
    <div class="swiper-wrapper">
        <article class="block_side"></article>
        <article class="shop__card swiper-slide">

        <!-- Перевірка на наявність даних -->
            <?php if(empty($full_name) || empty($height) || empty($weight)): ?>
                <h1 style="color: red; font-size: 18px; font-weight: bold;">
                Увага: деякі дані відсутні. Будь ласка, оновіть їх у налаштуваннях!</h1>
                <?php endif; ?>

                 <!-- Вітання з ім'ям користувача та відображення деяких особистих даних -->
                <p style="color: orange; font-size: 17px; font-weight: bold;">Ласкаво просимо, <?php echo $full_name; ?>!</p>

                <!-- Відображення даних -->
                <p>Ваш тренер: <?php echo isset($trainer_name) ? $trainer_name : "Не призначено"; ?></p>
                <p>Ваш зріст: <?php echo !empty($height) ? $height : "Дані відсутні"; ?></p> <!-- Відображення зросту -->
                <p>Ваша вага: <?php echo !empty($weight) ? $weight : "Дані відсутні"; ?></p> <!-- Відображення ваги -->
                <p>Тип абонементу: <?php echo $subscription; ?></p> <!-- Відображення абонемента -->
                <p>Тип тренувань: <?php echo $trainer_type; ?></p> <!-- Відображення типу тренувань -->
                
                <!-- Швидка кнопка переходу у магазин -->
                <div class="button-group-bottom">
                    <a href="index.html#shop"><button id="logoutBtn" class="btn-bottom" id="btn4"> Пеерехід у "Магазин" </button></a>
                </div>
        
            </div>
        </div>
    </section>
    
    
<!-- Блок кнопок -->
<div class="centered-content-button">
    <!-- Перевірка ролі користувача -->
    <?php if($role === 'trainer'): ?>
        <!-- Кнопка для переходу до панелі тренера -->
        <div class="button-group-bottom">
            <a href="trainer_dashboard.php"><button id="logoutBtn" class="btn-bottom" id="btn4"> Перейти до панелі тренера </button></a>
        </div>
    <?php endif; ?>

    <!-- Перевірка ролі користувача -->
    <?php if($_SESSION['role'] === 'trainer_edit'): ?>
        <!-- Кнопка для переходу до панелі редагування тренера -->
        <div class="button-group-bottom">
            <a href="trainer_edit_dashboard.php"><button id="logoutBtn" class="btn-bottom" id="btn4"> Перейти до панелі редагування тренера </button></a>
        </div>
    <?php endif; ?>

    <!-- Перевірка ролі користувача -->
    <?php if($role === 'admin'): ?>
        <!-- Кнопка для переходу до панелі адміністратора -->
        <div class="button-group-bottom">
            <a href="admin_dashboard.php"><button id="logoutBtn" class="btn-bottom" id="btn4"> Перейти до панелі адміністратора </button></a>
        </div>
    <?php endif; ?>

    <!-- Кнопка для переходу до панелі запитів, доступна адміністраторам та тренерам -->
    <?php if($role === 'admin' || $role === 'trainer' || $role === 'trainer_edit'): ?>
        <div class="button-group-bottom">
            <a href="contact_requests.php"><button id="logoutBtn" class="btn-bottom" id="btn4"> Перейти до панелі запитів </button></a>
        </div>
    <?php endif; ?>
</div>


    
<!-- Функція для відображення та приховування форми налаштувань -->
<script>
function showSettings() {
    // Отримуємо елемент форми налаштувань за його id
    var settingsForm = document.getElementById("settingsForm");
    // Перевіряємо, чи прихована форма (стиль display === "none")
    if (settingsForm.style.display === "none") {
        // Якщо так, змінюємо стиль на "block" (відображаємо форму)
        settingsForm.style.display = "block";
    } else {
        // Інакше, змінюємо стиль на "none" (приховуємо форму)
        settingsForm.style.display = "none";
    }
}
</script>

</body>
</html>
