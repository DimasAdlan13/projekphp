<?php
session_start(); // Inisialisasi session 
if(session_destroy()) { // Menghapus session
    header("Location: login.php");
    // Jika berhasil maka akan di-redirect ke file index.php
}
?>
