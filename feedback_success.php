<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="theme-color" content="#000000"/>
<link rel="manifest" href="manifest.json">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Спасибо за отзыв!</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Спасибо за ваш отзыв!</h1>
    </header>
    <nav>
        <ul>
            <li><a href="index.html">Главная</a></li>
            <li><a href="sad_stones.html">Топ 5 грустных камней</a></li>
            <li><a href="funny_stones.html">Топ 5 смешных камней</a></li>
            <li><a href="weird_stones.html">Топ 5 необычных камней</a></li>
            <li><a href="feedback.html">Обратная связь</a></li>
        </ul>
    </nav>
    <main>
        <div class="success-message">
            <p>Ваше сообщение успешно отправлено. Мы ценим ваш вклад в развитие нашего каменного сообщества!</p>
            
            <div class="feedback-display">
                <h3>Ваш отзыв:</h3>
                <p><strong>ФИО:</strong> <?php echo htmlspecialchars($_SESSION['current_feedback']['fullname']); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($_SESSION['current_feedback']['email']); ?></p>
                <p><strong>Комментарий:</strong> <?php echo nl2br(htmlspecialchars($_SESSION['current_feedback']['comment'])); ?></p>
            </div>
            
            <?php if (!empty($_SESSION['recent_feedback'])): ?>
            <div class="recent-feedback">
                <h3>Последние отзывы:</h3>
                <ul>
                    <?php foreach ($_SESSION['recent_feedback'] as $feedback): ?>
                    <li>
                        <p><strong><?php echo htmlspecialchars($feedback['fullname']); ?></strong> (<?php echo htmlspecialchars($feedback['email']); ?>)</p>
                        <p><?php echo nl2br(htmlspecialchars($feedback['comment'])); ?></p>
                        <small><?php echo $feedback['reg_date']; ?></small>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endif; ?>
            
            <a href="index.html" class="home-button">Вернуться на главную</a>
        </div>
    </main>
    <footer>
        &copy; 2025 Каменный прикол
    </footer>
</body>
</html>