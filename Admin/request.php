<?php
define('TITLE', 'İstekler');
define('PAGE', 'request');
include('includes/header.php'); 
include('../dbConnection.php');
session_start();
 if(isset($_SESSION['is_adminlogin'])){
  $aEmail = $_SESSION['aEmail'];
 } else {
  echo "<script> location.href='login.php'; </script>";
 }
?>
<div class="col-sm-4 mb-5">
  <!-- Ana İçerik Alanı Orta Başlangıç -->
  <?php 
 $sql = "SELECT request_id, request_info, request_desc, request_date FROM submitrequest_tb";
 $result = $conn->query($sql);
 if($result->num_rows > 0){
  while($row = $result->fetch_assoc()){
   echo '<div class="card mt-5 mx-5">';
   echo '<div class="card-header">';
   echo 'İstek ID : '. $row['request_id'];
   echo '</div>';
   echo '<div class="card-body">';
   echo '<h5 class="card-title">İstek Bilgisi : ' . $row['request_info'] . '</h5>';
   echo '<p class="card-text">' . $row['request_desc'] . '</p>';
   echo '<p class="card-text">İstek Tarihi: ' . $row['request_date'] . '</p>';
   echo '<div class="float-right">';
   echo '<form action="" method="POST"> <input type="hidden" name="id" value='. $row["request_id"] .'><input type="submit" class="btn btn-danger mr-3" name="view" value="Görüntüle"><input type="submit" class="btn btn-secondary" name="close" value="Kapat"></form>';
   echo '</div>' ;
   echo '</div>' ;
   echo'</div>';
  }
 } else {
  echo '<div class="alert alert-info mt-5 col-sm-6" role="alert">
  <h4 class="alert-heading">Tebrikler!</h4>
  <p>Harika, tüm istekleri başarıyla atadınız.</p>
  <hr>
  <h5 class="mb-0">Bekleyen İstek Yok</h5>
</div>';
 }

// iş atadıktan sonra submitrequesttable'dan veriyi sileriz
if(isset($_REQUEST['close'])){
  $sql = "DELETE FROM submitrequest_tb WHERE request_id = {$_REQUEST['id']}";
  if($conn->query($sql) === TRUE){
    // echo "Record Deleted Successfully";
    // Aşağıdaki kod, kaydı silmekten sonra sayfayı yeniler
    echo '<meta http-equiv="refresh" content= "0;URL=?closed" />';
    } else {
      echo "Veri Silinemedi";
    }
  }
 ?>
</div> <!-- Ana İçerik Alanı Orta Sonu -->

<?php 
  include('assignworkform.php');
  include('includes/footer.php'); 
  $conn->close();
?>
