<?php
define('TITLE', 'Talep Gönder');
define('PAGE', 'SubmitRequest');
include('includes/header.php'); 
include('../dbConnection.php');
session_start();
if($_SESSION['is_login']){
 $rEmail = $_SESSION['rEmail'];
} else {
 echo "<script> location.href='RequesterLogin.php'; </script>";
}
if(isset($_REQUEST['submitrequest'])){
 // Boş Alan Kontrolü
 if(($_REQUEST['requestinfo'] == "") || ($_REQUEST['requestdesc'] == "") || ($_REQUEST['requestername'] == "") || ($_REQUEST['requesteradd1'] == "") || ($_REQUEST['requesteradd2'] == "") || ($_REQUEST['requestercity'] == "") || ($_REQUEST['requesterstate'] == "") || ($_REQUEST['requesterzip'] == "") || ($_REQUEST['requesteremail'] == "") || ($_REQUEST['requestermobile'] == "") || ($_REQUEST['requestdate'] == "")){
  // Gerekli Alan Eksikse Gösterilecek Mesaj
  $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Tüm Alanları Doldurun </div>';
 } else {
   // Kullanıcı Değerlerini Güvenli Bir Şekilde Atama
   $rinfo = htmlspecialchars($_REQUEST['requestinfo'], ENT_QUOTES);
   $rdesc = htmlspecialchars($_REQUEST['requestdesc'], ENT_QUOTES);
   $rname = htmlspecialchars($_REQUEST['requestername'], ENT_QUOTES);
   $radd1 = htmlspecialchars($_REQUEST['requesteradd1'], ENT_QUOTES);
   $radd2 = htmlspecialchars($_REQUEST['requesteradd2'], ENT_QUOTES);
   $rcity = htmlspecialchars($_REQUEST['requestercity'], ENT_QUOTES);
   $rstate = htmlspecialchars($_REQUEST['requesterstate'], ENT_QUOTES);
   $rzip = htmlspecialchars($_REQUEST['requesterzip'], ENT_QUOTES);
   $remail = htmlspecialchars($_REQUEST['requesteremail'], ENT_QUOTES);
   $rmobile = htmlspecialchars($_REQUEST['requestermobile'], ENT_QUOTES);
   $rdate = htmlspecialchars($_REQUEST['requestdate'], ENT_QUOTES);
   $sql = "INSERT INTO submitrequest_tb(request_info, request_desc, requester_name, requester_add1, requester_add2, requester_city, requester_state, requester_zip, requester_email, requester_mobile, request_date) VALUES ('$rinfo','$rdesc', '$rname', '$radd1', '$radd2', '$rcity', '$rstate', '$rzip', '$remail', '$rmobile', '$rdate')";
   if($conn->query($sql) == TRUE){
    // Form Gönderimi Başarılı Olduğunda Görüntülenecek Mesaj
    $genid = mysqli_insert_id($conn);
    $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert"> Talep Başarıyla Gönderildi ' . $genid .' </div>';
    session_start();
    $_SESSION['myid'] = $genid;
    echo "<script> location.href='submitrequestsuccess.php'; </script>";
    // include('submitrequestsuccess.php');
   } else {
    // Form Gönderimi Başarısız Olduğunda Görüntülenecek Mesaj
    $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Talebiniz Gönderilemedi </div>';
   }
 }
}
?>
<div class="col-sm-9 col-md-10 mt-5">
  <form class="mx-5" action="" method="POST">
    <div class="form-group">
      <label for="inputRequestInfo">Talep Bilgisi</label>
      <input type="text" class="form-control" id="inputRequestInfo" placeholder="Talep Bilgisi" name="requestinfo">
    </div>
    <div class="form-group">
      <label for="inputRequestDescription">Açıklama</label>
      <input type="text" class="form-control" id="inputRequestDescription" placeholder="Açıklama Yazın" name="requestdesc">
    </div>
    <div class="form-group">
      <label for="inputName">Adı</label>
      <input type="text" class="form-control" id="inputName" placeholder="" name="requestername">
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="inputAddress">Adres Satırı 1</label>
        <input type="text" class="form-control" id="inputAddress" placeholder="Ev No. 123" name="requesteradd1">
      </div>
      <div class="form-group col-md-6">
        <label for="inputAddress2">Adres Satırı 2</label>
        <input type="text" class="form-control" id="inputAddress2" placeholder="" name="requesteradd2">
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="inputCity">Şehir</label>
        <input type="text" class="form-control" id="inputCity" name="requestercity">
      </div>
      <div class="form-group col-md-4">
        <label for="inputState">İlçe</label>
        <input type="text" class="form-control" id="inputState" name="requesterstate">
      </div>
      <div class="form-group col-md-2">
        <label for="inputZip">Posta Kodu</label>
        <input type="text" class="form-control" id="inputZip" name="requesterzip" onkeypress="isInputNumber(event)">
      </div>
    </div>

    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="inputEmail">E-posta</label>
        <input type="email" class="form-control" id="inputEmail" name="requesteremail">
      </div>
      <div class="form-group col-md-2">
        <label for="inputMobile">Telefon</label>
        <input type="text" class="form-control" id="inputMobile" name="requestermobile" onkeypress="isInputNumber(event)">
      </div>
      <div class="form-group col-md-2">
        <label for="inputDate">Tarih</label>
        <input type="date" class="form-control" id="inputDate" name="requestdate">
      </div>
    </div>

    <button type="submit" class="btn btn-danger" name="submitrequest">Gönder</button>
    <button type="reset" class="btn btn-secondary">Sıfırla</button>
  </form>
  <!-- Boş alan eksikliği veya form gönderimi başarılı veya başarısız olduğunda görüntülenecek mesaj -->
  <?php if(isset($msg)) {echo $msg; } ?>
</div>
</div>
</div>
<!-- Sadece sayı girişi için -->
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
$conn->close();
?>
