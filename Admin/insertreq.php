<?php
define('TITLE', 'Yeni Talep Sahibi Ekle');
define('PAGE', 'talepsahipleri');
include('includes/header.php'); 
include('../dbConnection.php');
session_start();
 if(isset($_SESSION['is_adminlogin'])){
  $aEmail = $_SESSION['aEmail'];
 } else {
  echo "<script> location.href='login.php'; </script>";
 }
if(isset($_REQUEST['reqsubmit'])){
 // Boş Alan Kontrolü
 if(($_REQUEST['r_name'] == "") || ($_REQUEST['r_email'] == "") || ($_REQUEST['r_password'] == "")){
  // Gerekli alan eksikse görüntülenen ileti
  $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Tüm Alanları Doldurun </div>';
 } else {
   // Kullanıcı Değerlerini Değişkenlere Atama
   $rname = $_REQUEST['r_name'];
   $rEmail = $_REQUEST['r_email'];
   $rPassword = $_REQUEST['r_password'];
   $sql = "INSERT INTO requesterlogin_tb (r_name, r_email, r_password) VALUES ('$rname', '$rEmail', '$rPassword')";
   if($conn->query($sql) == TRUE){
    // Aşağıdaki ileti form gönderimi başarılı olduğunda görüntülenir
    $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert"> Başarıyla Eklendi </div>';
   } else {
    // Aşağıdaki ileti form gönderimi başarısız olduğunda görüntülenir
    $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Eklenemedi </div>';
   }
 }
 }
?>
<div class="col-sm-6 mt-5  mx-3 jumbotron">
  <h3 class="text-center">Yeni Talep Sahibi Ekle</h3>
  <form action="" method="POST">
    <div class="form-group">
      <label for="r_name">Adı</label>
      <input type="text" class="form-control" id="r_name" name="r_name">
    </div>
    <div class="form-group">
      <label for="r_email">Email</label>
      <input type="email" class="form-control" id="r_email" name="r_email">
    </div>
    <div class="form-group">
      <label for="r_password">Şifre</label>
      <input type="password" class="form-control" id="r_password" name="r_password">
    </div>
    <div class="text-center">
      <button type="submit" class="btn btn-danger" id="reqsubmit" name="reqsubmit">Gönder</button>
      <a href="requester.php" class="btn btn-secondary">Kapat</a>
    </div>
    <?php if(isset($msg)) {echo $msg; } ?>
  </form>
</div>

<?php
include('includes/footer.php'); 
?>
