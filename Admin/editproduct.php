<?php    
define('TITLE', 'Ürünü Güncelle');
define('PAGE', 'varlıklar');
include('includes/header.php'); 
include('../dbConnection.php');
session_start();
 if(isset($_SESSION['is_adminlogin'])){
  $aEmail = $_SESSION['aEmail'];
 } else {
  echo "<script> location.href='login.php'; </script>";
 }
 // güncelleme
 if(isset($_REQUEST['pupdate'])){
  // Boş Alan Kontrolü
  if(($_REQUEST['pname'] == "") || ($_REQUEST['pdop'] == "") || ($_REQUEST['pava'] == "") || ($_REQUEST['ptotal'] == "") || ($_REQUEST['poriginalcost'] == "") || ($_REQUEST['psellingcost'] == "")){
   // Gerekli alan eksikse görüntülenen ileti
   $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Tüm Alanları Doldurun </div>';
  } else {
    // Kullanıcı Değerlerini Değişkenlere Atama
    $pid = $_REQUEST['pid'];
    $pname = $_REQUEST['pname'];
    $pdop = $_REQUEST['pdop'];
    $pava = $_REQUEST['pava'];
    $ptotal = $_REQUEST['ptotal'];
    $poriginalcost = $_REQUEST['poriginalcost'];
    $psellingcost = $_REQUEST['psellingcost'];
  $sql = "UPDATE assets_tb SET pname = '$pname', pdop = '$pdop', pava = '$pava', ptotal = '$ptotal', poriginalcost = '$poriginalcost', psellingcost = '$psellingcost' WHERE pid = '$pid'";
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
  <h3 class="text-center">Ürün Detaylarını Güncelle</h3>
  <?php
 if(isset($_REQUEST['view'])){
  $sql = "SELECT * FROM assets_tb WHERE pid = {$_REQUEST['id']}";
 $result = $conn->query($sql);
 $row = $result->fetch_assoc();
 }
 ?>
  <form action="" method="POST">
    <div class="form-group">
      <label for="pid">Ürün ID</label>
      <input type="text" class="form-control" id="pid" name="pid" value="<?php if(isset($row['pid'])) {echo $row['pid']; }?>"
        readonly>
    </div>
    <div class="form-group">
      <label for="pname">Adı</label>
      <input type="text" class="form-control" id="pname" name="pname" value="<?php if(isset($row['pname'])) {echo $row['pname']; }?>">
    </div>
    <div class="form-group">
      <label for="pdop">DOP</label>
      <input type="date" class="form-control" id="pdop" name="pdop" value="<?php if(isset($row['pdop'])) {echo $row['pdop']; }?>">
    </div>
    <div class="form-group">
      <label for="pava">Mevcut</label>
      <input type="text" class="form-control" id="pava" name="pava" value="<?php if(isset($row['pava'])) {echo $row['pava']; }?>"
        onkeypress="isInputNumber(event)">
    </div>
    <div class="form-group">
      <label for="ptotal">Toplam</label>
      <input type="text" class="form-control" id="ptotal" name="ptotal" value="<?php if(isset($row['ptotal'])) {echo $row['ptotal']; }?>"
        onkeypress="isInputNumber(event)">
    </div>
    <div class="form-group">
      <label for="poriginalcost">Her Bir Ürünün Orijinal Maliyeti</label>
      <input type="text" class="form-control" id="poriginalcost" name="poriginalcost" value="<?php if(isset($row['poriginalcost'])) {echo $row['poriginalcost']; }?>"
        onkeypress="isInputNumber(event)">
    </div>
    <div class="form-group">
      <label for="psellingcost">Her Bir Ürünün Satış Fiyatı</label>
      <input type="text" class="form-control" id="psellingcost" name="psellingcost" value="<?php if(isset($row['psellingcost'])) {echo $row['psellingcost']; }?>"
        onkeypress="isInputNumber(event)">
    </div>
    <div class="text-center">
      <button type="submit" class="btn btn-danger" id="pupdate" name="pupdate">Güncelle</button>
      <a href="assets.php" class="btn btn-secondary">Kapat</a>
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
