<?php
include 'koneksi.php';

$id_pembeli = $_GET['id'];

// Menghapus data dari database
mysqli_query($conn, "DELETE FROM adlan WHERE id_pembeli='$id_pembeli'");

// Mengalihkan halaman kembali ke semua_data.php
header("location:semuadata.php");
?>