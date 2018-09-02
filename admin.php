<?php
session_start();
require_once 'db/db_connector.php';
require_once  'parts/head.php';
require_once 'controllers/admin.published.php';

if($_SESSION['role_id'] == 1){?>

    <div class="container">

        <?php foreach ($allpost as $show){?>

            <div class="card" style="margin: 10px">
                <?php if(!empty($show['name'])) {?>
                    <div class="card-header" >
                        <?=$show['name'];?>
                    </div>
                <?php }?>
                <div class="card-header">
                    <?=$show['email'];?>
                </div>
                <div class="card-header">
                    Status: <?php if($show['published'] == 1){
                        echo "Published";
                    }else{
                        echo "Waiting";
                    };?>
                </div>

                <form action="controllers/edit.php" method="post" enctype="multipart/form-data"  >
                <div class="card-header">
                                      Edit = <select name="published_select" >
                        <option value="0"> Not published </option>
                        <option value="1"> Published </option>
                    </select>
                    <input type="text" name="id" value="<?=$show['id'];?>" hidden="true">
                    <input type="submit" name="edit" class="btn btn-outline-info" value="Edit">
                    <input type="submit" name="delete" class="btn btn-outline-danger" value="Delete">
                </form>
                </div>
                <div class="card-body">
                    <p class="card-text"><?=$show['text'];?></p>
                    <?php if(!empty($show['image_path'])) {?>
                        <img src="<?=$show['image_path']?>" alt="">
                    <?php }?>
                </div>
            </div>
        <?php } ?>

    </div>
<?php } else{
    header("Location: login.php");
} ?>
