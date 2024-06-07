<?php
// Başlık tanımlaması
define('TITLE', 'Şifre Değiştirme');
// Sayfa tanımlaması
define('PAGE', 'changepass');
// Başlık dosyasını dahil etme
include('includes/header.php'); 
// Veritabanı bağlantısını dahil etme
include('../dbConnection.php');
// Oturumu başlatma
session_start();
// Eğer oturum yöneticisi giriş yapmışsa
 if(isset($_SESSION['is_adminlogin'])){
  $aEmail = $_SESSION['aEmail'];
 } else {
  // Aksi halde giriş sayfasına yönlendirme
  echo "<script> location.href='login.php'; </script>";
 }
 // Oturum yöneticisinin e-postasını alma
 $aEmail = $_SESSION['aEmail'];
 // Eğer parola güncelleme isteği varsa
 if(isset($_REQUEST['passupdate'])){
  // Eğer gerekli alan eksikse
  if(($_REQUEST['aPassword'] == "")){
   // Eksik alan uyarısı
   $passmsg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Tüm Alanları Doldurun </div>';
  } else {
    // Aksi halde veritabanından yönetici bilgilerini al
    $sql = "SELECT * FROM adminlogin_tb WHERE a_email='$aEmail'";
    $result = $conn->query($sql);
    if($result->num_rows == 1){
     $aPass = $_REQUEST['aPassword'];
     // Yeni şifreyi güncelle
     $sql = "UPDATE adminlogin_tb SET a_password = '$aPass' WHERE a_email = '$aEmail'";
      if($conn->query($sql) == TRUE){
       // Başarılı güncelleme mesajı
       $passmsg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert"> Başarıyla Güncellendi </div>';
      } else {
       // Başarısız güncelleme mesajı
       $passmsg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Güncelleme Başarısız </div>';
      }
    }
   }
}
?>
<div class="col-sm-9 col-md-10">
  <div class="row">
    <div class="col-sm-6">
      <form class="mt-5 mx-5">
        <div class="form-group">
          <label for="inputEmail">E-posta</label>
          <input type="email" class="form-control" id="inputEmail" value=" <?php echo $aEmail ?>" readonly>
        </div>
        <div class="form-group">
          <label for="inputnewpassword">Yeni Şifre</label>
          <input type="text" class="form-control" id="inputnewpassword" placeholder="Yeni Şifre" name="aPassword">
        </div>
        <button type="submit" class="btn btn-danger mr-4 mt-4" name="passupdate">Güncelle</button>
        <button type="reset" class="btn btn-secondary mt-4">Sıfırla</button>
        <?php if(isset($passmsg)) {echo $passmsg; } ?>
      </form>
    </div>
  </div>
</div>
</div>
</div>
<?php
// Footer dosyasını dahil etme
include('includes/footer.php'); 
?>
