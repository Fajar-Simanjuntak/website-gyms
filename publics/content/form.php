<?php
// Konfigurasi database
$host = "localhost";
$username = "root";
$password = "";
$database = "dbfitnes";

// Membuat koneksi
$conn = new mysqli($host, $username, $password, $database);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Variabel untuk pesan
$successMessage = "";
$errorMessage = "";

// Ambil data dari form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $package = $_POST['package'];
    $duration = $_POST['duration'];
    $payment = $_POST['payment'];

    // Proses file upload
    $target_dir = "uploads/";
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0755, true); // Buat folder jika belum ada
    }

    $payment_proof = $_FILES['payment-proof'];
    $filename = basename($payment_proof['name']);
    $target_file = $target_dir . time() . "_" . $filename; // Tambahkan timestamp agar unik
    $upload_ok = true;
    $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Validasi tipe file
    if (!in_array($file_type, ['jpg', 'jpeg', 'png', 'pdf'])) {
        $errorMessage = "Hanya file JPG, JPEG, PNG, dan PDF yang diperbolehkan.";
        $upload_ok = false;
    }

    if ($upload_ok) {
        if (move_uploaded_file($payment_proof['tmp_name'], $target_file)) {
            // Simpan data ke database
            $sql = "INSERT INTO member (name, dob, gender, package, duration, payment, file)
                    VALUES ('$name', '$dob', '$gender', '$package', '$duration', '$payment', '$target_file')";

            if ($conn->query($sql) === TRUE) {
                $successMessage = "Pendaftaran berhasil!";
            } else {
                $errorMessage = "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            $errorMessage = "Gagal mengunggah file.";
        }
    } else {
        $errorMessage = "Pengunggahan file dibatalkan.";
    }
}

// Tutup koneksi
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form Pendaftaran Gym</title>
</head>

<style>

/* Global Styling */
body {
    font-family: 'Poppins', sans-serif; /* Gunakan font modern */
    margin: 0;
    padding: 0;
    background-color: #000; /* Warna background hitam */
    color: #fff; /* Teks berwarna putih */
    line-height: 1.6; /* Tambah jarak antar teks */
}


.header {
    text-align: center;
    background-color: #00ffee;
    color: black;
    padding-top: 20px;
    padding-bottom: 10px;
}

h2, h3 {
    color: #00ffee; /* Warna heading biru terang */
    text-align: center;
    margin-bottom: 20px;
}

form {
    max-width: 500px;
    margin: 50px auto; /* Tambahkan jarak vertikal */
    padding: 50px;
    background-color: #111; /* Background form */
    border-radius: 15px; /* Sudut form lebih membulat */
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.3); /* Tambah efek bayangan */
}

label {
    font-weight: 600; /* Teks lebih tebal */
    display: block;
    margin-bottom: 10px;
}

input, select, button {
    width: 100%;
    padding: 12px;
    margin-bottom: 20px; /* Tambah jarak antar elemen */
    border: 1px solid #333; /* Tambahkan border */
    border-radius: 8px; /* Sudut lebih membulat */
    background-color: #222; /* Input background gelap */
    color: #fff;
    font-size: 16px; /* Teks lebih besar */
    transition: all 0.3s ease; /* Animasi transisi */
}

input:focus, select:focus {
    outline: none;
    border-color: #00ffee; /* Fokus biru */
    box-shadow: 0 0 5px #00ffee; /* Tambah efek glow */
}

input[type="radio"] {
    display: none; /* Sembunyikan radio button default */
}

input[type="radio"] + label {
    display: inline-block; /* Buat label sejajar */
    padding: 10px 20px;
    margin: 0 10px 20px 0; /* Tambah jarak antar opsi */
    border: 2px solid #333; /* Tambah border */
    border-radius: 20px; /* Membuat label membulat */
    background-color: #222; /* Warna latar belakang */
    color: #fff;
    cursor: pointer;
    transition: all 0.3s ease;
}

input[type="radio"]:checked + label {
    background-color: #00ffee; /* Warna latar belakang saat dipilih */
    color: #000; /* Warna teks saat dipilih */
    border-color: #00ffee; /* Border saat dipilih */
}

input[type="radio"] + label:hover {
    background-color: #444; /* Efek hover */
}

input[type="file"] {
    background-color: transparent;
    padding: 5px; /* Sesuaikan padding */
}

button {
    background-color: #00ffee; /* Warna utama */
    color: black;
    border: none;
    cursor: pointer;
    font-weight: bold;
    font-size: 16px;
    border-radius: 10px; /* Sudut lebih membulat */
    transition: all 0.3s ease; /* Tambah animasi */
}

button:hover {
    background-color: #00ffee; /* Warna hover */
    transform: scale(1.05); /* Animasi zoom */
}

a {
    color: #00ffee;
    text-decoration: none;
    font-weight: bold;
}

a:hover {
    text-decoration: underline;
}

/* Styling khusus untuk error */
.error {
    color: #ff4d4d; /* Warna merah cerah */
    font-size: 14px;
    margin-top: -10px;
    margin-bottom: 15px;
    display: block;
}


/* Popup Notifikasi */
.popup {
    position: fixed;
    top: 1%;
    left: 50%;
    transform: translateX(-50%);
    padding: 2px 18px;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    z-index: 9999;
    display: flex;
    justify-content: space-between;
    align-items: center;
    max-width: 350px;
    font-size: 1rem;
    animation: fadeIn 0.5s ease, fadeOut 0.5s ease 3s;
    background-color: #4CAF50; /* Hijau untuk pesan sukses */
    color: white;
}

/* Animasi Masuk */
@keyframes fadeIn {
    from {
        opacity: 0;
        top: 1%;
    }
    to {
        opacity: 1;
        top: 1%;
    }
}

/* Animasi Keluar */
@keyframes fadeOut {
    from {
        opacity: 1;
        top: 1%;
    }
    to {
        opacity: 0;
        top: 1%;
    }
}

/* Responsif */
@media (max-width: 768px) {
    .popup {
        max-width: 90%;
        font-size: 0.9rem;
    }
}



/* Responsif */
@media (max-width: 768px) {
    form {
        padding: 20px;
    }

    input, select, button {
        font-size: 14px;
    }
}

</style>

<body>

    <header class="header">
        <h1>Pendaftaran Member</h1>
        <p>Selamat datang di pusat kebugaran kami!</p>
      </header>

        <!-- Notifikasi popup -->
   <!-- Notifikasi popup -->
   <?php if (!empty($successMessage)): ?>
    <div class="popup success">
        <p><?= htmlspecialchars($successMessage); ?></p>
    </div>
<?php endif; ?>

  <h2>Pendaftaran Gym</h2>

  <form action="" method="post" enctype="multipart/form-data">
    <h3>Data Pribadi</h3>
    <label for="name">Nama Lengkap:</label>
    <input type="text" id="name" name="name" required>


    <label for="dob">Tanggal Lahir:</label>
    <input type="date" id="dob" name="dob" required><br><br>

    <label>Jenis Kelamin:</label><br>
    <input type="radio" id="male" name="gender" value="Pria" required>
    <label for="male">Pria</label>
    <input type="radio" id="female" name="gender" value="Wanita" required>
    <label for="female">Wanita</label><br><br>

    <h3>Paket Keanggotaan</h3>
    <label for="package">Pilih Paket:</label>
    <select id="package" name="package">
      <option value="basic">Basic</option>
      <option value="pro">Pro</option>
      <option value="premium">Premium</option>
    </select><br><br>

    <label for="duration">Durasi Paket:</label>
    <select id="duration" name="duration">
      <option value="1">1 bulan</option>
      <option value="3">3 bulan</option>
      <option value="6">6 bulan</option>
      <option value="12">12 bulan</option>
    </select><br><br>

    <label for="payment">Metode Pembayaran:</label>
    <select id="payment" name="payment">
      <div class="opsi-paket">
      <option value="transfer">Transfer Bank</option>
      <option value="e-wallet">E-Wallet</option>
      <option value="cash">Tunai</option>
      </div>
    </select><br><br>

    <label for="payment-proof">Unggah Bukti Pembayaran:</label>
    <input type="file" id="payment-proof" name="payment-proof" accept="image/*,application/pdf" required><br><br>

    <button type="submit">Daftar</button>
  </form>

   <!-- Tambahkan script untuk close popup -->
   <script>
    const popup = document.querySelector('.popup');
    if (popup) {
      setTimeout(() => {
        popup.style.opacity = '0';
        popup.style.display = 'none';
      }, 3000); // Popup menghilang setelah 3 detik
    }

    // Fungsi untuk menutup popup
    function closePopup() {
      if (popup) popup.style.display = 'none';
    }
  </script>

</body>
</html>
