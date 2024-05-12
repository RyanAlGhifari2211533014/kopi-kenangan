<?php
session_start();

$host_db ="localhost";
$user_db = "root";
$pass_db = "";
$nama_db = "login";
$koneksi = mysqli_connect($host_db,$user_db,$pass_db,$nama_db);

$err ="";
$username="";

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    if($username =='' or $password ==''){
        $err .="<li>Silakan masukkan email dan juga password.</li>";
    }else{
        $sqli = "SELECT * FROM login WHERE username = '$username'";
        $q1 = mysqli_query($koneksi,$sqli);
        
        if(mysqli_num_rows($q1) == 0) {
            $err .="<li>Username <b>$username</b> tidak tersedia.</li>";
        } else {
            $r1 = mysqli_fetch_array($q1);
            if($r1['password']!= md5($password)){
                $err .="<li>Password yang dimasukkan tidak sesuai.</li>";
            }
            if(empty($err)){
                $_SESSION['session_username'] = $username;
                $_SESSION['session_password'] = md5($password);

                header("location:home.php");
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk atau Daftar</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Navbar untuk dekstop -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light d-none d-lg-block">
        <div class="container-fluid" style="background-image: url('navbar-background.jpg');">
            <a class="navbar-brand" href="#">Kopi Kenangan</a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Order</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                    <!-- Tombol untuk menampilkan form login -->
                    <li class="nav-item">
                        <button class="nav-link btn btn-link" id="showLoginFormBtn">Masuk</button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Form login (awalnya disembunyikan) -->
    <div class="container" id="loginFormContainer" style="display: none;">
        <form id="loginForm" action="login.php" method="post">
            <div class="form-group">
                <input type="email" class="form-control" id="username" name="username" placeholder="Email" required>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" id="password" name="password" placeholder="password" required>
            </div>
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="agree" name="agree" required>
                <label class="form-check-label" for="agree">Kami setuju dengan Ketentuan dan Layanan dan Kebijakan Privasi Kopi Kenangan</label>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Masuk</button>
            <p class="text-center">I don't have an Indonesian phone number</p>
        </form>
        <div class="instructions">
            <h2>Langkah Berikutnya...</h2>
            <ol>
                <li> Masukkan email dan password Anda</li>
                <li> Klik tombol Masuk</li>
                <li> Pilih lokasi kopi kenangan terdekat dan pilih minuman favorit kamu</li>
            </ol>
        </div>
    </div>

    <!-- JavaScript untuk menampilkan/menyembunyikan formulir login -->
    <script>
        document.getElementById('showLoginFormBtn').addEventListener('click', function() {
            document.getElementById('loginFormContainer').style.display = 'block';
        });

    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
