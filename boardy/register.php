<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    session_set_cookie_params(['lifetime' => 0, 'path' => '/', 'secure' => true, 'httponly' => true, 'samesite' => 'Lax']);
    session_start();
    require_once 'db.php';

    $error = '';

    if (isset($_POST['name'])) {
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $stmt = $pdo->prepare('SELECT id FROM users WHERE email = ?');
        $stmt->execute([$_POST['email']]);
        if ($stmt->fetch()) {
            $error = 'Email уже занят';
        } else {
            $stmt = $pdo->prepare('INSERT INTO users (name, password_hash, email) VALUES (?, ?, ?)');
            $stmt->execute([$_POST['name'], $password, $_POST['email']]);

            $_SESSION['user_id'] = $pdo->lastInsertId();
            $_SESSION['user_name'] = $_POST['name'];
            header('Location: /messages.php');
            exit;
        }
    }
?>

<?php include __DIR__ . '/partials/head.php'; ?>
<?php include __DIR__ . '/partials/nav.php'; ?>
    <main>
        <div class="auth-card">
            <h1>Регистрация</h1>

            <?php if (!empty($error)): ?>
                <p style="color: #e74c3c; margin-bottom: 15px; font-weight: bold;"><?= htmlspecialchars($error) ?></p>
            <?php endif; ?>

            <form method="POST" action="register.php">
                <label for="name">Имя</label>
                <input id="name" name="name" placeholder="Иванов Иван" required>

                <label for="email">Email</label>
                <input id="email" name="email" type="email" placeholder="ivan@example.com" required>

                <label for="password">Пароль</label>
                <input id="password" name="password" type="password" placeholder="••••••••" required>

                <button type="submit">Зарегистрироваться</button>
            </form>

            <div class="auth-footer">
                Уже есть аккаунт? <a href="/login.php">Войти</a>
            </div>
        </div>
    </main>
<?php include __DIR__ . '/partials/foot.php'; ?>