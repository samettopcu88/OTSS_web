<?php
define('TITLE', 'İş Raporu');
define('PAGE', 'workreport');
include('includes/header.php');
include('../dbConnection.php'); 
session_start();
 if(isset($_SESSION['is_adminlogin'])){
  $aEmail = $_SESSION['aEmail'];
 } else {
  echo "<script> location.href='login.php'; </script>";
 }
?>
<div class="col-sm-9 col-md-10 mt-5 text-center">
  <form action="" method="POST" class="d-print-none">
    <div class="form-row">
      <div class="form-group col-md-2">
        <input type="date" class="form-control" id="startdate" name="startdate">
      </div> <span> arası </span>
      <div class="form-group col-md-2">
        <input type="date" class="form-control" id="enddate" name="enddate">
      </div>
      <div class="form-group">
        <input type="submit" class="btn btn-secondary" name="searchsubmit" value="Ara">
      </div>
    </div>
  </form>
  <?php
 if(isset($_REQUEST['searchsubmit'])){
    $startdate = $_REQUEST['startdate'];
    $enddate = $_REQUEST['enddate'];
    $sql = "SELECT * FROM assignwork_tb WHERE assign_date BETWEEN '$startdate' AND '$enddate'";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
     echo '
  <p class=" bg-dark text-white p-2 mt-4">Detaylar</p>
  <table class="table">
  <thead>
    <tr>
      <th scope="col">İstek ID</th>
      <th scope="col">İstek Bilgisi</th>
      <th scope="col">Adı</th>
      <th scope="col">Adres</th>
      <th scope="col">Şehir</th>
      <th scope="col">Telefon</th>
      <th scope="col">Teknisyen</th>
      <th scope="col">Atama Tarihi</th>
    </tr>
  </thead>
  <tbody>';
  while($row = $result->fetch_assoc()){
    echo '<tr>
    <th scope="row">'.$row["request_id"].'</th>
    <td>'.$row["request_info"].'</td>
    <td>'.$row["requester_name"].'</td>
    <td>'.$row["requester_add2"].'</td>
    <td>'.$row["requester_city"].'</td>
    <td>'.$row["requester_mobile"].'</td>
    <td>'.$row["assign_tech"].'</td>
    <td>'.$row["assign_date"].'</td>
      </tr>';
    }
    echo '<tr>
    <td><form class="d-print-none"><input class="btn btn-danger" type="submit" value="Yazdır" onClick="window.print()"></form></td>
  </tr></tbody>
  </table>';
  } else {
    echo "<div class='alert alert-warning col-sm-6 ml-5 mt-2' role='alert'> Kayıt Bulunamadı! </div>";
  }
 }
  ?>
</div>
</div>
</div>

<?php
include('includes/footer.php'); 
?>
