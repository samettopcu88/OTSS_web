<?php
define('TITLE', 'Talep Sahibi Profili');
define('PAGE', 'RequesterProfile');
include('includes/header.php'); 
include('../dbConnection.php');
session_start();
if($_SESSION['is_login']){
    $rEmail = $_SESSION['rEmail'];
} else {
    echo "<script> location.href='RequesterLogin.php'; </script>";
}

$sql = "SELECT * FROM requesterlogin_tb WHERE r_email='$rEmail'";
$result = $conn->query($sql);
if($result->num_rows == 1){
    $row = $result->fetch_assoc();
    $rName = htmlspecialchars($row["r_name"]); // XSS koruması
}

if(isset($_REQUEST['nameupdate'])){
    if(($_REQUEST['rName'] == "")){
        // Gerekli alan eksikse görüntülenen ileti
        $passmsg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Tüm Alanları Doldurun </div>';
    } else {
        $rName = htmlspecialchars($_REQUEST["rName"]); // XSS koruması
        $sql = "UPDATE requesterlogin_tb SET r_name = '$rName' WHERE r_email = '$rEmail'";
        if($conn->query($sql) == TRUE){
            // Form gönderimi başarılı olduğunda görüntülenen ileti
            $passmsg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert"> Başarıyla Güncellendi </div>';
        } else {
            // Form gönderimi başarısız olduğunda görüntülenen ileti
            $passmsg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Güncelleme Başarısız </div>';
        }
    }
}
?>
<div class="col-sm-6 mt-5">
  <form class="mx-5" method="POST">
    <div class="form-group">
      <label for="inputEmail">E-posta</label>
      <input type="email" class="form-control" id="inputEmail" value=" <?php echo $rEmail ?>" readonly>
    </div>
    <div class="form-group">
      <label for="inputName">Adı</label>
      <input type="text" class="form-control" id="inputName" name="rName" value=" <?php echo $rName ?>">
    </div>
    <button type="submit" class="btn btn-danger" name="nameupdate">Güncelle</button>
    <?php if(isset($passmsg)) {echo $passmsg; } ?>
    <!-- CSRF koruması -->
    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
  </form>
</div>
</div>
</div>
<?php
include('includes/footer.php'); 
?>
