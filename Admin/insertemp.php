<?php
define('TITLE', 'Yeni Teknisyen Ekle');
define('PAGE', 'teknisyen');
include('includes/header.php'); 
include('../dbConnection.php');
session_start();
 if(isset($_SESSION['is_adminlogin'])){
  $aEmail = $_SESSION['aEmail'];
 } else {
  echo "<script> location.href='login.php'; </script>";
 }
if(isset($_REQUEST['empsubmit'])){
 // Boş Alan Kontrolü
 if(($_REQUEST['empName'] == "") || ($_REQUEST['empCity'] == "") || ($_REQUEST['empMobile'] == "") || ($_REQUEST['empEmail'] == "")){
  // Gerekli alan eksikse görüntülenen ileti
  $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Tüm Alanları Doldurun </div>';
 } else {
   // Kullanıcı Değerlerini Değişkenlere Atama
   $eName = $_REQUEST['empName'];
   $eCity = $_REQUEST['empCity'];
   $eMobile = $_REQUEST['empMobile'];
   $eEmail = $_REQUEST['empEmail'];
   $sql = "INSERT INTO technician_tb (empName, empCity, empMobile, empEmail) VALUES ('$eName', '$eCity','$eMobile', '$eEmail')";
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
  <h3 class="text-center">Yeni Teknisyen Ekle</h3>
  <form action="" method="POST">
    <div class="form-group">
      <label for="empName">Adı</label>
      <input type="text" class="form-control" id="empName" name="empName">
    </div>
    <div class="form-group">
      <label for="empCity">Şehir</label>
      <input type="text" class="form-control" id="empCity" name="empCity">
    </div>
    <div class="form-group">
      <label for="empMobile">Telefon</label>
      <input type="text" class="form-control" id="empMobile" name="empMobile" onkeypress="isInputNumber(event)">
    </div>
    <div class="form-group">
      <label for="empEmail">Email</label>
      <input type="email" class="form-control" id="empEmail" name="empEmail">
    </div>
    <div class="text-center">
      <button type="submit" class="btn btn-danger" id="empsubmit" name="empsubmit">Gönder</button>
      <a href="technician.php" class="btn btn-secondary">Kapat</a>
    </div>
    <?php if(isset($msg)) {echo $msg; } ?>
  </form>
</div>
<!-- Sadece Sayılar için input alanları -->
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
