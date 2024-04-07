<?php

session_start();

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

//function clearOldValues(string $key): void
//{
//    $_SESSION['old'] = [];
//}











