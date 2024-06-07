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

if(!isset($_SESSION['is_login'])){
  if(isset($_REQUEST['rEmail'])){
    $rEmail = mysqli_real_escape_string($conn,trim($_REQUEST['rEmail']));
    $rPassword = mysqli_real_escape_string($conn,trim($_REQUEST['rPassword']));
    
    // CSRF token kontrolü
    if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        // Token eşleşmiyorsa işlemi reddet
        echo "<script>alert('CSRF token hatası!')</script>";
    } else {
        $sql = "SELECT r_email, r_password FROM requesterlogin_tb WHERE r_email='".$rEmail."' AND r_password='".$rPassword."' limit 1";
        $result = $conn->query($sql);
        if($result->num_rows == 1){
          $_SESSION['is_login'] = true;
          $_SESSION['rEmail'] = $rEmail;
          // Doğru E-mail ve Şifre Girişinde RequesterProfile sayfasına yönlendirme
          echo "<script> location.href='RequesterProfile.php'; </script>";
          exit;
        } else {
          $msg = '<div class="alert alert-warning mt-2" role="alert">Geçerli bir E-mail ve Şifre giriniz.</div>';
        }
    }
  }
} else {
  echo "<script> location.href='RequesterProfile.php'; </script>";
}
?>

<!DOCTYPE html>
<html lang="tr">

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
    <span>Online Teknik Servis Sistemi</span>
  </div>
  <p class="text-center" style="font-size: 20px;"> <i class="fas fa-user-secret text-danger"></i> <span>Talep Sahibi
      Alanı</span>
  </p>
  <div class="container-fluid mb-5">
    <div class="row justify-content-center custom-margin">
      <div class="col-sm-6 col-md-4">
        <form action="" class="shadow-lg p-4" method="POST">
          <!-- CSRF token alanı -->
          <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">

          <div class="form-group">
            <i class="fas fa-user"></i><label for="email" class="pl-2 font-weight-bold">E-mail</label><input type="email"
              class="form-control" placeholder="E-mail" name="rEmail">
          </div>
          <div class="form-group">
            <i class="fas fa-key"></i><label for="pass" class="pl-2 font-weight-bold">Şifre</label><input type="password"
              class="form-control" placeholder="Şifre" name="rPassword">
          </div>
          <button type="submit" class="btn btn-outline-danger mt-3 btn-block shadow-sm font-weight-bold">Giriş</button>
          <?php if(isset($msg)) {echo $msg; } ?>
        </form>
        <div class="text-center"><a class="btn btn-info mt-3 shadow-sm font-weight-bold" href="../index.php">Anasayfa'ya
            Dön</a></div>
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
