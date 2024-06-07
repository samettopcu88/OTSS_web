<?php
define('TITLE', 'Yeni Ürün Ekle');
define('PAGE', 'assets');
include('includes/header.php'); 
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

if(isset($_SESSION['is_adminlogin'])){
  $aEmail = $_SESSION['aEmail'];
} else {
  echo "<script> location.href='login.php'; </script>";
}

if(isset($_REQUEST['psubmit'])){
  // CSRF token kontrolü
  if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
    // Token eşleşmiyorsa işlemi reddet
    echo "<script>alert('CSRF token hatası!')</script>";
  } else {
    // Boş Alanları Kontrol Etme
    if(($_REQUEST['pname'] == "") || ($_REQUEST['pdop'] == "") || ($_REQUEST['pava'] == "") || ($_REQUEST['ptotal'] == "") || ($_REQUEST['poriginalcost'] == "") || ($_REQUEST['psellingcost'] == "")){
      // Gerekli alan eksikse görüntülenen mesaj
      $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Tüm Alanları Doldurun </div>';
    } else {
      // Kullanıcı Değerlerini Değişkenlere Atama
      $pname = $_REQUEST['pname'];
      $pdop = $_REQUEST['pdop'];
      $pava = $_REQUEST['pava'];
      $ptotal = $_REQUEST['ptotal'];
      $poriginalcost = $_REQUEST['poriginalcost'];
      $psellingcost = $_REQUEST['psellingcost'];
      $sql = "INSERT INTO assets_tb (pname, pdop, pava, ptotal, poriginalcost, psellingcost) VALUES ('$pname', '$pdop','$pava', '$ptotal', '$poriginalcost', '$psellingcost')";
      if($conn->query($sql) == TRUE){
        // Form gönderimi başarılı olduğunda görüntülenen mesaj
        $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert"> Başarıyla Eklendi </div>';
      } else {
        // Form gönderimi başarısız olduğunda görüntülenen mesaj
        $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Eklenemedi </div>';
      }
    }
  }
}
?>
<div class="col-sm-6 mt-5 mx-3 jumbotron">
  <h3 class="text-center">Yeni Ürün Ekle</h3>
  <form action="" method="POST">
    <!-- CSRF token alanı -->
    <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
    
    <div class="form-group">
      <label for="pname">Ürün Adı</label>
      <input type="text" class="form-control" id="pname" name="pname" value="<?php echo isset($_POST['pname']) ? htmlspecialchars($_POST['pname']) : ''; ?>">
    </div>
    <div class="form-group">
      <label for="pdop">Satın Alma Tarihi</label>
      <input type="date" class="form-control" id="pdop" name="pdop" value="<?php echo isset($_POST['pdop']) ? htmlspecialchars($_POST['pdop']) : ''; ?>">
    </div>
    <div class="form-group">
      <label for="pava">Mevcut</label>
      <input type="text" class="form-control" id="pava" name="pava" onkeypress="isInputNumber(event)" value="<?php echo isset($_POST['pava']) ? htmlspecialchars($_POST['pava']) : ''; ?>">
    </div>
    <div class="form-group">
      <label for="ptotal">Toplam</label>
      <input type="text" class="form-control" id="ptotal" name="ptotal" onkeypress="isInputNumber(event)" value="<?php echo isset($_POST['ptotal']) ? htmlspecialchars($_POST['ptotal']) : ''; ?>">
    </div>
    <div class="form-group">
      <label for="poriginalcost">Birim Başına Orijinal Maliyet</label>
      <input type="text" class="form-control" id="poriginalcost" name="poriginalcost" onkeypress="isInputNumber(event)" value="<?php echo isset($_POST['poriginalcost']) ? htmlspecialchars($_POST['poriginalcost']) : ''; ?>">
    </div>
    <div class="form-group">
      <label for="psellingcost">Birim Başına Satış Maliyeti</label>
      <input type="text" class="form-control" id="psellingcost" name="psellingcost" onkeypress="isInputNumber(event)" value="<?php echo isset($_POST['psellingcost']) ? htmlspecialchars($_POST['psellingcost']) : ''; ?>">
    </div>
    <div class="text-center">
      <button type="submit" class="btn btn-danger" id="psubmit" name="psubmit">Gönder</button>
      <a href="assets.php" class="btn btn-secondary">Kapat</a>
    </div>
    <?php if(isset($msg)) {echo $msg; } ?>
  </form>
</div>
<!-- Sadece sayı girişi için -->
<script>
  function isInputNumber(evt) {
    var ch = String.fromCharCode(evt.which);
    if (!(/[0-9]/.test(ch))) {
      evt.preventDefault();
    }
  }
</script>
<?php
include('includes/footer.php'); 
?>
