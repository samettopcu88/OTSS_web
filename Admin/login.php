<?php
include('../dbConnection.php');
session_start();

// CSRF token oluşturma fonksiyonu
function generateToken() {
    return bin2hex(random_bytes(32));
}

// CSRF tokeni sessionda saklama
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = generateToken();
}

if(!isset($_SESSION['is_adminlogin'])){
  if(isset($_REQUEST['aEmail'])){
    $aEmail = mysqli_real_escape_string($conn,trim($_REQUEST['aEmail']));
    $aPassword = mysqli_real_escape_string($conn,trim($_REQUEST['aPassword']));
    
    // CSRF token kontrolü
    if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        // Token eşleşmiyorsa işlemi reddet
        echo "<script>alert('CSRF token hatası!')</script>";
    } else {
        $sql = "SELECT a_email, a_password FROM adminlogin_tb WHERE a_email='".$aEmail."' AND a_password='".$aPassword."' limit 1";
        $result = $conn->query($sql);
        if($result->num_rows == 1){
          $_SESSION['is_adminlogin'] = true;
          $_SESSION['aEmail'] = $aEmail;
          // Doğru e-posta ve parola girişinde RequesterProfile sayfasına yönlendir
          echo "<script> location.href='dashboard.php'; </script>";
          exit;
        } else {
          $msg = '<div class="alert alert-warning mt-2" role="alert"> Geçerli bir e-posta ve parola girin </div>';
        }
    }
  }
} else {
  echo "<script> location.href='dashboard.php'; </script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="../css/bootstrap.min.css">

  <!-- Font Awesome CSS -->
  <link rel="stylesheet" href="../css/all.min.css">

  <style>
    .custom-margin {
         margin-top: 8vh;
      }
   </style>
  <title>Giriş</title>
</head>

<body>
  <div class="mb-3 text-center mt-5" style="font-size: 30px;">
    <i class="fas fa-stethoscope"></i>
    <span>Çevrimiçi Bakım Yönetim Sistemi</span>
  </div>
  <p class="text-center" style="font-size: 20px;"> <i class="fas fa-user-secret text-danger"></i> <span>Yönetici
      Alanı (Demo)</span>
  </p>
  <div class="container-fluid mb-5">
    <div class="row justify-content-center custom-margin">
      <div class="col-sm-6 col-md-4">
        <form action="" class="shadow-lg p-4" method="POST">
          <!-- CSRF token alanı -->
          <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">

          <div class="form-group">
            <i class="fas fa-user"></i><label for="email" class="pl-2 font-weight-bold">E-posta</label><input type="email"
              class="form-control" placeholder="E-posta" name="aEmail">
            <!--Add text-white below if want text color white-->
            <small class="form-text">E-postanızı kimseyle paylaşmayacağız.</small>
          </div>
          <div class="form-group">
            <i class="fas fa-key"></i><label for="pass" class="pl-2 font-weight-bold">Parola</label><input type="password"
              class="form-control" placeholder="Parola" name="aPassword">
          </div>
          <button type="submit" class="btn btn-outline-danger mt-3 btn-block shadow-sm font-weight-bold">Giriş</button>
          <?php if(isset($msg)) {echo $msg; } ?>
        </form>
        <div class="text-center"><a class="btn btn-info mt-3 shadow-sm font-weight-bold" href="../index.php">Anasayfa'ya
            Geri Dön</a></div>
      </div>
    </div>
  </div>

  <!-- Boostrap JavaScript -->
  <script src="../js/jquery.min.js"></script>
  <script src="../js/popper.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/all.min.js"></script>
</body>

</html>
