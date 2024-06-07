<?php
if(isset($_REQUEST['submit'])) {
    if(($_REQUEST['name'] == "") || ($_REQUEST['subject'] == "") || ($_REQUEST['email'] == "") || ($_REQUEST['message'] == "")){
        $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Tüm Alanları Doldurun </div>';
    } else {
        $name = $_REQUEST['name'];
        $subject = $_REQUEST['subject'];
        $email = $_REQUEST['email'];
        $message = $_REQUEST['message'];

        // Resim işlemleri
        $hedefKlasor = "uploads/";
        $hedefDosya = $hedefKlasor . basename($_FILES["fileToUpload"]["name"]);
        $yuklemeDurumu = 1;
        $dosyaTuru = strtolower(pathinfo($hedefDosya,PATHINFO_EXTENSION));

        // Resmi kontrol et
        if(isset($_POST["submit"])) {
            $boyutKontrol = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($boyutKontrol !== false) {
                $yuklemeDurumu = 1;
            } else {
                $msg .= '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Dosya bir resim değil. </div>';
                $yuklemeDurumu = 0;
            }
        }

        // Dosya zaten var mı kontrol et
        if (file_exists($hedefDosya)) {
            $msg .= '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Üzgünüz, dosya zaten mevcut. </div>';
            $yuklemeDurumu = 0;
        }

        // Dosya boyutunu kontrol et
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            $msg .= '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Üzgünüz, dosyanız çok büyük. </div>';
            $yuklemeDurumu = 0;
        }

        // İzin verilen dosya formatlarını kontrol et
        if($dosyaTuru != "jpg" && $dosyaTuru != "png" && $dosyaTuru != "jpeg"
        && $dosyaTuru != "gif" ) {
            $msg .= '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Üzgünüz, sadece JPG, JPEG, PNG ve GIF dosya türleri izin verilir. </div>';
            $yuklemeDurumu = 0;
        }

        // Hata olup olmadığını kontrol et ve dosyayı yükle
        if ($yuklemeDurumu == 0) {
            $msg .= '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Üzgünüz, dosyanız yüklenemedi. </div>';
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $hedefDosya)) {
                $msg .= '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert"> Dosya '. htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). ' başarıyla yüklendi. </div>';
            } else {
                $msg .= '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Üzgünüz, dosyanızı yüklerken bir hata oluştu. </div>';
            }
        }

        // E-posta gönderme işlemleri
        $mailTo = "contact@otss.com";
        $headers = "From: ". $email;
        $txt = "Size bir e-posta gönderildi ". $name. " tarafından.\n\n".$message;
        $txt .= "\n\nEkli Resim: ".$hedefDosya;
        mail($mailTo, $subject, $txt, $headers);

        $msg .= '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert"> Başarıyla Gönderildi </div>';
    }
}
?>

<!-- İletişim Formu Satırını Başlat -->
<div class="col-md-8">
    <!-- İletişim Formu 1. Sütunu Başlat -->
    <form action="" method="post" enctype="multipart/form-data">
        <input type="text" class="form-control" name="name" placeholder="İsim"><br>
        <input type="text" class="form-control" name="subject" placeholder="Konu"><br>
        <input type="email" class="form-control" name="email" placeholder="E-posta"><br>
        <textarea class="form-control" name="message" placeholder="Nasıl yardımcı olabiliriz?" style="height:150px;"></textarea><br>
        <div class="form-group">
            <input type="file" name="fileToUpload" id="fileToUpload">
        </div>
        <br>
        <input class="btn btn-primary" type="submit" value="Gönder" name="submit"><br><br>
        <?php if(isset($msg)) {echo $msg; } ?>
    </form>
</div> <!-- İletişim Formu 1. Sütunu Sonu -->
