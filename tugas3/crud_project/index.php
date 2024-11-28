<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD System</title>
    <link rel="stylesheet" href="../crud_project/style.css">
</head>
<body>
    <div class="container">
        <h2>Daftar Pengguna</h2>
       
        <!-- Form Pencarian -->
        <form method="GET" action="index.php" class="search-form">
            <input type="text" name="search" placeholder="Cari Nama Pengguna" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
            <button type="submit" class="btn">Cari</button>
        </form>

        <a href="../dashboard/index.html" class="btn btn-danger">Logout</a>


        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Nomor Telepon</th>
                        <th>Tanggal Lahir</th>
                        <th>Jenis Kelamin</th>
                        <th>Cabang Olahraga</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Koneksi ke database
                    $conn = new mysqli("localhost", "root", "", "pendaftaran_lomba");
                    if ($conn->connect_error) {
                        die("Koneksi gagal: " . $conn->connect_error);
                    }

                    // Mendapatkan nilai pencarian
                    $search = isset($_GET['search']) ? $_GET['search'] : '';

                    // Tentukan jumlah data per halaman
                    $dataPerPage = 5;

                    // Menentukan halaman saat ini (default: halaman 1)
                    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                    $offset = ($page - 1) * $dataPerPage;

                    // Query untuk menghitung total data
                    $totalDataQuery = "SELECT COUNT(*) AS total FROM pendaftaran";
                    $totalDataResult = $conn->query($totalDataQuery);
                    $totalData = $totalDataResult->fetch_assoc()['total'];
                    $totalPages = ceil($totalData / $dataPerPage);

                    // Menghitung jumlah halaman
                    $totalPages = ceil($totalData / $dataPerPage);

                    // Query untuk mengambil data berdasarkan halaman
                    if ($search) {
                        $sql = "SELECT * FROM pendaftaran WHERE nama LIKE '%$search%' LIMIT $dataPerPage OFFSET $offset";
                    } else {
                        $sql = "SELECT * FROM pendaftaran LIMIT $dataPerPage OFFSET $offset";
                    }

                    $result = $conn->query($sql);

                    // Menambahkan variabel penghitung untuk nomor urut
                    $counter = $offset + 1;

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>" . $counter++ . "</td> <!-- Menampilkan nomor urut dinamis -->
                                    <td>" . $row["nama"] . "</td>
                                    <td>" . $row["email"] . "</td>
                                    <td>" . $row["nomor_telepon"] . "</td>
                                    <td>" . $row["tanggal_lahir"] . "</td>
                                    <td>" . $row["jenis_kelamin"] . "</td>
                                    <td>" . $row["cabang_olahraga"] . "</td>
                                    <td>" . $row["alamat"] . "</td>
                                    <td>
                                        <a href='update.php?id=" . $row["id"] . "' class='btn-edit'>Edit</a>
                                        <a href='delete.php?id=" . $row["id"] . "' class='btn-delete'>Hapus</a>
                                    </td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='9'>Tidak ada data ditemukan</td></tr>";
                    }

                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="pagination">
            <?php if ($page > 1): ?>
                <a href="?page=<?php echo $page - 1; ?>&search=<?php echo $search; ?>" class="btn">Prev</a>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a href="?page=<?php echo $i; ?>&search=<?php echo $search; ?>" class="btn <?php echo $i == $page ? 'active' : ''; ?>">
                    <?php echo $i; ?>
                </a>
            <?php endfor; ?>

            <?php if ($page < $totalPages): ?>
                <a href="?page=<?php echo $page + 1; ?>&search=<?php echo $search; ?>" class="btn">Next</a>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>