<?php
include "../koneksi.php";

session_start();

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM user WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0){
        $user = $result->fetch_assoc();

        if ($password == $user['password']){
            $_SESSION['username'] = $username;
            header("location:../dashboard/main_menu.php");
            echo "Login Berhasil";
            exit;
        }else{
            echo "Password Salah";
        }
    }else{
        echo "Username tidak ditemukan";
    }
    $stmt->close();


}

$conn->close();
?>