<?php    
define('TITLE', 'İstek Sahibini Güncelle');
define('PAGE', 'istek sahipleri');
include('includes/header.php'); 
include('../dbConnection.php');
session_start();
 if(isset($_SESSION['is_adminlogin'])){
  $aEmail = $_SESSION['aEmail'];
 } else {
  echo "<script> location.href='login.php'; </script>";
 }
 // güncelleme
 if(isset($_REQUEST['requpdate'])){
  // Boş Alan Kontrolü
  if(($_REQUEST['r_login_id'] == "") || ($_REQUEST['r_name'] == "") || ($_REQUEST['r_email'] == "")){
   // Gerekli alan eksikse görüntülenen ileti
   $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Tüm Alanları Doldurun </div>';
  } else {
    // Kullanıcı Değerlerini Değişkenlere Atama
    $rid = $_REQUEST['r_login_id'];
    $rname = $_REQUEST['r_name'];
    $remail = $_REQUEST['r_email'];

  $sql = "UPDATE requesterlogin_tb SET r_login_id = '$rid', r_name = '$rname', r_email = '$remail' WHERE r_login_id = '$rid'";
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
  <h3 class="text-center">İstek Sahibi Detaylarını Güncelle</h3>
  <?php
 if(isset($_REQUEST['view'])){
  $sql = "SELECT * FROM requesterlogin_tb WHERE r_login_id = {$_REQUEST['id']}";
 $result = $conn->query($sql);
 $row = $result->fetch_assoc();
 }
 ?>
  <form action="" method="POST">
    <div class="form-group">
      <label for="r_login_id">İstek Sahibi ID</label>
      <input type="text" class="form-control" id="r_login_id" name="r_login_id" value="<?php if(isset($row['r_login_id'])) {echo $row['r_login_id']; }?>">
    </div>
    <div class="form-group">
      <label for="r_name">Adı</label>
      <input type="text" class="form-control" id="r_name" name="r_name" value="<?php if(isset($row['r_name'])) {echo $row['r_name']; }?>">
    </div>
    <div class="form-group">
      <label for="r_email">Email</label>
      <input type="text" class="form-control" id="r_email" name="r_email" value="<?php if(isset($row['r_email'])) {echo $row['r_email']; }?>">
    </div>

    <div class="text-center">
      <button type="submit" class="btn btn-danger" id="requpdate" name="requpdate">Güncelle</button>
      <a href="requester.php" class="btn btn-secondary">Kapat</a>
    </div>
    <?php if(isset($msg)) {echo $msg; } ?>
  </form>
</div>

<?php
include('includes/footer.php'); 
?>
