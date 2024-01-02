<!DOCTYPE html>
<html>
<head>
    <title>Aplikasi Data Pembeli - Semua Data</title>
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
                    <a class="nav-link" href="semuadata.php">Semua Data</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Log out</a>
                </li>
            </ul>
            <form class="form-inline ml-auto" method="GET" action="semuadata.php">
                <div class="input-group">
                    <input type="text" class="form-control" name="keyword" placeholder="Cari berdasarkan ID Pembeli atau Nama">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary">Cari</button>
                    </div>
                </div>
            </form>
        </div>
    </nav>

    <div class="container">
        <!-- Content -->
        <h1>Semua Data Pembeli</h1>

        <?php
        include 'koneksi.php';

        // Proses input pencarian
        if (isset($_GET['keyword'])) {
            $keyword = $_GET['keyword'];
            tampilkanData($conn, $keyword);
        } else {
            tampilkanData($conn);
        }

        // Fungsi untuk menampilkan data
        function tampilkanData($conn, $keyword = "")
        {
            $sql = "SELECT id_pembeli, nama, alamat, hp, tgl_transaksi, jenis_barang, nama_barang, jumlah, harga FROM adlan";

            // Jika keyword pencarian tidak kosong, tambahkan kondisi WHERE
            if (!empty($keyword)) {
                $keyword = mysqli_real_escape_string($conn, $keyword);
                $sql .= " WHERE nama LIKE '%$keyword%' OR id_pembeli LIKE '%$keyword%'";
            }

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<table class='table table-bordered'>
                        <tr>
                            <th>ID Pembeli</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>HP</th>
                            <th>Tanggal Transaksi</th>
                            <th>Jenis Barang</th>
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                            <th>Aksi</th>
                        </tr>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['id_pembeli']}</td>
                            <td>{$row['nama']}</td>
                            <td>{$row['alamat']}</td>
                            <td>{$row['hp']}</td>
                            <td>{$row['tgl_transaksi']}</td>
                            <td>{$row['jenis_barang']}</td>
                            <td>{$row['nama_barang']}</td>
                            <td>{$row['jumlah']}</td>
                            <td>{$row['harga']}</td>
                            <td>
                                <a href='edit.php?id={$row['id_pembeli']}' class='btn btn-primary'>Edit</a>
                                <a href='hapus.php?id={$row['id_pembeli']}' class='btn btn-danger'>Hapus</a>
                            </td>
                        </tr>";
                }

                echo "</table>";
            } else {
                echo "Tidak ada data yang sesuai dengan pencarian.";
            }
        }

        ?>

        <a href="tambah.php" class="btn btn-success">Tambah Data</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>