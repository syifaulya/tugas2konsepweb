<?php
session_start();
if(!isset($_SESSION['username'])){
    header('Location: ../authentication/login.html');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Menu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
   body {
    font-family: 'Arial', sans-serif;
    background-color: #fef8f0; /* Latar belakang lembut krem pastel */
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

.menu-container {
    background-color: #a8d8b9; /* Warna mint segar yang lebih lembut */
    border: 2px solid #f1d4b2; /* Border krem pastel lembut */
    border-radius: 10px;
    padding: 30px;
    text-align: center;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
    width: 320px;
}

.menu-container h1 {
    font-size: 1.8em;
    color: #d56d6d; /* Coklat kemerahan untuk judul */
    margin-bottom: 25px;
}

.menu-container .btn {
    width: 100%;
    margin-bottom: 15px;
    padding: 12px;
    background-color: #f3a6b3; /* Warna peach cerah pada tombol */
    color: #4f4f4f; /* Teks gelap pada tombol */
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-size: 1em;
    font-weight: bold;
    transition: transform 0.3s, background-color 0.3s ease;
}

.menu-container .btn:hover {
    background-color: #e38a7d; /* Peach lebih gelap saat hover */
    transform: scale(1.05); /* Efek zoom saat hover */
}


    </style>

</head>
<body>
    <div class="menu-container">
        <h1>Main Menu</h1>
        <a href="../crud_project/index.php" class="btn btn-primary">Melihat Database</a>
        <a href="../dashboard/index.html" class="btn btn-danger">Logout</a>
    </div>
</body>
</html>