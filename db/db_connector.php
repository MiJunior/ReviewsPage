<?php
try{
$db_user = 'rewiws_root';
$db_pass = '1111';
$pdo = new PDO(
'mysql:host=localhost;dbname=reviews',
$db_user,
$db_pass,
array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",// UTF-8
[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]));//обработка ошибок
}catch (PDOException $e){
echo "Невозможно подключится к БД. Обратитесь к администратору.";
}