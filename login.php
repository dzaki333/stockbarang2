<?php
require 'function.php';

// Cek login
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Ambil data user berdasarkan email
    $cekdatabase = mysqli_query($conn, "SELECT * FROM login WHERE email='$email'");
    $hitung = mysqli_num_rows($cekdatabase);

    if ($hitung > 0) {
        $row = mysqli_fetch_assoc($cekdatabase);
        if (password_verify($password, $row['password'])) {
            $_SESSION['log'] = 'True';
            $_SESSION['iduser'] = $row['iduser'];
            header('location:index.php');
        } else {
            echo "<script>alert('Password salah!'); window.location='login.php';</script>";
        }
    } else {
        echo "<script>alert('Email tidak ditemukan!'); window.location='login.php';</script>";
    }
}

if (isset($_SESSION['log'])) {
    header('location:index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <!-- Bootstrap & Font Awesome -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet" />

  <style>
    body {
      background-image: url('background.png'); /* Tetap pakai background kamu */
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      margin: 0;
    }

    .card {
      border: none;
      border-radius: 15px;
      box-shadow: 0 6px 25px rgba(0, 0, 0, 0.2);
      overflow: hidden;
    }

    .card-header {
      background: linear-gradient(90deg, #1e88e5, #42a5f5);
      padding: 25px;
      text-align: center;
      color: white;
    }

    .card-header h3 {
      font-weight: bold;
      margin: 0;
    }

    .form-control {
      border-radius: 8px;
      padding: 12px;
      font-size: 15px;
    }

    .form-control:focus {
      border-color: #42a5f5;
      box-shadow: 0 0 5px rgba(66, 165, 245, 0.5);
    }

    .btn-primary {
      background: linear-gradient(to right, #1e88e5, #42a5f5);
      border: none;
      font-weight: bold;
      padding: 12px;
      font-size: 15px;
      border-radius: 8px;
      transition: background 0.3s ease;
    }

    .btn-primary:hover {
      background: linear-gradient(to right, #1565c0, #2196f3);
    }

    .text-center small a {
      color: #007bff;
    }

    .text-center small a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="col-md-6 col-lg-5">
      <div class="card">
        <div class="card-header">
          <h3><i class="fas fa-user"></i> Login User</h3>
        </div>
        <div class="card-body p-4">
          <form method="post" action="login.php">
            <div class="form-group">
              <label for="inputEmailAddress">Email</label>
              <input class="form-control" id="inputEmailAddress" name="email" type="email" placeholder="Masukkan email" required />
            </div>
            <div class="form-group">
              <label for="inputPassword">Password</label>
              <input class="form-control" id="inputPassword" name="password" type="password" placeholder="Masukkan password" required />
            </div>
            <div class="form-group d-flex justify-content-between mt-4 mb-0">
              <button class="btn btn-primary btn-block" type="submit" name="login">
                <i class="fas fa-sign-in-alt"></i> Login
              </button>
            </div>
          </form>
                <div class="text-center mt-3">
                    <small>
                    <a href="admin/loginadmin.php"><i class="fas fa-user-shield"></i> Login sebagai Admin</a>
                    </small>
                </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
