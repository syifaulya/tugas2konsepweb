<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $conn = new mysqli("localhost", "root", "", "pendaftaran_lomba");
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    $sql = "DELETE FROM pendaftaran WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>