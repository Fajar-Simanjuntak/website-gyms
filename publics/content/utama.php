<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/asset/css/utama.css">
    <title>CRUD System</title>
    <style>

        /* General Reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    text-decoration: none;
    list-style: none;
    font-family: "Arial", sans-serif;
}

body {
    background-color: #121212;
    color: black;
    font-family: 'Arial', sans-serif;
    line-height: 1.6;   
    margin: 0;
    padding: 0;
}

h2 {
    text-align: center;
    color: #000000;
}

.kata-kata {
    text-align: center;
    color: white;
}

/* Header */
.header {
    background-color: black;
    color: white;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 5%;
}

/* .logo {
    font-size: 1.5rem;
    font-weight: bold;
    cursor: pointer;
}

.logo span {
    color: ;
} */

.logo {
    font-size: 2rem;
    color: white;
    font-weight: 800;
    cursor: pointer;
    transition: 0.3s ease-in-out;
}

.logo:hover {
    transform: scale(1.1);
}

span {
    color: #00FFEE;
}

.navbar {
    display: flex;
    gap: 15px;
}

.navbar a {
    color: white;
    text-decoration: none;
    padding: 5px 10px;
    border-radius: 5px;
    transition: background-color 0.3s;
}

.navbar a:hover {
    background-color: #17a2b8;
}

/* Main Content */
.container {
    max-width: 1200px;
    margin: 20px auto;
    padding: 20px;
    background: #eaeaea;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
}

/* Table */
.table-container {
    overflow-x: auto;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

table th, table td {
    padding: 10px;
    text-align: left;
    border: 1px solid #000000;
}

table th {
    background-color: #17a2b8;
    color: #121212;
}

table tr:nth-child(odd) {
    background-color: #f8f9fa;
}

table tr:nth-child(even) {
    background-color: #e9ecef;
}

/* Buttons */
button {
    padding: 8px 12px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 0.9rem;
    margin: 5px 0;
}

.btn-edit {
    background-color: #28a745; /* Hijau untuk "Edit" */
    color: white;
    padding: 8px 12px; /* Sama seperti .btn-delete */
    border: none;
    border-radius: 4px; /* Sama seperti .btn-delete */
    cursor: pointer;
    font-size: 0.9rem;
    display: inline-block;
    text-align: center;
}

.btn-edit:hover {
    background-color: #218838; /* Warna hijau lebih gelap saat hover */
}


.btn-edit {
    background-color: #28a745;
    color: white;
}

.btn-edit:hover {
    background-color: #218838;
}

.btn-delete {
    background-color: #dc3545;
    color: white;
}

.btn-delete:hover {
    background-color: #c82333;
}

/* Form */
.search-form {
    display: flex;
    justify-content: center;
    margin-bottom: 20px;
    gap: 10px;
}

.search-form input {
    padding: 8px;
    border: 1px solid #ced4da;
    border-radius: 4px;
    width: 250px;
}

.search-form button {
    padding: 8px 12px;
    background-color: #17a2b8;
    color: white;
    border-radius: 4px;
}

.search-form button:hover {
    background-color: #138496;
}

/* Pagination */
.pagination {
    display: flex;
    justify-content: center;
    gap: 5px;
}

.pagination a {
    padding: 8px 12px;
    border: 1px solid #17a2b8;
    color: #17a2b8;
    border-radius: 4px;
    text-decoration: none;
    transition: background-color 0.3s, color 0.3s;
}

.pagination a.active {
    background-color: #17a2b8;
    color: white;
}

.pagination a:hover {
    background-color: #138496;
    color: white;
}

/* Responsiveness */
@media (max-width: 768px) {
    .header {
        flex-direction: column;
        text-align: center;
    }

    .navbar {
        flex-direction: column;
        gap: 10px;
    }

    .container {
        padding: 15px;
    }

    .search-form {
        flex-direction: column;
        gap: 5px;
    }

    table th, table td {
        font-size: 0.9rem;
    }

    .pagination a {
        padding: 6px 8px;
    }
}

@media (max-width: 480px) {
    .logo {
        font-size: 1.2rem;
    }

    .search-form input {
        width: 100%;
    }

    table th, table td {
        font-size: 0.8rem;
        padding: 6px;
    }

    .pagination a {
        font-size: 0.8rem;
    }
}


            /* Modal Konfirmasi */
    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        justify-content: center;
        align-items: center;
        z-index: 1000;
        animation: fadeIn 0.3s;
    }

    .modal-content {
        background-color: #ffffff;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        text-align: center;
        width: 320px;
        animation: slideIn 0.3s;
    }

    .modal p {
        font-size: 18px;
        color: #333333;
        margin-bottom: 20px;
    }

    .modal-buttons {
        display: flex;
        justify-content: space-between;
        gap: 15px;
    }

    .btn-confirm,
    .btn-cancel {
        padding: 10px 20px;
        font-size: 14px; 
        border-radius: 8px;
        cursor: pointer;
        border: none;
        transition: 0.3s;
    }

    .btn-confirm {
        background-color: #d9534f;
        color: white;
    }

    .btn-cancel {
        background-color: #5bc0de;
        color: white;
    }

    .btn-confirm:hover {
        background-color: #c9302c;
    }

    .btn-cancel:hover {
        background-color: #46b8da;
    }

    /* Pop-Up Sukses */
  /* Pop-Up Sukses */
  .popup-success {
        display: none;
        position: fixed;
        top: 10%; /* Letakkan di bagian atas tengah */
        left: 50%; /* Letakkan di tengah secara horizontal */
        transform: translate(-50%, -50%); /* Pastikan berada di tengah secara sempurna */
        background-color: #5cb85c;
        color: white;
        padding: 15px 25px;
        border-radius: 8px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        z-index: 1000;
        animation: fadeInOut 3s;
        font-size: 16px;
        text-align: center;
    }

    /* Animasi */
    @keyframes fadeInOut {
        0% {
            opacity: 0;
            transform: translate(-50%, -60%);
        }
        10%, 90% {
            opacity: 1;
            transform: translate(-50%, -50%);
        }
        100% {
            opacity: 0;
            transform: translate(-50%, -40%);
        }
    }

    </style>
</head>
<body>

<header class="header">
        <a href="#home" class="logo">Fajar <span>Sadboy</span></a>

        <ul class="navbar">
            <li><a href="admin.php">Logout</a></li>
        </ul>
    </header>

<div class="kata-kata">
    <h1>Anggota Member GYMs Ajaa</h1>
    <p>Semakin kau menerima banyak luka<br>maka kau akan semakin kuat<br>- GYMs Simajuntak -</p>
    </div>

<div class="container">
    <h2>Daftar Member GYMs</h2>

    <!-- Form Pencarian -->
    <form method="GET" action="" class="search-form">
        <input type="text" name="search" placeholder="Cari berdasarkan nama" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
        <button type="submit" class="cari">Cari</button>
        <button type="button" class="reset" onclick="window.location.href='?'">Reset</button>
    </form>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Dob</th>
                    <th>Gender</th>
                    <th>Package</th>
                    <th>Duration</th>
                    <th>Payment</th>
                    <th>Registration</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Koneksi ke database
                $conn = new mysqli("localhost", "root", "", "dbfitnes");
                if ($conn->connect_error) {
                    die("Koneksi gagal: " . $conn->connect_error);
                }

                // Hapus data jika dikonfirmasi
                if (isset($_GET['delete_id'])) {
                    $id = $_GET['delete_id'];
                    $sql1 = "DELETE FROM member WHERE id = '$id'";
                    $q1 = $conn->query($sql1);
                    if ($q1) {
                        echo "<script>
                                setTimeout(() => {
                                    document.getElementById('popup-success').style.display = 'block';
                                    setTimeout(() => window.location.href = 'utama.php', 2000);
                                }, 500);
                              </script>";
                    }
                }

                // Pengaturan Pagination
                $limit = 5; // Jumlah data per halaman
                $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                $offset = ($page - 1) * $limit;

                // Mencari data berdasarkan input pencarian
                $search = isset($_GET['search']) ? $_GET['search'] : '';
                $sql = "SELECT * FROM member WHERE name LIKE '%$search%' LIMIT $limit OFFSET $offset";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>" . $row["id"] . "</td>
                            <td>" . $row["name"] . "</td>
                            <td>" . $row["dob"] . "</td>
                            <td>" . $row["gender"] . "</td>
                            <td>" . $row["package"] . "</td>
                            <td>" . $row["duration"] . "</td>
                            <td>" . $row["payment"] . "</td>
                            <td>" . $row["registration_date"] . "</td>
                            <td>
                                <a href='update.php?id=" . $row["id"] . "' class='btn-edit'>Edit</a>
                                <button class='btn-delete' onclick=\"showDeleteModal('" . $row["id"] . "')\">Hapus</button>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='9'>Tidak ada data</td></tr>";
                }

                // Menghitung total halaman
                $sql_total = "SELECT COUNT(*) as total FROM member WHERE name LIKE '%$search%'";
                $result_total = $conn->query($sql_total);
                $total_data = $result_total->fetch_assoc()['total'];
                $total_pages = ceil($total_data / $limit);

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>

    <!-- Pagination Links -->
    <div class="pagination">
        <?php if ($page > 1): ?>
            <a href="?page=<?php echo $page - 1; ?>&search=<?php echo $search; ?>">Previous</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <a href="?page=<?php echo $i; ?>&search=<?php echo $search; ?>" <?php if ($i == $page) echo 'class="active"'; ?>>
                <?php echo $i; ?>
            </a>
        <?php endfor; ?>

        <?php if ($page < $total_pages): ?>
            <a href="?page=<?php echo $page + 1; ?>&search=<?php echo $search; ?>">Next</a>
        <?php endif; ?>
    </div>
</div>

<!-- Modal Konfirmasi -->
<div id="modal" class="modal">
    <div class="modal-content">
        <p>Apakah Anda yakin ingin menghapus data ini?</p>
        <div class="modal-buttons">
            <button id="confirm-delete" class="btn-confirm">Ya</button>
            <button onclick="hideModal()" class="btn-cancel">Tidak</button>
        </div>
    </div>
</div>

<!-- Pop-Up Sukses -->
<div id="popup-success" class="popup-success">
    <p>✅ Data berhasil dihapus!</p>
</div>

<script>
    function showDeleteModal(id) {
        const modal = document.getElementById('modal');
        const confirmDelete = document.getElementById('confirm-delete');
        confirmDelete.onclick = () => {
            window.location.href = `?delete_id=${id}`;
        };
        modal.style.display = 'flex';
    }

    function hideModal() {
        const modal = document.getElementById('modal');
        modal.style.display = 'none';
    }

    // Fungsi menampilkan pop-up notifikasi sukses
    function showSuccessPopup() {
        const popup = document.getElementById('popup-success');
        popup.style.display = 'block';
        setTimeout(() => {
            popup.style.display = 'none';
        }, 3000);
    }

    // Pemanggilan otomatis notifikasi sukses
    if (window.location.search.includes('success=true')) {
        showSuccessPopup();
    }
</script>

</body>
</html>
