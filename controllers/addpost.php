<?php
require_once('db/db_connector.php');
$imgDir = "img";        // каталог для хранения изображений
@mkdir($imgDir, 0777);  // создаем, если его еще нет

try{
    if(!isset($_POST['email']) || empty($_POST['email'])) exit('Email is empty');
    if(!isset($_POST['content']) || empty($_POST['content'])) exit('Content is empty');
    if(!isset($_POST['name'])) exit('Name does not exist');
    if(!isset($_FILES['image'])) exit('image does not exist');
    if(!empty($_POST['name'])){
    if( !preg_match('/^([A-Z][a-z]+([ ]?[a-z]?[\'-]?[A-Z][a-z]+)*)$/', $_POST['name'])){
        exit('\'Name\' must contain only letters');
    }}
    if (!empty($_FILES['image'])) {
    $data = $_FILES['image'];
    $tmp = $data['tmp_name'];
    // Проверяем, принят ли файл.
    if (is_uploaded_file($tmp)) {
        $info = @getimagesize($tmp);
        // Проверяем, является ли файл изображением.
        if (preg_match('{image/(.*)}is', $info['mime'], $p)) {
            // Имя берем равным текущему времени в секундах, а
            // расширение - как часть MIME-типа после "image/".
            $name = "$imgDir/".time().".".$p[1];
            // Добавляем файл в каталог с фотографиями.
            move_uploaded_file($tmp, $name);
        } else {
            echo "<h2>Попытка добавить файл недопустимого формата!</h2>";
        }
    } else {
        echo "<h2>Ошибка закачки #{$data['error']}!</h2>";
    }
}
    $query = "INSERT INTO `post` (`id`, `email`, `name`, `text`, `image_path`, `timestamp`) 
              VALUES (NULL, :email, :name, :text, :image_path, CURRENT_TIMESTAMP)";
    $news = $pdo->prepare($query);
    $news ->execute(['text'=> htmlspecialchars($_POST['content']),'email' => htmlspecialchars($_POST['email']),
        'name' => htmlspecialchars($_POST['name']), 'image_path'=> $name ]);
    header("Location: index.php");
}catch (PDOException $e){
    echo "Ошибка выполнения запроса: ".$e->getMessage();
}