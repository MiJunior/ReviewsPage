<?php
session_start();
require_once 'db/db_connector.php';
require_once  'parts/head.php';
if(!empty($_SESSION["session_username"])){
    // вывод "Session is set"; // в целях проверки
    header("Location: index.php");
}
?>
<div class="container">
    <form action="controllers/auth/login.php" method="post">
        <div class="form-group">
            <label >Login</label>
            <input type="text"  name="login"  class="form-control"  placeholder="Login">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password"  name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
        </div>
        <button type="submit" name="doLogin" class="btn btn-primary">Submit</button>
    </form>
</div>
