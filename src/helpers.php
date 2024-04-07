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

function validationErrorAtter(string $fieldName)
{
    echo isset($_SESSION['validation'][$fieldName]) ? 'aria-invalid="true"' : '';
}

function validationErrorMessage(string $fieldName)
{
    $message = $_SESSION['validation'][$fieldName] ?? '';
    unset($_SESSION['validation'][$fieldName]);
    echo $message;
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

function getPDO(): PDO
{
    try {
        return new \PDO('mysql:host=' . DB_HOST .  ';charset=utf8;dbname=' . DB_NAME, DB_USERNAME, '');

    } catch (\PDOException $e) {
        die("Connection error: {$e->getMessage()}");
    }
}

//function clearOldValues(string $key): void
//{
//    $_SESSION['old'] = [];
//}











