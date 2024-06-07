<?php
define('TITLE', 'Teknisyenler');
define('PAGE', 'teknisyen');
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
  <p class=" bg-dark text-white p-2">Teknisyen Listesi</p>
  <?php
    $sql = "SELECT * FROM technician_tb";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
 echo '<table class="table">
  <thead>
   <tr>
    <th scope="col">Çalışan ID</th>
    <th scope="col">Ad</th>
    <th scope="col">Şehir</th>
    <th scope="col">Telefon</th>
    <th scope="col">Email</th>
    <th scope="col">İşlem</th>
   </tr>
  </thead>
  <tbody>';
  while($row = $result->fetch_assoc()){
   echo '<tr>';
    echo '<th scope="row">'.$row["empid"].'</th>';
    echo '<td>'. $row["empName"].'</td>';
    echo '<td>'.$row["empCity"].'</td>';
    echo '<td>'.$row["empMobile"].'</td>';
    echo '<td>'.$row["empEmail"].'</td>';
    echo '<td><form action="editemp.php" method="POST" class="d-inline"> <input type="hidden" name="id" value='. $row["empid"] .'><button type="submit" class="btn btn-info mr-3" name="view" value="Görüntüle"><i class="fas fa-pen"></i></button></form>  <form action="" method="POST" class="d-inline"><input type="hidden" name="id" value='. $row["empid"] .'><button type="submit" class="btn btn-secondary" name="delete" value="Sil"><i class="far fa-trash-alt"></i></button></form></td>
   </tr>';
  }

 echo '</tbody>
 </table>';
} else {
  echo "0 Sonuç";
}
if(isset($_REQUEST['delete'])){
  $sql = "DELETE FROM technician_tb WHERE empid = {$_REQUEST['id']}";
  if($conn->query($sql) === TRUE){
    // echo "Record Deleted Successfully";
    // aşağıdaki kod, kaydı sildikten sonra sayfayı yeniler
    echo '<meta http-equiv="refresh" content= "0;URL=?deleted" />';
    } else {
      echo "Veri Silinemedi";
    }
  }
?>
</div>
</div>
<div><a class="btn btn-danger box" href="insertemp.php"><i class="fas fa-plus fa-2x"></i></a>
</div>
</div>

<?php
include('includes/footer.php'); 
?>
