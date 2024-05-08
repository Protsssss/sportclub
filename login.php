<?php
session_start(); // Підключення до бази даних
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_sport";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Обробка відправленої форми
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Запит до бази даних для перевірки введених даних
    $sql = "SELECT * FROM clients WHERE username='$username'";
    $result = $conn->query($sql);

// Під час успішного входу користувача
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        // Успішний вхід
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $row['role']; // Встановлення ролі користувача у сесію
        // Redirect to user dashboard or any other page
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Неправильний пароль";
    }
} else {
    // Немає такого користувача
    echo "Користувача з таким логіном не знайдено";
}

}
?>


<!DOCTYPE html>
<html lang="ua">
<head>
  <title>Вхід в особистий кабінет</title>
    <meta charset="UTF-8">

    <!-- Підключаємо зовнішні стилі, шрифти, анімації та скрипти -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="code/style/login_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>  
    <link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'> 
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
</head>


<!-- Тіло сторінки -->
<body class="body">
  <a><img style="position: absolute; top: 0; left: 0; border: 0;"></a>

  <!-- Форма логіну користувача -->
<div class="login-container">
  <div class="form">
    <form action="login.php" method="post">

    <!-- Анімація у формі -->
      <lottie-player src="https://assets4.lottiefiles.com/datafiles/XRVoUu3IX4sGWtiC3MPpFnJvZNq7lVWDCa8LSqgS/profile.json"  
      background="transparent"  speed="1"  style="justify-content: center;" loop  autoplay></lottie-player>

      <!-- Поля для введення логіну та паролю -->
      <label for="username">
      <input type="text" id="username" placeholder="&#xf007;  username" name="username"/>
      <label for="password">
      <input type="password" id="password" placeholder="&#xf023;  password" name="password"/>

      <!-- Кнопка для відображення чи приховання паролю  -->
      <i class="fas fa-eye" onclick="show()"></i> <br><br>

      <!-- Кнопка для входу -->
      <button type="submit">Увійти</button>
    </form>

    <!-- Кнопка для переходу на головну сторінку  -->
    <form action="index.html">
      <button type="submit">На головну</button>
    </form>

    <!-- Кликабельне посилання на реєстрацію -->
    <p>Ще не зареєстровані? <a href="registration.html">Зареєструватися</a></p>
  </div>
</div>

  <script>
    function show(){
      // Функція для відображення або приховування паролю
      var password = document.getElementById("password");
      var icon = document.querySelector(".fas")
      // Перевірка типу поля паролю та зміна його видимості
      if(password.type === "password"){
        password.type = "text";
      }
      else {
        password.type = "password";
      }
    };
  </script>
  
</body>
</html>


<?php
// Закриття з'єднання з базою даних
$conn->close();
?>
