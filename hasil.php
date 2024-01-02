<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Captcha</title>
    <!-- Include Tailwind CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Or use a local copy of Tailwind CSS -->
    <!-- <link href="path/to/tailwind.min.css" rel="stylesheet"> -->
</head>

<body>
    <header class="bg-gray-200 py-4">
        <div class="container mx-auto">
            <div class="flex justify-between items-center">
                <div class="logo">
                    <h1 class="text-2xl font-bold">Store Dadakan</h1>
                </div>
                <div class="user-actions">
                    <div class="menu">
                        <ul class="flex space-x-4">
                            <li><a href="home1.php" class="text-blue-500">Home</a></li>
                            <li><a href="index.php" class="text-blue-500">list Pembelian</a></li>
                        </ul>
                    </div>
                    <div class="user-auth">
                        <a href="logout.php" class="btn-logout bg-red-500 text-white px-4 py-2 rounded">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <h2 class="text-center text-2xl font-bold mt-8">Informasi Login:</h2>
    <p class="text-center mt-4">
        <?php
        $nama = $_POST["username"];
        $pwd = $_POST["password"];
        session_start();
        if ($_SESSION["captcha"] != $_POST["kodecaptcha"]) {
            echo "Username anda adalah <b>$nama</b>"; echo " <br/>";
            echo "Password anda adalah <b>$pwd</b>"; echo "<br/>";
            echo "Kode Captcha anda salah";
        } else {
            echo "Username anda adalah <b>$nama</b>"; echo"<br/>";
            echo "Password anda adalah <b>$pwd</b>"; echo "<br/>";
            echo "Kode Captcha anda benar";
        }
        ?>
    </p>
</body>

</html>