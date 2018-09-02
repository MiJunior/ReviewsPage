<?php
session_start();
require_once '../../db/db_connector.php';

if(!empty($_SESSION["session_username"])){
    // вывод "Session is set"; // в целях проверки
    header("Location: index.php");
}
if(isset($_POST['doLogin'])){
    if(!empty($_POST['login'] && !empty($_POST['password']))){
        $username = htmlspecialchars(trim($_POST['login']));
        $password = md5(trim(htmlspecialchars($_POST['password'])));
        $query = $pdo->prepare("SELECT * FROM `users` 
                  WHERE  `login` = (:login) && `password` = (:password) ");
        $query->execute(['login'=> $username, 'password'=> $password]);
        $num_rows_login = $query->fetchColumn();
        $role = $pdo->prepare("SELECT * FROM `users` 
                                WHERE `login` = (:login) && `password` = (:password)");
        $role->execute(['login'=> $username, 'password'=> $password]);
        $role_id = $role->fetch(PDO::FETCH_ASSOC);
        if($num_rows_login!=0){
            $_SESSION['session_username']=$username;
            $_SESSION['role_id'] = $role_id['role_id'];
            header("Location: ../../index.php");
            }else {
                echo "Invalid login or password";
            }
        }


}