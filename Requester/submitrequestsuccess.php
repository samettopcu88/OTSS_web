<?php
define('TITLE', 'Başarılı');
include('includes/header.php'); 
include('../dbConnection.php');
session_start();
if($_SESSION['is_login']){
 $rEmail = $_SESSION['rEmail'];
} else {
 echo "<script> location.href='RequesterLogin.php'; </script>";
}
$sql = "SELECT * FROM submitrequest_tb WHERE request_id = {$_SESSION['myid']}";
$result = $conn->query($sql);
if($result->num_rows == 1){
 $row = $result->fetch_assoc();
 echo "<div class='ml-5 mt-5'>
 <table class='table'>
  <tbody>
   <tr>
     <th>Talep ID</th>
     <td>".$row['request_id']."</td>
   </tr>
   <tr>
     <th>Adı</th>
     <td>".$row['requester_name']."</td>
   </tr>
   <tr>
   <th>E-posta</th>
   <td>".$row['requester_email']."</td>
  </tr>
   <tr>
    <th>Talep Bilgisi</th>
    <td>".$row['request_info']."</td>
   </tr>
   <tr>
    <th>Talep Açıklaması</th>
    <td>".$row['request_desc']."</td>
   </tr>

   <tr>
    <td><form class='d-print-none'><input class='btn btn-danger' type='submit' value='Yazdır' onClick='window.print()'></form></td>
  </tr>
  </tbody>
 </table> </div>
 ";


} else {
  echo "Başarısız";
}
?>


<?php
include('includes/footer.php'); 
$conn->close();
?>
