<?php
require_once '../../db/db_connector.php';
if(isset($_POST['doReg'])){
    $errors = [];

    //Проверка существования данных
    if(!empty($_POST['login']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['confirm'])){
        $username = htmlspecialchars(trim($_POST['login']));
        $password = md5(trim(htmlspecialchars($_POST['password'])));
        $email = htmlspecialchars(trim($_POST['email']));

        //совпадают ли пароли
        if($_POST['password'] != $_POST['confirm']){
            die('Passwords do not match');//пароли не совпадают
        }

        //валидация почты
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            die('Email is not correctly. example@domain.com');
        }

        //проверка уникальности логина
        $uniq_login = $pdo->prepare("SELECT * FROM `users` 
                                WHERE `login` = (:login)");
        $uniq_login->execute(['login' => $username]);
        $num_rows = $uniq_login->fetchColumn();
        if($num_rows!=0){
            die( 'This login is already taken');

        }else
        //проверка уникальности почты
        $uniq_email = $pdo->prepare("SELECT * FROM `users` 
                                WHERE `email` = (:email)");
        $uniq_email->execute(['email'=> $email]);
        $num_rows_email = $uniq_email->fetchColumn();
        if($num_rows_email!=0){
            die('This email is already taken');
        }
        print_r($errors);
        try{
            $query = $pdo->prepare("INSERT INTO `users` (`id`, `login`, `email`, `password`) 
                          VALUES (NULL, :login, :email, :password)");
            $success = $query->execute(['login'=> $username, 'email' => $email, 'password'=> $password]);
            header("Location: ../index.php");

        }catch (Exception $e){
        die( "Error: ".$e);
        }
    }
    echo "All fields are required!";


}