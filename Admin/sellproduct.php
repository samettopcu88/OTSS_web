<?php    
define('TITLE', 'Ürün Satışı');
define('PAGE', 'varlıklar');
include('includes/header.php'); 
include('../dbConnection.php');
session_start();
 if(isset($_SESSION['is_adminlogin'])){
  $aEmail = $_SESSION['aEmail'];
 } else {
  echo "<script> location.href='login.php'; </script>";
 }
 if(isset($_REQUEST['psubmit'])){
  // Boş Alanları Kontrol Etme
  if(($_REQUEST['cname'] == "") || ($_REQUEST['cadd'] == "") || ($_REQUEST['pname'] == "") || ($_REQUEST['pquantity'] == "") || ($_REQUEST['psellingcost'] == "") || ($_REQUEST['totalcost'] == "") || ($_REQUEST['selldate'] == "")){
   // Gerekli alan eksikse gösterilen mesaj
   $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Tüm Alanları Doldurun </div>';
  } else {
    // Güncelleme için Kullanıcı Değerlerini Değişkene Atama
    $pid = $_REQUEST['pid'];
    $pava = ($_REQUEST['pava'] - $_REQUEST['pquantity']);

    // Ekleme için Kullanıcı Değerlerini Değişkene Atama
    $custname = $_REQUEST['cname'];
    $custadd = $_REQUEST['cadd'];
    $cpname = $_REQUEST['pname'];
    $cpquantity = $_REQUEST['pquantity'];
    $cpeach = $_REQUEST['psellingcost'];
    $cptotal = $_REQUEST['totalcost'];
    $cpdate = $_REQUEST['selldate'];
    $sqlin = "INSERT INTO customer_tb(custname, custadd, cpname, cpquantity, cpeach, cptotal, cpdate) VALUES ('$custname','$custadd', '$cpname', '$cpquantity', '$cpeach', '$cptotal', '$cpdate')";
    if($conn->query($sqlin) == TRUE){
      // Aşağıdaki işlev eklenen kimliği yakalar
      $genid = mysqli_insert_id($conn);
      session_start();
      $_SESSION['myid'] = $genid;
      echo "<script> location.href='productsellsuccess.php'; </script>";
    } 
    // Satıştan Sonra Kullanılabilir Ürünler için Varlık Verilerini Güncelleme
    $sql = "UPDATE assets_tb SET pava = '$pava' WHERE pid = '$pid'";
    $conn->query($sql);
  }
}
 ?>
<div class="col-sm-6 mt-5  mx-3 jumbotron">
  <h3 class="text-center">Müşteri Faturası</h3>
  <?php
 if(isset($_REQUEST['issue'])){
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
      <label for="cname">Müşteri Adı</label>
      <input type="text" class="form-control" id="cname" name="cname">
    </div>
    <div class="form-group">
      <label for="cadd">Müşteri Adresi</label>
      <input type="text" class="form-control" id="cadd" name="cadd">
    </div>
    <div class="form-group">
      <label for="pname">Ürün Adı</label>
      <input type="text" class="form-control" id="pname" name="pname" value="<?php if(isset($row['pname'])) {echo $row['pname']; }?>">
    </div>
    <div class="form-group">
      <label for="pava">Mevcut</label>
      <input type="text" class="form-control" id="pava" name="pava" value="<?php if(isset($row['pava'])) {echo $row['pava']; }?>"
        readonly onkeypress="isInputNumber(event)">
    </div>
    <div class="form-group">
      <label for="pquantity">Miktar</label>
      <input type="text" class="form-control" id="pquantity" name="pquantity" onkeypress="isInputNumber(event)">
    </div>
    <div class="form-group">
      <label for="psellingcost">Birim Fiyat</label>
      <input type="text" class="form-control" id="psellingcost" name="psellingcost" value="<?php if(isset($row['psellingcost'])) {echo $row['psellingcost']; }?>"
        onkeypress="isInputNumber(event)">
    </div>
    <div class="form-group">
      <label for="totalcost">Toplam Fiyat</label>
      <input type="text" class="form-control" id="totalcost" name="totalcost" onkeypress="isInputNumber(event)">
    </div>
    <div class="form-group col-md-4">
      <label for="inputDate">Tarih</label>
      <input type="date" class="form-control" id="inputDate" name="selldate">
    </div>
    <div class="text-center">
      <button type="submit" class="btn btn-danger" id="psubmit" name="psubmit">Gönder</button>
      <a href="assets.php" class="btn btn-secondary">Kapat</a>
    </div>
    <?php if(isset($msg)) {echo $msg; } ?>
  </form>
</div>
<!-- Sadece Sayılar için giriş alanları -->
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
