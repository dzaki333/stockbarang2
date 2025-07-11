<?php
require '../function.php';

// Cek jika admin sudah login, langsung arahkan ke dashboard
if (isset($_SESSION['admin_log'])) {
    header('Location: dashboardadmin.php');
    exit;
}

// Proses login
if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    $cek = mysqli_query($conn, "SELECT * FROM admin WHERE email='$email'");
    if ($cek && mysqli_num_rows($cek) > 0) {
        $row = mysqli_fetch_assoc($cek);
        if (password_verify($password, $row['password'])) {
            $_SESSION['admin_log'] = true;
            $_SESSION['admin_id'] = $row['idadmin'];
            header('Location: dashboardadmin.php');
            exit;
        } else {
            echo "<script>alert('Password salah!'); window.location='loginadmin.php';</script>";
        }
    } else {
        echo "<script>alert('Email tidak ditemukan!'); window.location='loginadmin.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Login Admin</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <!-- Bootstrap & Font Awesome -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet" />

  <style>
    body {
      background-image: url('../background.png');
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      margin: 0;
    }

    .card {
      border: none;
      border-radius: 15px;
      box-shadow: 0 6px 25px rgba(0, 0, 0, 0.3);
      overflow: hidden;
    }

    .card-header {
      background: linear-gradient(90deg, #1b1b1b, #343a40);
      padding: 25px;
      text-align: center;
      color: white;
    }

    .card-header h3 {
      margin: 0;
      font-weight: bold;
    }

    .form-control {
      border-radius: 8px;
      padding: 12px;
      font-size: 15px;
    }

    .form-control:focus {
      border-color: #6c63ff;
      box-shadow: 0 0 5px rgba(108, 99, 255, 0.5);
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
          <h3><i class="fas fa-user-shield"></i> Login Admin</h3>
        </div>
        <div class="card-body p-4">
          <form method="post" action="loginadmin.php">
            <div class="form-group">
              <label for="inputEmailAddress">Email</label>
              <input class="form-control" id="inputEmailAddress" name="email" type="email" placeholder="Masukkan email admin" required />
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
            <small><a href="../login.php"><i class="fas fa-arrow-left"></i> Kembali ke Login User</a></small>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
