<?php
session_start();
require_once 'db/db_connector.php';
require_once  'parts/head.php';
require_once 'controllers/showpost.php';

?>

<div class="container">
    <?php foreach ($post as $show){?>
    <div class="card" style="margin:10px">
        <?php if(!empty($show['name'])) {?>
        <div class="card-header">
        <?=$show['name'];?>
        </div>
        <?php }?>
        <div class="card-header">
            <?=$show['email'];?>
        </div>

        <div class="card-body">
            <p class="card-text"><?=$show['text'];?></p>
            <?php if(!empty($show['image_path'])) {?>
            <img src="<?=$show['image_path']?>" alt="">
            <?php }?>
        </div>
    </div>
    <?php } ?>
    <hr>
    <form action="controllers/addpost.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
        </div>
        <div class="form-group">
            <label for="InputName">Name</label>
            <input type="text" name="name" class="form-control" placeholder="Name">
        </div>
        <div class="form-group">
            <label for="Input Text">Content</label>
            <input type="text" name="content" class="form-control" placeholder="Content">
        </div>
        <p><input type="file" name="image">
        <hr>
        <button type="submit" class="btn btn-primary">Submit</button>

    </form>
</div>

