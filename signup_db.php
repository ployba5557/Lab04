<?php
    session_start();
    require_once 'config.php';

    if (isset($_POST['signup'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $c_password = $_POST['c_password'];
        $urole = 'user';

        if (empty($username)) {
            $_SESSION['error'] = 'กรุณากรอกชื่อ';
            header('Location: apply.php');
        } else if (empty($email)) {
            $_SESSION['error'] = 'กรุณากรอกอีเมล';
            header('Location: apply.php');
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = 'รูปแบบอีเมลไม่ถูกต้อง';
            header('Location: apply.php');
        } else if (empty($password)) {
            $_SESSION['error'] = 'กรุณากรอกรหัสผ่าน';
            header('Location: apply.php');
        } else if (strlen($_POST['password']) < 5) {
            $_SESSION['error'] = 'รหัสผ่านตั้งมากกว่า 5 ถึง 20 ตัว';
            header('Location: apply.php');
        } else if (empty($c_password)) {
            $_SESSION['error'] = 'กรุณายืนยันรหัสผ่าน';
            header('Location: apply.php');
        } else if ($password != $c_password) {
            $_SESSION['error'] = 'รหัสผ่านไม่ตรงกัน';
            header('Location: apply.php');
        } else {
            try {
                $check_email = $conn->prepare("SELECT email FROM users WHERE email = :email");
                $check_email->bindParam(":email", $email);
                $check_email->execute();
                $row = $check_email->fetch(PDO::FETCH_ASSOC);

                if ($row['email'] == $email) {
                    $_SESSION['warning'] ="มีอีเมลนี้อยู่แล้ว <a href='index.php'>คลิ๊กที่นี้</a> เพื่อเข้าสู่ระบบ";
                    header("Location: apply.php");
                } else if (!isset($_SESSION['error'])) {
                    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                    $stmt = $conn->prepare("INSERT INTO users(username, email, password, urole) VALUES(:username, :email, :password, :urole) ");
                    $stmt->bindParam(":username", $username);
                    $stmt->bindParam(":email", $email);
                    $stmt->bindParam(":password", $passwordHash);
                    $stmt->bindParam(":urole", $urole);
                    $stmt->execute();
                    $_SESSION['success'] = "สมัครสมาชิกเรียบร้อย! <a href='index.php' class='alert-link'>คลิ๊กที่นี้เพื่อเข้าสู่ระบบ</a>";
                    header("Location: apply.php");
                } else {
                    $_SESSION['error'] = "มีบางอย่างผิดพลาด";
                    header("Location: apply.php");
                }

            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
    }

?>