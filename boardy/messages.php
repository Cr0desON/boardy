<?php
session_set_cookie_params(['lifetime' => 0, 'path' => '/', 'secure' => true, 'httponly' => true, 'samesite' => 'Lax']);
session_start();
require_once 'db.php';

$stmt = $pdo->query('
    SELECT p.id, p.body, p.created_at,
           u.name AS author_name
    FROM posts p
    JOIN users u ON p.author_id = u.id
    ORDER BY p.created_at DESC
');
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<?php include __DIR__ . '/partials/head.php'; ?>
<?php include __DIR__ . '/partials/nav.php'; ?>
<main>
    <h1 class="page-title">Все посты</h1>

    <?php if (empty($posts)): ?>
        <p>Сообщений пока нет.</p>
    <?php else: ?>
        <div class="posts-list">
            <?php foreach ($posts as $pst): ?>
                <div class="post-card">
                    <div class="post-header">
                        <span class="post-author"><?= htmlspecialchars($pst['author_name']) ?></span>
                        <span class="post-time"><?= htmlspecialchars($pst['created_at']) ?></span>
                    </div>
                    <div class="post-body">
                        <?= htmlspecialchars($pst['body']) ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    <p style="margin-top:20px">
        <a href="/feedback.php">Написать</a> |
        <a href="/">На главную</a>
    </p>
</main>
<?php include __DIR__ . '/partials/foot.php'; ?>




