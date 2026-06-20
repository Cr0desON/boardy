<?php
$is_logged = !empty($_SESSION['user_id']);
$user_name = $_SESSION['user_name'] ?? '';
?>
<header>
    <nav class="main-nav">
        <div class="nav-left">
            <a href="/" class="nav-brand">Boardy</a>
            <a href="/messages.php" class="nav-item nav-active">Все посты</a>

            <?php if ($is_logged): ?>
                <a href="/submit.php" class="nav-item">Добавить пост</a>
            <?php endif; ?>
        </div>

        <div class="nav-right">
            <?php if ($is_logged): ?>
                <span class="nav-greeting">Привет, <?= htmlspecialchars($user_name) ?>!</span>
                <a href="/logout.php" class="nav-item nav-btn-dark">Выйти</a>
            <?php else: ?>
                <a href="/login.php" class="nav-item">Вход</a>
                <a href="/register.php" class="nav-item nav-btn-dark">Регистрация</a>
            <?php endif; ?>
        </div>
    </nav>
</header>