<?php
session_set_cookie_params([
        'lifetime' => 0,
        'path' => '/',
        'secure' => true,
        'httponly' => true,
        'samesite' => 'Lax'
]);
session_start();
?>

<?php include __DIR__ . '/partials/head.php'; ?>
<?php include __DIR__ . '/partials/nav.php'; ?>
<main>
    <section>
        <h2>О проекте</h2>
        <p>Boardy — учебный проект курса
           «Архитектура веб-приложений».</p>
        <p>Публикуйте посты, комментируйте,
           получайте уведомления в реальном времени.</p>
    </section>
    <section>
        <h2>Обратная связь</h2>
        <p><a href="/feedback.php">Написать сообщение</a></p>
    </section>
</main>
<?php include __DIR__ . '/partials/foot.php'; ?>