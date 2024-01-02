<?php
// koneksi database 
include 'koneksi.php';

// menangkap data yang di kirim dari form
$id_pembeli = $_POST['id_pembeli'];
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$hp = $_POST['hp'];
$tgl_transaksi = $_POST['tgl_transaksi'];
$jenis_barang = $_POST['jenis_barang'];
$jumlah = $_POST['jumlah'];
$harga = $_POST['harga'];



// PUNYA DIMAS
// update data ke database 
mysqli_query($conn, "update adlan set nama='$nama', alamat='$alamat', hp = '$hp', tgl_transaksi='$tgl_transaksi', jenis_barang='$jenis_barang', jumlah='$jumlah', harga='$harga' where id_pembeli='$id_pembeli'");
// mengalihkan halaman kembali ke index.php 
header("location:index.php");
?>