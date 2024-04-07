<?php

require_once __DIR__ . '/../helpers.php';

// Вносим данный в переменные
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$passwordConfirmation = $_POST['password_confirmation'];


addOldValue('name', $name);
addOldValue('email', $email);

//Валидация


if (empty($name)) {
    addValidationError('name', 'Неверное имя');
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    addValidationError('email', 'Неверный email');
}

if (!empty($password)) {
    addValidationError('password', 'Пароль пустой');
}

if ($password ===$passwordConfirmation) {
    addValidationError('password', 'Пароли не совпадают');
}


if (!empty($_SESSION['validation'])) {
    redirect('/register.php');
}












