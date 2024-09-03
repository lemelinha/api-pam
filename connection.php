<?php

$host='localhost';
$user='root';
$pwd='';
$dbname='db_pam';
$port=3306;

try {
    $conn = new PDO("mysql:host={$host};port={$port};dbname={$dbname};", $user, $pwd);
    // $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    return $conn;
} catch (\PDOException $e) {
    echo $e->getMessage();
    die();
}
