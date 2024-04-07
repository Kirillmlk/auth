<?php

session_start();
require_once __DIR__ . '/config.php';

function redirect(string $path)
{
    header("Location: $path");
    die();
}

function addValidationError(string $fieldName, string $message)
{
    $_SESSION['validation'][$fieldName] = $message;
}

//function clearValidation()
//{
//    $_SESSION['validation'] = [];
//}

function hasValidationError(string $fieldName):bool
{
    return isset($_SESSION['validation'][$fieldName]);
}

function validationErrorAtter(string $fieldName): string
{
    return isset($_SESSION['validation'][$fieldName]) ? 'aria-invalid="true"' : '';
}

function validationErrorMessage(string $fieldName)
{
    $message = $_SESSION['validation'][$fieldName] ?? '';
    unset($_SESSION['validation'][$fieldName]);
    return $message;
}

function addOldValue(string $key, mixed $value)
{
    $_SESSION['old'][$key] = $value;
}

function old(string $key)
{
    $value = $_SESSION['old'][$key] ?? '';
    unset($_SESSION['old'][$key]);
    return $value;
}

function uploadFile(array $file, string $prefix = ''): string
{
    $upLoadPath = __DIR__ . '/../uploads';

    if (!is_dir($upLoadPath)) {
        mkdir($upLoadPath, 0777, true);
    }

    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
    $fileName = $prefix . '_' . time() . ".$ext";



    if (!move_uploaded_file($file['tmp_name'], "$upLoadPath/$fileName")) {
        die('Ошибка при загрузке файла');
    }

    return "uploads/$fileName";
}

function setMessage(string $key, string $message): void
{
    $_SESSION['message'][$key] = $message;
}

function hasMessage(string $key): bool
{
    return isset($_SESSION['message'][$key]);
}

function getMessage(string $key): string
{
    $message = $_SESSION['message'][$key] ?? '';
    unset($_SESSION['message'][$key]);
    return $message;
}

function getPDO(): PDO
{
    try {
        return new \PDO('mysql:host=' . DB_HOST .  ';charset=utf8;dbname=' . DB_NAME, DB_USERNAME, '');

    } catch (\PDOException $e) {
        die("Connection error: {$e->getMessage()}");
    }
}


function findUser(string $email): array|bool
{
    $pdo = getPDO();

    $stmt = $pdo->prepare("SELECT * FROM users WHERE `email` = :email");
    $stmt->execute(['email' => $email]);
    return $stmt->fetch(\PDO::FETCH_ASSOC);
}


function currentUser()
{
    $pdo = getPDO();
    if (!isset($_SESSION['user'])) {
        return false;
    }

    $userId = $_SESSION['user']['id'] ?? null;
    $stmt = $pdo->prepare("SELECT * FROM users WHERE `id` = :id");
    $stmt->execute(['id' => $userId]);
    return $stmt->fetch(\PDO::FETCH_ASSOC);
}


function logout()
{
    unset($_SESSION['user']['id']);
    redirect('/');
}

function checkAuth(): void
{
    if (!isset($_SESSION['user']['id'])) {
        redirect('/');
    }
}

function checkGuest(): void
{
    if (isset($_SESSION['user']['id'])) {
        redirect('/home.php');
    }
}
//function clearOldValues(string $key): void
//{
//    $_SESSION['old'] = [];
//}











