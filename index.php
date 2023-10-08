<?php
    session_start();
    require_once 'config.php';

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>lala PDO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha256-EVSTQ3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crrossorigin="anonymous">
</head>
<body>
    
    <div class="container">
        <h3 class="mt-4">เข้าสู่ระบบ</h3>
        <hr>
        <form action="signup_db.php" methot="post">
            <?php if(isset($_SESSION['error'])) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php
                          echo $_SESSION['error'];
                          unset( $_SESSION['error']);
                     ?>
               </div>           
            <?php } ?>
            <?php if(isset($_SESSION['success'])) { ?>
                <div class="alert alert-success" role="alert">
                    <?php
                          echo $_SESSION['success'];
                          unset( $_SESSION['success']);
                      ?>
               </div>           
            <?php } ?>
            <?php if(isset($_SESSION['warning'])) { ?>
                <div class="alert alert-warning" role="alert">
                    <?php
                          echo $_SESSION['error'];
                          unset( $_SESSION['error']);
                      ?>
               </div>           
            <?php } ?>
            
            

            <div class="mb-3">
                <lebel for="email" class="form-label">email</lebel>
                <input type="email" class="form-control" name="email" aria-describedby="email">
            </div>
            <div class="mb-3">
                <centerlebel for="password" class="form-label">Password</centerlebel>
                <input type="password" class="form-control" name="password">
            </div>
            <div class="mb-3">
                <lebel for="confirm password" class="form-label">Confirm Password</lebel>
                <input type="password" class="form-control" name="c_password">
        </div>
        <button type="submit" name="signup" class="btn btn-primary">Sign Up</button>
        </form>
    </div>
        <hr>
        <p>ยังไม่ได้เป็นสมาชิกใช่ไหมคะเธอ ถ้ายังคลิ๊กที่นี่เพื่อ<a href="apply.php" target="_blank">สมัครสมาชิกค่าาาาาาา</a></p>

</body>
</html>