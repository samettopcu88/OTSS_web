<?php    
define('TITLE', 'Teknisyen Güncelleme');
define('PAGE', 'teknisyen');
include('includes/header.php'); 
include('../dbConnection.php');
session_start();
 if(isset($_SESSION['is_adminlogin'])){
  $aEmail = $_SESSION['aEmail'];
 } else {
  echo "<script> location.href='login.php'; </script>";
 }
 // güncelleme
 if(isset($_REQUEST['empupdate'])){
  // Boş Alan Kontrolü
  if(($_REQUEST['empName'] == "") || ($_REQUEST['empCity'] == "") || ($_REQUEST['empMobile'] == "") || ($_REQUEST['empEmail'] == "")){
   // Gerekli alan eksikse görüntülenen ileti
   $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Tüm Alanları Doldurun </div>';
  } else {
    // Kullanıcı Değerlerini Değişkenlere Atama
    $eId = $_REQUEST['empId'];
    $eName = $_REQUEST['empName'];
    $eCity = $_REQUEST['empCity'];
    $eMobile = $_REQUEST['empMobile'];
    $eEmail = $_REQUEST['empEmail'];
  $sql = "UPDATE technician_tb SET empName = '$eName', empCity = '$eCity', empMobile = '$eMobile', empEmail = '$eEmail' WHERE empid = '$eId'";
    if($conn->query($sql) == TRUE){
     // Aşağıdaki ileti form gönderimi başarılı olduğunda görüntülenir
     $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert"> Başarıyla Güncellendi </div>';
    } else {
     // Aşağıdaki ileti form gönderimi başarısız olduğunda görüntülenir
     $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Güncelleme Başarısız </div>';
    }
  }
  }
 ?>
<div class="col-sm-6 mt-5  mx-3 jumbotron">
  <h3 class="text-center">Teknisyen Bilgilerini Güncelle</h3>
  <?php
 if(isset($_REQUEST['view'])){
  $sql = "SELECT * FROM technician_tb WHERE empid = {$_REQUEST['id']}";
 $result = $conn->query($sql);
 $row = $result->fetch_assoc();
 }
 ?>
  <form action="" method="POST">
    <div class="form-group">
      <label for="empId">Emp ID</label>
      <input type="text" class="form-control" id="empId" name="empId" value="<?php if(isset($row['empid'])) {echo $row['empid']; }?>"
        readonly>
    </div>
    <div class="form-group">
      <label for="empName">Adı</label>
      <input type="text" class="form-control" id="empName" name="empName" value="<?php if(isset($row['empName'])) {echo $row['empName']; }?>">
    </div>
    <div class="form-group">
      <label for="empCity">Şehir</label>
      <input type="text" class="form-control" id="empCity" name="empCity" value="<?php if(isset($row['empCity'])) {echo $row['empCity']; }?>">
    </div>
    <div class="form-group">
      <label for="empMobile">Telefon</label>
      <input type="text" class="form-control" id="empMobile" name="empMobile" value="<?php if(isset($row['empMobile'])) {echo $row['empMobile']; }?>"
        onkeypress="isInputNumber(event)">
    </div>
    <div class="form-group">
      <label for="empEmail">Email</label>
      <input type="email" class="form-control" id="empEmail" name="empEmail" value="<?php if(isset($row['empEmail'])) {echo $row['empEmail']; }?>">
    </div>
    <div class="text-center">
      <button type="submit" class="btn btn-danger" id="empupdate" name="empupdate">Güncelle</button>
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
