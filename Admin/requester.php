<?php
define('TITLE', 'Talep Edenler');
define('PAGE', 'talepedenler');
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
  <!--Tablo-->
  <p class=" bg-dark text-white p-2">Talep Edenlerin Listesi</p>
  <?php
    $sql = "SELECT * FROM requesterlogin_tb";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
 echo '<table class="table">
  <thead>
   <tr>
    <th scope="col">Talep Eden ID</th>
    <th scope="col">Adı</th>
    <th scope="col">E-posta</th>
    <th scope="col">İşlem</th>
   </tr>
  </thead>
  <tbody>';
  while($row = $result->fetch_assoc()){
   echo '<tr>';
    echo '<th scope="row">'.$row["r_login_id"].'</th>';
    echo '<td>'. $row["r_name"].'</td>';
    echo '<td>'.$row["r_email"].'</td>';
    echo '<td><form action="editreq.php" method="POST" class="d-inline"> <input type="hidden" name="id" value='. $row["r_login_id"] .'><button type="submit" class="btn btn-info mr-3" name="view" value="Görüntüle"><i class="fas fa-pen"></i></button></form>  
    <form action="" method="POST" class="d-inline"><input type="hidden" name="id" value='. $row["r_login_id"] .'><button type="submit" class="btn btn-secondary" name="delete" value="Delete"><i class="far fa-trash-alt"></i></button></form></td>
   </tr>';
  }

 echo '</tbody>
 </table>';
} else {
  echo "0 Sonuç";
}
if(isset($_REQUEST['delete'])){
  $sql = "DELETE FROM requesterlogin_tb WHERE r_login_id = {$_REQUEST['id']}";
  if($conn->query($sql) === TRUE){
    // echo "Record Deleted Successfully";
    // Aşağıdaki kod, kaydı silmekten sonra sayfayı yeniler
    echo '<meta http-equiv="refresh" content= "0;URL=?deleted" />';
    } else {
      echo "Veri Silinemedi";
    }
  }
?>
</div>
</div>
<div><a class="btn btn-danger box" href="insertreq.php"><i class="fas fa-plus fa-2x"></i></a>
</div>
</div>
<?php
include('includes/footer.php'); 
?>
