<?php
session_start();
require_once 'db/db_connector.php';
require_once  'parts/head.php';
if(isset($_SESSION["session_username"])){
    // вывод "Session is set"; // в целях проверки
    header("Location: login.php");
}
?>
<div class="container">
    <form action="controllers/auth/reg.php" method="post">
        <div class="form-group">
            <label for="exampleInputEmail1">Login</label>
            <input type="text" name="login" class="form-control" id="exampleInputEmail1"
                   placeholder="Enter your login">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                   placeholder="Enter email">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Confirm Password</label>
            <input type="password" name="confirm" class="form-control" id="exampleInputPassword1" placeholder="Confirm Password">
        </div>

        <button type="submit" name="doReg" class="btn btn-primary">Sign up</button>
    </form>
</div>
