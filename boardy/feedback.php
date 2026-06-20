<?php
    session_set_cookie_params(['lifetime' => 0, 'path' => '/', 'secure' => true, 'httponly' => true, 'samesite' => 'Lax']);
    session_start();
?>

<?php include __DIR__ . '/partials/head.php'; ?>
<?php include __DIR__ . '/partials/nav.php'; ?>
<main>
    <h2>Обратная связь</h2>
    <form method="POST" action="/submit.php" >
        <label for="name">Имя:</label>
        <input type="text" id="name" name="name" required>

        <label for="message">Сообщение:</label>
        <textarea id="message" name="message"
                  rows="5" required></textarea>

        <button type="submit">Отправить</button>
    </form>
</main>
<?php include __DIR__ . '/partials/foot.php'; ?>
