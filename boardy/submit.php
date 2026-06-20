<?php
session_set_cookie_params(['lifetime' => 0, 'path' => '/', 'secure' => true, 'httponly' => true, 'samesite' => 'Lax']);
session_start();
require_once 'db.php';


$name = $_POST['name'] ?? '';
$message = $_POST['message'] ?? '';

if (empty($_SESSION['user_id'])) {
    header('Location: /login.php');
    exit;
}

$is_submitted = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $body = trim($_POST['body'] ?? '');

    if ($body) {
        $stmt = $pdo->prepare('INSERT INTO posts (title, body, author_id) VALUES (?, ?, ?)');
        $stmt->execute(['Объявление', $body, $_SESSION['user_id']]);

        $is_submitted = true;
    }
}
?>
<?php include __DIR__ . '/partials/head.php'; ?>
<?php include __DIR__ . '/partials/nav.php'; ?>
    <main>
        <?php if ($is_submitted): ?>
            <div class="auth-card" style="max-width: 600px; text-align: center;">
                <h2 style="color: #154360; margin-bottom: 20px;">Спасибо, <?= htmlspecialchars($_SESSION['user_name']) ?>!</h2>
                <p style="margin-bottom: 25px; color: #555;">Твой пост успешно опубликован.</p>

                <div>
                    <a href="/" style="font-weight: bold; margin-right: 15px; text-decoration: none;">На главную</a>
                    <a href="/messages.php" style="font-weight: bold; text-decoration: none;">Все сообщения</a>
                </div>
            </div>

        <?php else: ?>
            <div class="auth-card" style="max-width: 600px;">
                <h1 style="margin-bottom: 20px;">Новый пост</h1>

                <form method="POST" action="submit.php">
                    <label for="body">Текст</label>
                    <textarea id="body" name="body" rows="6" placeholder="Напишите ваше объявление..." required
                              style="width: 100%; padding: 12px; border: 1px solid #bdc3c7; border-radius: 4px; font-size: 15px; margin-top: 4px; resize: vertical; outline: none;"></textarea>

                    <div style="display: flex; gap: 20px; align-items: center; margin-top: 20px;">
                        <button type="submit" style="width: auto; margin-top: 0; padding: 12px 30px;">Опубликовать</button>
                        <a href="/messages.php" style="color: #154360; text-decoration: none; font-weight: bold;">Отмена</a>
                    </div>
                </form>
            </div>
        <?php endif; ?>
    </main>
<?php include __DIR__ . '/partials/foot.php'; ?>