<?php
require_once 'db/db_connector.php';

$posts = $pdo->prepare("SELECT * FROM post ");

$posts->execute();

$allpost = $posts->fetchAll();
