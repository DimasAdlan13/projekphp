<!DOCTYPE html>
<html>
<head>
    <title>Aplikasi Data Pembeli - Edit Data</title>
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
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="semua_data.php">Semua Data</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Log out</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <!-- Content -->
        <h1>Edit Data Pembeli</h1>

        <?php
        include 'koneksi.php';

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $data = mysqli_query($conn, "SELECT * FROM adlan WHERE id_pembeli='$id'");
            $d = mysqli_fetch_assoc($data);
        }

        if (isset($_POST['submit'])) {
            $id = $_POST['id'];
            $nama = $_POST['nama'];
            $alamat = $_POST['alamat'];
            $hp = $_POST['hp'];
            $tgl_transaksi = $_POST['tgl_transaksi'];
            $jenis_barang = $_POST['jenis_barang'];
            $nama_barang = $_POST['nama_barang'];
            $jumlah = $_POST['jumlah'];
            $harga = $_POST['harga'];

            $sql = "UPDATE adlan SET nama='$nama', alamat='$alamat', hp='$hp', tgl_transaksi='$tgl_transaksi', jenis_barang='$jenis_barang', nama_barang='$nama_barang', jumlah='$jumlah', harga='$harga' WHERE id_pembeli='$id'";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                header("Location: semua_data.php");
                exit();
            } else {
                echo "Gagal mengupdate data.";
            }
        }
        ?>

        <form method="post" action="update.php">
            <table class="table">
                <tr>
                    <td>ID Pembeli</td>
                    <td>
                        <input type="text" name="id_pembeli" value="<?php echo $d['id_pembeli']; ?>" readonly>
                    </td>
                </tr>
                <tr>
                    <td>Nama</td>
                    <td>
                        <input type="text" name="nama" value="<?php echo $d['nama']; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>
                        <input type="text" name="alamat" value="<?php echo $d['alamat']; ?>">
                    </td>
                </tr>
                <tr>
                    <td>HP</td>
                    <td>
                        <input type="text" name="hp" value="<?php echo $d['hp']; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Tanggal Transaksi</td>
                    <td>
                        <input type="date" name="tgl_transaksi" value="<?php echo $d['tgl_transaksi']; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Jenis Barang</td>
                    <td>
                        <input type="text" name="jenis_barang" value="<?php echo $d['jenis_barang']; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Nama Barang</td>
                    <td>
                        <input type="text" name="nama_barang" value="<?php echo $d['nama_barang']; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Jumlah</td>
                    <td>
                        <input type="text" name="jumlah" value="<?php echo $d['jumlah']; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Harga</td>
                    <td>
                        <input type="text" name="harga" value="<?php echo $d['harga']; ?>">
                    </td>
               
                </tr>
            </table>
            <input type="submit" name="submit" value="Simpan" class="btn btn-primary">
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>