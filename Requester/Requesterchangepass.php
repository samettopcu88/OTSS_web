<?php
define('TITLE', 'Şifre Değiştir');
define('PAGE', 'Requesterchangepass');
include('includes/header.php');
include('../dbConnection.php');
session_start();
if($_SESSION['is_login']){
    $rEmail = $_SESSION['rEmail'];
} else {
    echo "<script> location.href='RequesterLogin.php'; </script>";
}

$rEmail = $_SESSION['rEmail'];
if(isset($_REQUEST['passupdate'])){
    if(($_REQUEST['rPassword'] == "")){
        // Gerekli alan eksikse görüntülenen ileti
        $passmsg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Tüm Alanları Doldurun </div>';
    } else {
        $sql = "SELECT * FROM requesterlogin_tb WHERE r_email='$rEmail'";
        $result = $conn->query($sql);
        if($result->num_rows == 1){
            $rPass = $_REQUEST['rPassword'];
            $sql = "UPDATE requesterlogin_tb SET r_password = '$rPass' WHERE r_email = '$rEmail'";
            if($conn->query($sql) == TRUE){
                // Form gönderimi başarılı olduğunda görüntülenen ileti
                $passmsg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert"> Başarıyla Güncellendi </div>';
            } else {
                // Form gönderimi başarısız olduğunda görüntülenen ileti
                $passmsg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Güncelleme Başarısız </div>';
            }
        }
    }
}

?>
<div class="col-sm-9 col-md-10">
  <div class="row">
    <div class="col-sm-6">
      <form class="mt-5 mx-5" method="POST">
        <div class="form-group">
          <label for="inputEmail">E-mail</label>
          <input type="email" class="form-control" id="inputEmail" value=" <?php echo $rEmail ?>" readonly>
        </div>
        <div class="form-group">
          <label for="inputnewpassword">Yeni Şifre</label>
          <input type="password" class="form-control" id="inputnewpassword" placeholder="Yeni Şifre" name="rPassword">
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
include('includes/footer.php'); 
?>
