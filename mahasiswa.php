<?php
$db_host = 'localhost:8111';
$db_user = 'root';
$db_pass = '';
$db_name = 'akademik';

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if(!$conn){
    die('Not Connected to mysql : ' . mysqli_connect_error());
}
else {
    echo "Connected to Mysql !<br>";
}

$sql = "CREATE TABLE Mahasiswa (
    Nama VARCHAR(20),
    NIM INT(5),
    Tugas INT(5),
    UTS INT(5),
    UAS INT(5),
    Nilai_Akhir FLOAT
)";

if (mysqli_query($conn, $sql)) {
    echo "Tabel Mahasiswa berhasil dibuat";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}


// Menambahkan data ke tabel mahasiswa
$sql = "INSERT INTO Mahasiswa (Nama, NIM, Tugas, UTS, UAS) VALUES
    ('Dimas', 10100, 80, 75, 85),
    ('Roy', 10101, 90, 85, 95),
    ('Adri',10102, 70, 80, 75),
    ('Niki', 10103, 85, 90, 80),
    ('Ceria',10104, 95, 85, 90)";

if (mysqli_query($conn, $sql)) {
    echo "Data berhasil ditambahkan ke tabel Mahasiswa";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// Menghitung nilai akhir dan menyimpannya ke dalam kolom Nilai_Akhir
$sql = "UPDATE Mahasiswa SET Nilai_Akhir = (Tugas + UTS + UAS) / 3";

if (mysqli_query($conn, $sql)) {
    echo "Nilai akhir berhasil dihitung dan disimpan <BR>";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// Menampilkan semua data dari tabel mahasiswa
$sql = "SELECT * FROM Mahasiswa";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo "<table>";
    echo "<tr>";
    echo "<th>Nama</th>";
    echo "<th>NIM</th>";
    echo "<th>Tugas</th>";
    echo "<th>UTS</th>";
    echo "<th>UAS</th>";
    echo "<th>Nilai Akhir</th>";
    echo "</tr>";
    
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row["Nama"] . "</td>";
        echo "<td>" . $row["NIM"] . "</td>";
        echo "<td>" . $row["Tugas"]. "</td>";
        echo "<td>" . $row["UTS"] . "</td>";
        echo "<td>" . $row["UAS"] . "</td>";
        echo "<td>" . $row["Nilai_Akhir"] . "</td>";
        echo "</tr>";
    }
    
    echo "</table>";
} else {
    echo "Tidak ada data mahasiswa";
}
?>