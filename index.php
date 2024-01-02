<?php
//inisialisasi session 
session_start();
//mengecek username pada session
if( !isset($_SESSION['username'])){
$_SESSION['msg'] = 'anda harus login untuk mengakses halaman ini'; 
header('Location: login.php');
}

?>




<!DOCTYPE html>

<html>

<head>
    <title>Aplikasi Data Pembeli</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            padding-top: 60px;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="#">Aplikasi Data Pembeli</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="semuadata.php">Semua Data</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Log out</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <!-- Content -->
        <h1>Selamat datang di Aplikasi Data Pembeli</h1>
        <p>Ini adalah halaman utama aplikasi.</p>

        <?php
        include 'koneksi.php';

        // Fungsi untuk menghitung Total Bayar
        function hitungTotalBayar($jumlah, $harga)
        {
            return $jumlah * $harga;
        }

        // Fungsi untuk menampilkan data dengan pagination
        function tampilkanData($conn, $halaman)
        {
            $batasData = 7;
            $mulaiData = ($halaman - 1) * $batasData;

            $sql = "SELECT id_pembeli, nama, hp, nama_barang, harga, jumlah FROM adlan LIMIT $mulaiData, $batasData";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<table class='table table-bordered'>
                        <tr>
                            <th>ID Pembeli</th>
                            <th>Nama</th>
                            <th>HP</th>
                            <th>Nama Barang</th>
                            <th>Harga</th>
                            <th>Total Bayar</th>
                        </tr>";

                while ($row = $result->fetch_assoc()) {
                    $totalBayar = hitungTotalBayar($row['jumlah'], $row['harga']);

                    echo "<tr>
                            <td>{$row['id_pembeli']}</td>
                            <td>{$row['nama']}</td>
                            <td>{$row['hp']}</td>
                            <td>{$row['nama_barang']}</td>
                            <td>{$row['harga']}</td>
                            <td>{$totalBayar}</td>
                        </tr>";
                }

                echo "</table>";
            } else {
                echo "Tidak ada data.";
            }
        }

        // Mendapatkan jumlah halaman
        $sqlCount = "SELECT COUNT(*) AS jumlah FROM adlan";
        $resultCount = $conn->query($sqlCount);
        $row = $resultCount->fetch_assoc();
        $jumlahData = $row['jumlah'];
        $jumlahHalaman = ceil($jumlahData / 7);

        // Mendapatkan halaman saat ini
        $halaman = isset($_GET['halaman']) ? $_GET['halaman'] : 1;
        $halaman = max(1, min($halaman, $jumlahHalaman));

        // Panggil fungsi untuk menampilkan data dengan pagination
        tampilkanData($conn, $halaman);

        // Tampilkan navigasi pagination
        echo "<nav aria-label='Page navigation'>
                <ul class='pagination justify-content-center'>
                    <li class='page-item " . ($halaman == 1 ? 'disabled' : '') . "'>
                        <a class='page-link' href='index.php?halaman=" . ($halaman - 1) . "' aria-label='Previous'>
                            <span aria-hidden='true'>&laquo;</span>
                        </a>
                    </li>";

        for ($i = 1; $i <= $jumlahHalaman; $i++) {
            echo "<li class='page-item " . ($halaman == $i ? 'active' : '') . "'><a class='page-link' href='index.php?halaman={$i}'>{$i}</a></li>";
        }

        echo "<li class='page-item " . ($halaman == $jumlahHalaman ? 'disabled' : '') . "'>
                        <a class='page-link' href='index.php?halaman=" . ($halaman + 1) . "' aria-label='Next'>
                            <span aria-hidden='true'>&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>";
        ?>

    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>