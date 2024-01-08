<?php
require("koneksi.php");

session_start();

if (isset($_SESSION['username'])) {
    header('Location: index.php');
}

if (isset($_POST["submit"])) {
    $username = mysqli_real_escape_string($conn, stripslashes($_POST['username']));
    $password = mysqli_real_escape_string($conn, stripslashes($_POST['password']));
    $captcha = $_POST['kodecaptcha'];
    $captchaSession = $_SESSION['captcha'];
    
    // Menambahkan inisialisasi variabel error
    $error = '';

    if (!empty(trim($username)) && !empty(trim($password))) {
        if ($captcha == $captchaSession) {
            $query = "SELECT * FROM users WHERE username = '$username'";
            $result = mysqli_query($conn, $query);
            $rows = mysqli_num_rows($result);

            if ($rows != 0) {
                $hash = mysqli_fetch_assoc($result)['password'];

                if (password_verify($password, $hash)) {
                    $_SESSION['username'] = $username;
                    header('Location: index.php');
                } else {
                    $error = 'Login Failed';
                }
            } else {
                $error = 'Data cannot be empty';
            }
        } else {
            // Menetapkan pesan error untuk kesalahan captcha
            $error = 'Kode captcha yang dimasukan salah';
        }
    } else {
        $error = 'Data tidak boleh kosong!!';
    }
}
?>






<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
        crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background-color: #f8f9fa;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }

        .form-koneksitainer {
            background-color: #ffffff;
            border: 1px solid #ced4da;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0px 0px 10px 0px #000000;
            width: 100%;
            max-width: 400px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .alert {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="form-koneksitainer">
        <form class="text-left" action="login.php" method="POST">
            <h4 class="font-weight-bold mb-4">Sign-In</h4>
            <?php if(isset($error) && $error != '') { ?>
                <div class="alert alert-danger" role="alert"><?= $error; ?></div>
            <?php } ?>

            <div class="form-group">
                <label for="username">Usernameeeeeeee</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username">
            </div>

            <div class="form-group">
                <label for="InputPassword">Password</label>
                <input type="password" class="form-control" id="InputPassword" name="password"
                    placeholder="Enter your password">
                <?php if(isset($validate) && $validate != '') { ?>
                    <p class="text-danger"><?= $validate; ?></p>
                <?php } ?>
            </div>

            <div class="form-group">
                        <label for="InputCaptcha">Captcha</label>
                        <div class="captcha-container">
                            <img src="captcha.php" alt="Captcha Image">
                        </div>
                        <input type="text" class="form-control" name="kodecaptcha" id="InputCaptcha"
                            placeholder="Enter Captcha">
                    </div>


            <button type="submit" name="submit" class="btn btn-primary btn-block">Sign In</button>

            <div class="form-footer mt-2">
                <p>Don't have an account?????? <a href="register.php">Register</a></p>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965Dz00rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/18WvCWPIPm49"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ60W/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
