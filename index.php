<?php
require_once __DIR__ . '/src/helpers.php';
?>

<!DOCTYPE html>
<html lang="ru" data-theme="light">
<head>
    <meta charset="UTF-8">
    <title>AreaWeb - авторизация и регистрация</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@1/css/pico.min.css">
    <link rel="stylesheet" href="assets/app.css">
</head>
<body>

<form class="card" action="src/actions/login.php" method="post">
    <h2>Вход</h2>
    <?php if (hasMessage('error')): ?>
    <div class="notice error"><?php echo getMessage('error')?></div>
    <?php endif; ?>

<!--    <div class="notice success">Какое-то сообщение</div>-->

    <label for="email">
        Имя
        <input
            type="text"
            id="email"
            name="email"
            placeholder="Иванов Иван"
            aria-invalid="true"
            value="<?php echo old('email') ?>"
            <?php validationErrorAtter('email'); ?>
        >
        <?php if (hasValidationError('email')): ?>
            <small><?php validationErrorMessage('email'); ?></small>
        <?php endif; ?>
    </label>

    <label for="password">
        Пароль
        <input
            type="password"
            id="password"
            name="password"
            placeholder="******"
        >
    </label>

    <button
        type="submit"
        id="submit"
    >Продолжить</button>
</form>

<p>У меня еще нет <a href="/register.php">аккаунта</a></p>

<script src="assets/app.js"></script>
</body>
</html>