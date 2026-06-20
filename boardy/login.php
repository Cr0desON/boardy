<?php
    session_set_cookie_params(['lifetime' => 0, 'path' => '/', 'secure' => true, 'httponly' => true, 'samesite' => 'Lax']);
    session_start();

    require_once 'db.php';

    $error = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        if ($email && $password) {
            $stmt = $pdo->prepare('SELECT id, name, password_hash FROM users WHERE email = ?');
            $stmt->execute([$email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password_hash'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                header('Location: /messages.php');
                exit;
            } else {
                $error = 'Неверный email или пароль';
            }
        } else {
            $error = 'Пожалуйста, заполните все поля';
        }
    }
?>

<?php include __DIR__ . '/partials/head.php'; ?>
<?php include __DIR__ . '/partials/nav.php'; ?>
<main>
    <div class="auth-card">
        <h1>Вход</h1>

        <?php if (!empty($error)): ?>
            <p style="color: #e74c3c; margin-bottom: 15px; font-weight: bold;"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>

        <form method="POST" action="login.php">
            <label for="email">Email</label>
            <input id="email" name="email" type="email" placeholder="ivan@example.com" required>

            <label for="password">Пароль</label>
            <input id="password" name="password" type="password" placeholder="••••••••" required>

            <button type="submit">Войти</button>
        </form>

        <div class="auth-footer">
            Нет аккаунта? <a href="/register.php">Регистрация</a>
        </div>
    </div>
</main>

<?php include __DIR__ . '/partials/foot.php'; ?>

