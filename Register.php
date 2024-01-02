<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <link rel="stylesheet" href="style.css">

    <style>
        body {
            background-color: #f8f9fa;
        }

        .koneksitainer-fluid {
            margin-top: 50px;
        }

        .form-koneksitainer {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h4 {
            color: #007bff;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
        }

        .form-koneksitrol {
            width: 100%;
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 4px;
        }

        .text-danger {
            margin-top: -10px;
            margin-bottom: 10px;
        }

        .form-footer {
            text-align: center;
        }

        .form-footer a {
            color: #007bff;
        }

        .form-footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <?php
    // menyertakan file program koneksi.php pada register
    require('koneksi.php');
    
    // inisialisasi session
    session_start();
    
    $error = '';
    $validate = '';
    
    // cek apakah user sudah login, jika ya, redirect ke index.php
    if (isset($_SESSION['username'])) {
        header('Location: index.php');
    }

    // mengecek apakah form telah disubmit
    if (isset($_POST['submit'])) {
        // menghilangkan backslashes
        $username = stripslashes($_POST['username']);
        $username = mysqli_real_escape_string($conn, $username);

        $name = stripslashes($_POST['name']);
        $name = mysqli_real_escape_string($conn, $name);

        $email = stripslashes($_POST['email']);
        $email = mysqli_real_escape_string($conn, $email);

        $password = stripslashes($_POST['password']);
        $password = mysqli_real_escape_string($conn, $password);

        $repass = stripslashes($_POST['repassword']);
        $repass = mysqli_real_escape_string($conn, $repass);

        // cek apakah semua field diisi
        if (!empty(trim($name)) && !empty(trim($username)) && !empty(trim($email)) && !empty(trim($password)) && !empty(trim($repass))) {
            // cek apakah password dan re-password sama
            if ($password == $repass) {
                // cek apakah username sudah terdaftar
                if (cek_nama($username, $conn) == 0) {
                    // hashing password sebelum disimpan di database
                    $pass = password_hash($password, PASSWORD_DEFAULT);
                    // insert data ke database
                    $query = "INSERT INTO users (username, name, email, password) VALUES ('$username', '$name', '$email', '$pass')";
                    $result = mysqli_query($conn, $query);

                    // jika insert data berhasil maka akan di-redirect ke halaman index.php serta menyimpan data username ke session
                    if ($result) {
                        $_SESSION['username'] = $username;
                        header('Location: index.php');
                    } else {
                        $error = 'Register User Gagal!!';
                    }
                } else {
                    $error = 'Username sudah terdaftar!!';
                }
            } else {
                $validate = 'Password tidak sama!!';
            }
        } else {
            $error = 'Data tidak boleh kosong!!';
        }
    }

    // fungsi untuk mengecek username apakah sudah terdaftar atau belum
    function cek_nama($username, $conn) {
        $nama = mysqli_real_escape_string($conn, $username);
        $query = "SELECT * FROM users WHERE username = '$nama'";
        $result = mysqli_query($conn, $query);
        return mysqli_num_rows($result);
    }
    ?>

<section class="koneksitainer-fluid mb-4">
        <section class="row justify-content-center"> <!-- Changed to justify-content-center -->
            <section class="col-12 col-sm-6 col-md-4">
                <form class="form-koneksitainer mx-auto" action="register.php" method="POST"> <!-- Added mx-auto -->
                    <h4 class="text-center font-weight-bold"> Sign-Up </h4>
                    <?php if ($error != '') { ?>
                        <div class="alert alert-danger" role="alert"><?= $error; ?></div>
                    <?php } ?>

                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-koneksitrol" id="name" name="name" placeholder="Masukkan Nama">
                    </div>

                    <div class="form-group">
                        <label for="InputEmail">Alamat Email</label>
                        <input type="email" class="form-koneksitrol" id="InputEmail" name="email" aria-describedby="emailHelp" placeholder="Masukkan email">
                    </div>

                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-koneksitrol" id="username" name="username" placeholder="Masukkan username">
                    </div>

                    <div class="form-group">
                        <label for="InputPassword">Password</label>
                        <input type="password" class="form-koneksitrol" id="InputPassword" name="password" placeholder="Password">
                        <?php if ($validate != '') { ?>
                            <p class="text-danger"><?= $validate; ?></p>
                        <?php } ?>
                    </div>

                    <div class="form-group">
                        <label for="InputRePassword">Re-Password</label>
                        <input type="password" class="form-koneksitrol" id="InputRePassword" name="repassword" placeholder="Re-Password">
                        <?php if ($validate != '') { ?>
                            <p class="text-danger"><?= $validate; ?></p>
                        <?php } ?>
                    </div>

                    <button type="submit" name="submit" class="btn btn-primary btn-block">Register</button>
                    <div class="form-footer mt-2">
                        <p> Sudah punya account? <a href="login.php">Login</a></p>
                    </div>
                </form>
            </section>
        </section>
    </section>

    <!-- Bootstrap requirement jQuery pada posisi pertama, kemudian Popper.js, dan yang terakhit Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ60W/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>