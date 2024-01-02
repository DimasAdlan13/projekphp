<?php
// Koneksi database
include 'koneksi.php';

// Mendapatkan data dari form
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$hp = $_POST['hp'];
$tgl_transaksi = $_POST['tgl_transaksi'];
$jenis_barang = $_POST['jenis_barang'];
$nama_barang = $_POST['nama_barang'];
$jumlah = $_POST['jumlah'];
$harga = $_POST['harga'];

// Menyimpan data ke database
$query = "INSERT INTO adlan (nama, alamat, hp, tgl_transaksi, jenis_barang, nama_barang, jumlah, harga) VALUES ('$nama', '$alamat', '$hp', '$tgl_transaksi', '$jenis_barang', '$nama_barang', '$jumlah', '$harga')";

if (mysqli_query($conn, $query)) {
    // Jika penyimpanan berhasil, alihkan ke halaman semuadata.php
    header("location: semuadata.php");
} else {
    // Jika penyimpanan gagal, tampilkan pesan error
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
}

// Menutup koneksi database
mysqli_close($conn);
?>