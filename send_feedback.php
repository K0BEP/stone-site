<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получаем данные из формы
    $fullname = htmlspecialchars($_POST['fullname']);
    $email = htmlspecialchars($_POST['email']);
    $comment = htmlspecialchars($_POST['comment']);
    
    // Проверяем email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Неверный формат email");
    }
    
    // Подключаемся к базе данных
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "stone_feedback";
    
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Вставляем данные в базу
        $stmt = $conn->prepare("INSERT INTO feedback (fullname, email, comment) VALUES (:fullname, :email, :comment)");
        $stmt->bindParam(':fullname', $fullname);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':comment', $comment);
        $stmt->execute();
        
        // Получаем последние 5 отзывов
        $stmt = $conn->query("SELECT * FROM feedback ORDER BY reg_date DESC LIMIT 5");
        $recent_feedback = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Сохраняем в сессию для отображения на странице успеха
        session_start();
        $_SESSION['recent_feedback'] = $recent_feedback;
        $_SESSION['current_feedback'] = [
            'fullname' => $fullname,
            'email' => $email,
            'comment' => $comment
        ];
        
        header('Location: feedback_success.php');
        exit;
    } catch(PDOException $e) {
        die("Ошибка подключения: " . $e->getMessage());
    }
} else {
    header('Location: feedback.html');
    exit;
}
?>