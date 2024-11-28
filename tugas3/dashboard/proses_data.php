<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "pendaftaran_lomba");

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data dari form
$nama = $_POST['nama'];
$email = $_POST['email'];
$nomor_telepon = $_POST['nomor_telepon'];
$tanggal_lahir = $_POST['tanggal_lahir'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$cabang_olahraga = $_POST['cabang_olahraga'];
$alamat = $_POST['alamat'];

// Simpan data ke tabel
$sql = "INSERT INTO pendaftaran (nama, email, nomor_telepon, tanggal_lahir, jenis_kelamin, cabang_olahraga, alamat)
        VALUES ('$nama', '$email', '$nomor_telepon', '$tanggal_lahir', '$jenis_kelamin', '$cabang_olahraga', '$alamat')";

if ($conn->query($sql) === TRUE) {
    // Redirect ke halaman index.html setelah pendaftaran berhasil
    header("Location: index.html");
    exit();  // Pastikan untuk menghentikan eksekusi setelah redirect
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>