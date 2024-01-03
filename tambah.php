<!DOCTYPE html>
<html>
<head>
    <title>Aplikasi Data Pembeli - Tambah Data</title>
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
        <a class="navbar-brand" href="#">Aplikasi Data Pembeliharian hari hari hari</a>
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
        </div>
    </nav>

    <div class="container">
        <!-- Content -->
        <h1>Tambah Data Pembeli</h1>

        <form action="tambah_data.php" method="POST">
        <form id="formTambahData">
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat:</label>
                <input type="text" class="form-control" id="alamat" name="alamat" required>
            </div>
            <div class="form-group">
                <label for="hp">Nomor HP:</label>
                <input type="text" class="form-control" id="hp" name="hp" required>
            </div>
            <div class="form-group">
                <label for="tgl_transaksi">Tanggal Transaksi:</label>
                <input type="date" class="form-control" id="tgl_transaksi" name="tgl_transaksi" required>
            </div>
            <div class="form-group">
                <label for="jenis_barang">Jenis Barang:</label>
                <input type="text" class="form-control" id="jenis_barang" name="jenis_barang" required>
            </div>
            <div class="form-group">
                <label for="nama_barang">Nama Barang:</label>
                <input type="text" class="form-control" id="nama_barang" name="nama_barang" required>
            </div>
            <div class="form-group">
                <label for="jumlah">Jumlah:</label>
                <input type="number" class="form-control" id="jumlah" name="jumlah" required>
            </div>
            <div class="form-group">
                <label for="harga">Harga:</label>
                <input type="number" class="form-control" id="harga" name="harga" required>
            </div>
            <button type="submit" class="btn btn-primary" onclick="tambahData()">Tambah</button>
        </form>
        <div id="pesan"></div>


    </div>

<script>
function tambahData() {
    var form = document.getElementById("formTambahData");
    var xhr = new XMLHttpRequest();
    var url = "tambah_data.php"; // Ganti dengan URL yang sesuai

    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var response = xhr.responseText;
            document.getElementById("pesan").innerHTML = response;
            form.reset(); // Mengosongkan formulir setelah pengiriman berhasil
        }
    };

    var formData = new FormData(form);
    xhr.send(formData);
}
</script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
