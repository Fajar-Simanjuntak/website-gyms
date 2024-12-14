<?php
session_start();

// Array user dengan username dan password
$users = [
    ['username' => 'fajar', 'password' => '123'],
    ['username' => 'fajar siregar', 'password' => '123'],
    ['username' => 'fajar simajuntak', 'password' => '123'],
    ['username' => 'fajar halilintar', 'password' => '123'],
    ['username' => 'fajar siapakek', 'password' => '123']
];

// Variabel untuk pesan error
$errorMessage = "";

// Proses login
if (isset($_POST['Login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $userFound = false; // Menyimpan status apakah username ditemukan
    $passwordCorrect = false; // Menyimpan status apakah password cocok

    // Validasi input kosong
    if (empty($username) || empty($password)) {
        $errorMessage = "Username dan Password masih kosong!";
    } else {
        // Periksa username dan password dalam array
        foreach ($users as $user) {
            if ($user['username'] === $username) {
                $userFound = true;
                if ($user['password'] === $password) {
                    $passwordCorrect = true;
                    // Login berhasil
                    $_SESSION['login'] = 1;
                    $_SESSION['username'] = $username;
                    header("Location: utama.php");
                    exit();
                }
                break; // Hentikan loop jika username ditemukan
            }
        }

        // Berikan pesan error sesuai kondisi
        if (!$userFound) {
            $errorMessage = "Username tidak terdaftar!";
        } elseif (!$passwordCorrect) {
            $errorMessage = "Password yang dimasukkan salah!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form Login</title>
</head>

<style>
  /* Global Styles */
body {
    background-color: #1e1e1e;
    font-family: 'Poppins', sans-serif;
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
    min-height: 100vh;
  }
  
  h1, h2, p {
    margin: 0;
    padding: 0;
  }
  
  /* Header */
  .header {
    background-color: #00ffee;
    color: black;
    padding: 20px 0;
    text-align: center;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
  }
  
  .header h1 {
    font-size: 2rem;
  }
  
  .header p {
    font-size: 1rem;
    margin-top: 5px;
  }
  
  /* Footer */
  .footer {
    background-color: #333;
    color: black;
    text-align: center;
    padding: 10px 0;
    margin-top: auto;
    font-size: 0.9rem;
  }
  
  .footer p {
    margin: 0;
  }
  
  /* Form Login */
  .container {
    background-color: #fff;
    padding: 40px;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    text-align: center;
    margin: 40px auto;
    width: 90%;
    max-width: 400px;
  }
  
  .container img {
    display: block;
    max-width: 100px;
    margin: 0 auto 20px;
  }
  
  .container h2 {
    margin-bottom: 20px;
    color: #333;
  }
  
  .container input[type="text"],
  .container input[type="password"] {
    width: 100%;
    padding: 12px 15px;
    margin: 10px 0;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    font-size: 16px;
  }
  
  .container input[type="submit"] {
    background-color: #00ffee;
    color: black;
    font-weight: bold;
    padding: 12px 20px;
    margin: 15px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 18px;
    transition: background-color 0.3s ease;
  }
  
  .container input[type="submit"]:hover {
    background-color: #02948b;
  }
  
  /* Popup Notifikasi */
  .popup {
    position: fixed;
    top: 15%;
    left: 50%;
    transform: translateX(-50%);
    background-color: #ff4d4d;
    color: black;
    padding: 1rem 2rem;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    z-index: 9999;
    display: flex;
    justify-content: space-between;
    align-items: center;
    max-width: 300px;
    font-size: 1rem;
    animation: fadeIn 0.5s ease;
  }
  
  .popup p {
    margin: 0;
    text-align: left;
    flex: 1;
  }
  
  .popup .close-btn {
    background: none;
    border: none;
    color: black;
    font-size: 1.2rem;
    cursor: pointer;
    margin-left: 10px;
  }
  
  /* Animasi Popup */
  @keyframes fadeIn {
    from {
        opacity: 0;
        top: 10%;
    }
    to {
        opacity: 1;
        top: 15%;
    }
  }
  
</style>

<body>
  <!-- Header -->
  <header class="header">
    <h1>Selamat Datang</h1>
    <p>Website Sederhana</p>
  </header>

  <!-- Notifikasi popup -->
  <?php if (!empty($errorMessage)): ?>
    <div class="popup">
      <p><?= htmlspecialchars($errorMessage); ?></p>
      <button class="close-btn" onclick="closePopup()">×</button>
    </div>
  <?php endif; ?>

  <!-- Form Login -->
  <div class="container">
    <div class="form">
      <h2>Admin GYMs</h2>
      <div class="user">
        <form method="POST" action="">
            <input type="text" name="username" placeholder="User ID" required>
            <input type="password" name="password" placeholder="Password" required>
      </div>
        <input type="submit" name="Login" value="Login">
      </form>
    </div>
  </div>

  <!-- Footer -->
  <footer class="footer">
    <p>&copy; 2024 Created By Fajar.</p>
  </footer>

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
