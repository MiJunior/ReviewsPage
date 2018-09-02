<?php
require_once('db/db_connector.php');


$posts = $pdo->prepare("SELECT * FROM post WHERE published = 1");

$posts->execute();

$post = $posts->fetchAll();

