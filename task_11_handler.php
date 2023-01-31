<?php
session_start();

require_once 'Database.php';

$url = $_SERVER['HTTP_REFERER'];
$url = parse_url($url, PHP_URL_PATH);
$db = new Database();
$_SESSION['REQUEST_STATUS'] = 'alert-danger';

function requestSuccess($res, $db, $text) {
    if ($res == false) {
        $db->query('INSERT INTO input (text) VALUE (:text)', [':text' => $text]);
        $_SESSION['REQUEST_STATUS'] = 'alert-success';
    }
}

if ($url == "/task_11.php") {
    $text = $_POST['text'];
    $response = $db->query('SELECT * FROM input WHERE text = :text', [':text' => $text])->fetch(PDO::FETCH_ASSOC);

    requestSuccess($response, $db, $text);
    header("Location: /task_11.php");
    exit;
}

if ($url == "/task_12.php") {
    $email = $_POST['email'];
    $response = $db->query('SELECT * FROM users WHERE email = :email', [':email' => $email])->fetch(PDO::FETCH_ASSOC);
    
    if (!$response) {
        $_SESSION['REQUEST_STATUS'] = 'alert-success';
    }
    header("Location: /task_12.php");
    exit;
}

