<?php
// Konfigurasi database
$host = "localhost";
$username = "root";
$password = "";
$database = "dbfitnes";

$koneksi = new mysqli($host, $username, $password, $database);

// Periksa koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Inisialisasi variabel
$error = "";
$success = "";

// Ambil data berdasarkan ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM member WHERE id = $id";
    $result = $koneksi->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row['name'];
        $dob = $row['dob'];
        $gender = $row['gender'];
        $package = $row['package'];
        $duration = $row['duration'];
        $payment = $row['payment'];
    } else {
        $error = "Data tidak ditemukan.";
    }
} else {
    header("Location: utama.php");
    exit;
}

// Proses UPDATE
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $package = $_POST['package'];
    $duration = $_POST['duration'];
    $payment = $_POST['payment'];

    $sql = "UPDATE member SET name='$name', dob='$dob', gender='$gender', package='$package', duration='$duration', payment='$payment' WHERE id=$id";
    if ($koneksi->query($sql) === TRUE) {
        $success = "Data berhasil diperbarui.";
    } else {
        $error = "Gagal memperbarui data: " . $koneksi->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/asset/css/update.css">
    <title>Update Member</title>
</head>

<style>
    /* Body Style */
body {
    font-family: 'Poppins', sans-serif;
    background-color: #121212; /* Warna latar belakang gelap */
    margin: 0;
    padding: 0;
    color: #ffffff; /* Warna teks default */
}

/* Container Style */
.container {
    max-width: 30%;
    margin: 50px auto;
    background: #1c1c1c; /* Warna kotak form */
    padding: 45px;
    border-radius: 8px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
}

/* Heading */
h2 {
    text-align: center;
    color: #00ffee; /* Warna biru cerah */
    margin-bottom: 20px;
}

/* Form Style */
form {
    display: flex;
    flex-direction: column;
}

/* Label */
label {
    margin-top: 10px;
    font-weight: bold;
    color: #ffffff;
}

/* Input and Select */
input, select {
    margin-top: 5px;
    padding: 10px;
    font-size: 16px;
    border: 1px solid #333;
    border-radius: 4px;
    background: #2a2a2a; /* Warna input gelap */
    color: #ffffff;
}

/* Buttons */
.actions {
    margin-top: 20px;
    display: flex;
    font-size: 15px;
    justify-content: space-between;
}

.btn-save {
    background-color: #28a745; /* Hijau cerah */
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: 0.3s ease;
}

.btn-save:hover {
    background-color: #218838;
}

.btn-back {
    background-color: #ff0000; /* Biru cerah */
    color: white;
    text-decoration: none;
    text-align: center;
    padding: 10px 15px;
    border-radius: 5px;
    transition: 0.3s ease;
}

.btn-back:hover {
    background-color: #c50d0d;
}

/* Popup Notifikasi */
.popup {
    position: fixed;
    top: 5%;
    left: 50%;
    transform: translateX(-50%);
    padding: 10px 20px;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    z-index: 9999;
    max-width: 400px;
    font-size: 1rem;
    animation: fadeIn 0.5s ease, fadeOut 0.5s ease 3s;
    text-align: center;
    color: #fff;
}

/* Pop-Up Sukses */
.popup.success {
    background-color: #4CAF50;
}

/* Pop-Up Error */
.popup.error {
    background-color: #f44336;
}

/* Animasi Masuk */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateX(-50%) translateY(-20%);
    }
    to {
        opacity: 1;
        transform: translateX(-50%) translateY(0);
    }
}

/* Animasi Keluar */
@keyframes fadeOut {
    from {
        opacity: 1;
    }
    to {
        opacity: 0;
    }
}


/* Responsive Layout */
@media (max-width: 768px) {
    .container {
        width: 100%;
        padding: 15px;
    }

    .actions {
        flex-direction: column;
        gap: 10px;
    }
}

</style>

<body>
    <div class="container">
        <h2>Perbarui Data Member</h2>

        <!-- Notifikasi Pop-Up -->
        <?php if ($success): ?>
            <div class="popup success"><?php echo htmlspecialchars($success); ?></div>
        <?php elseif ($error): ?>
            <div class="popup error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <form method="POST" action="">
    <input type="hidden" name="id" value="<?php echo $id; ?>">

    <label for="name">Nama:</label>
    <input type="text" name="name" id="name" value="<?php echo $name; ?>" required>

    <label for="dob">Tanggal Lahir:</label>
    <input type="date" name="dob" id="dob" value="<?php echo $dob; ?>" required>

    <label for="gender">Jenis Kelamin:</label>
    <select name="gender" id="gender" required>
        <option value="Pria" <?php if ($gender == 'Pria') echo 'selected'; ?>>Pria</option>
        <option value="Wanita" <?php if ($gender == 'Wanita') echo 'selected'; ?>>Wanita</option>
    </select>

    <label for="package">Paket:</label>
    <select name="package" id="package" required>
        <option value="Pro" <?php if ($package == 'Pro') echo 'selected'; ?>>Pro</option>
        <option value="Basic" <?php if ($package == 'Basic') echo 'selected'; ?>>Basic</option>
        <option value="Premium" <?php if ($package == 'Premium') echo 'selected'; ?>>Premium</option>
    </select>

    <label for="duration">Durasi (bulan):</label>
    <input type="number" name="duration" id="duration" value="<?php echo $duration; ?>" required>

    <label for="payment">Metode Pembayaran:</label>
    <select name="payment" id="payment" required>
        <option value="e-wallet" <?php if ($payment == 'e-wallet') echo 'selected'; ?>>E-Wallet</option>
        <option value="transfer" <?php if ($payment == 'transfer') echo 'selected'; ?>>Transfer</option>
        <option value="cash" <?php if ($payment == 'cash') echo 'selected'; ?>>Cash</option>
    </select>

    <div class="actions">
        <button type="submit" name="update" class="btn-save">Simpan</button>
        <a href="utama.php" class="btn-back">Kembali</a>
    </div>
</form>

    </div>

    <!-- Script untuk Pop-Up -->
    <script>
        const popup = document.querySelector('.popup');
        if (popup) {
            setTimeout(() => {
                popup.style.opacity = '0';
                setTimeout(() => {
                    popup.style.display = 'none';
                }, 500); // Waktu transisi
            }, 3000); // Pop-Up menghilang setelah 3 detik
        }
    </script>
</body>
</html>
