<?php
$conn = new mysqli("localhost", "root", "", "pendaftaran_lomba");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM pendaftaran WHERE id=$id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Ambil data yang ada di database
        $nama = $row['nama'];
        $email = $row['email'];
        $nomor_telepon = $row['nomor_telepon'];
        $tanggal_lahir = $row['tanggal_lahir'];
        $jenis_kelamin = $row['jenis_kelamin'];
        $cabang_olahraga = $row['cabang_olahraga'];
        $alamat = $row['alamat'];
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $nomor_telepon = $_POST['nomor_telepon'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $cabang_olahraga = $_POST['cabang_olahraga'];
    $alamat = $_POST['alamat'];

    // Query untuk update data
    $sql = "UPDATE pendaftaran SET nama='$nama', email='$email', nomor_telepon='$nomor_telepon', tanggal_lahir='$tanggal_lahir', jenis_kelamin='$jenis_kelamin', cabang_olahraga='$cabang_olahraga', alamat='$alamat' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");  // Redirect ke halaman utama setelah update
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Pengguna</title>
    <style>
        /* Reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

/* Body Style */
body {
    background-color: #fef8f0; /* Soft cream background */
}

/* Header Styling */
header {
    background-color: #f3a6b3; /* Soft peach background */
    color: #ffffff;
    padding: 20px 0;
    text-align: center;
}

header h1 {
    font-size: 24px;
    margin-bottom: 5px;
}

header p {
    font-size: 16px;
    margin: 0;
}

/* Form Container */
.form-container {
    width: 90%;
    max-width: 500px;
    margin: 30px auto;
    padding: 20px;
    background-color: #a8d8b9; /* Fresh mint background */
    border: 1px solid #f3a6b3; /* Soft peach border */
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    text-align: left;
}

.form-container h2 {
    color: #7d5b4c; /* Soft brownish-red for heading */
    text-align: center;
    margin-bottom: 20px;
}

form label {
    display: block;
    font-weight: bold;
    color: #7d5b4c; /* Dark brown for labels */
    margin-bottom: 5px;
}

form input[type="text"],
form input[type="email"],
form input[type="date"],
form input[type="tel"],
form select,
form textarea {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #7d5b4c; /* Dark brown border */
    border-radius: 4px;
    background-color: #ffffff; /* White background for inputs */
    outline: none;
    transition: border-color 0.3s;
}

form input[type="text"]:focus,
form input[type="email"]:focus,
form input[type="date"]:focus,
form input[type="tel"]:focus,
form select:focus,
form textarea:focus {
    border-color: #f3a6b3; /* Soft peach color on focus */
}

form button {
    width: 100%;
    padding: 10px;
    background-color: #f3a6b3; /* Soft peach background for button */
    color: #ffffff;
    border: none;
    border-radius: 4px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s;
}

form button:hover {
    background-color: #e38a7d; /* Darker peach on hover */
}

footer {
    background-color: #f3a6b3; /* Soft peach background */
    color: white;
    text-align: center;
    padding: 10px;
    position: fixed;
    width: 100%;
    bottom: 0;
}

/* Responsive Styling */
@media (max-width: 600px) {
    .form-container {
        width: 100%;
    }
}

    </style>
</head>
<body>

<header>
    <h1>Formulir Pendaftaran</h1>
    <p>Update Data Pengguna</p>
</header>

<div class="form-container">
    <h2>Update Pengguna</h2>
    <form method="POST" action="">
        <input type="hidden" name="id" value="<?php echo $id; ?>">

        <label for="nama">Nama</label>
        <input type="text" id="nama" name="nama" value="<?php echo $nama; ?>" required>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="<?php echo $email; ?>" required>

        <label for="nomor_telepon">Nomor Telepon</label>
        <input type="tel" id="nomor_telepon" name="nomor_telepon" value="<?php echo $nomor_telepon; ?>" required>

        <label for="tanggal_lahir">Tanggal Lahir</label>
        <input type="date" id="tanggal_lahir" name="tanggal_lahir" value="<?php echo $tanggal_pendaftaran; ?>" required>

        <label for="jenis_kelamin">Jenis Kelamin</label>
        <select name="jenis_kelamin" id="jenis_kelamin" required>
            <option value="Laki-Laki" <?php if ($jenis_kelamin == 'Laki-Laki') echo 'selected'; ?>>Laki-Laki</option>
            <option value="Perempuan" <?php if ($jenis_kelamin == 'Perempuan') echo 'selected'; ?>>Perempuan</option>
        </select>

        <label for="cabang_olahraga">Cabang Olahraga</label>
        <select name="cabang_olahraga" id="cabang_olahraga" required>
            <option value="Lari" <?php if ($cabang_olahraga == 'Lari') echo 'selected'; ?>>Lari</option>
            <option value="Tenis" <?php if ($cabang_olahraga == 'Tenis') echo 'selected'; ?>>Tenis</option>
            <option value="Renang" <?php if ($cabang_olahraga == 'Renang') echo 'selected'; ?>>Renang</option>
            <option value="Badminton" <?php if ($cabang_olahraga == 'Badminton') echo 'selected'; ?>>Badminton</option>
            <option value="Anggar" <?php if ($cabang_olahraga == 'Anggar') echo 'selected'; ?>>Anggar</option>
            <option value="Taekwondo" <?php if ($cabang_olahraga == 'Taekwondo') echo 'selected'; ?>>Taekwondo</option>
            <option value="Panahan" <?php if ($cabang_olahraga == 'Panahan') echo 'selected'; ?>>Panahan</option>
            <option value="Menembak" <?php if ($cabang_olahraga == 'Menembak') echo 'selected'; ?>>Menembak</option>
        </select>


        <label for="alamat">Alamat</label>
        <textarea id="alamat" name="alamat" value="<?php echo $alamat; ?>" required></textarea>


        <button type="submit">Update Pengguna</button>
    </form>
</div>

<footer>
        <p>&copy; 2024 Created By | Asyiffa Ulya.</p>
    </footer>

</body>
</html>