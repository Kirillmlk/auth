<?php

require_once __DIR__ . '/../helpers.php';

// Вносим данный в переменные
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$passwordConfirmation = $_POST['password_confirmation'];


//Валидация

$_SESSION['validation'] = [];

if (empty($name)) {
    $_SESSION['validation']['name'] = 'Неверное Имя';
}

if (!empty($_SESSION['validation'])) {
    redirect('/register.php');
}












