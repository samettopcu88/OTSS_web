<?php
session_start();
include('dbConnection.php'); // Veritabanı bağlantı dosyasını dahil et

// CSRF token oluşturulması ve $_SESSION içerisine atanması
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_REQUEST['rSignup'])) { // rSignup formu gönderildiyse
    // CSRF token doğrulama
    if ($_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die("CSRF token validation failed");
    }

    // Boş alanları kontrol et
    if (empty($_REQUEST['rName']) || empty($_REQUEST['rEmail']) || empty($_REQUEST['rPassword'])) {
        $regmsg = '<div class="alert alert-warning mt-2" role="alert"> Tüm Alanlar Gereklidir </div>';
    } else {
        $sql = "SELECT r_email FROM requesterlogin_tb WHERE r_email='" . $conn->real_escape_string($_REQUEST['rEmail']) . "'";
        $result = $conn->query($sql);
        if ($result->num_rows == 1) {
            $regmsg = '<div class="alert alert-warning mt-2" role="alert"> Bu Email Zaten Kayıtlı </div>';
        } else {
            // Kullanıcı Değerlerini Değişkenlere Ata
            $rName = htmlspecialchars($_REQUEST['rName'], ENT_QUOTES, 'UTF-8');
            $rEmail = htmlspecialchars($_REQUEST['rEmail'], ENT_QUOTES, 'UTF-8');
            $rPassword = htmlspecialchars($_REQUEST['rPassword'], ENT_QUOTES, 'UTF-8');
            $sql = "INSERT INTO requesterlogin_tb(r_name, r_email, r_password) VALUES ('$rName','$rEmail', '$rPassword')";
            if ($conn->query($sql) === TRUE) {
                $regmsg = '<div class="alert alert-success mt-2" role="alert"> Hesap Başarıyla Oluşturuldu </div>';
            } else {
                $regmsg = '<div class="alert alert-danger mt-2" role="alert"> Hesap Oluşturulamadı </div>';
            }
        }
    }
}

?>
<div class="container pt-5" id="kayit">
    <h2 class="text-center">Hesap Oluştur</h2>
    <div class="row mt-4 mb-4">
        <div class="col-md-6 offset-md-3">
            <form action="" class="shadow-lg p-4" method="POST">
                <div class="form-group">
                    <i class="fas fa-user"></i><label for="name" class="pl-2 font-weight-bold">İsim</label>
                    <input type="text" class="form-control" placeholder="İsim" name="rName">
                </div>
                <div class="form-group">
                    <i class="fas fa-user"></i><label for="email" class="pl-2 font-weight-bold">E-mail</label>
                    <input type="email" class="form-control" placeholder="E-mail" name="rEmail">
                </div>
                <div class="form-group">
                    <i class="fas fa-key"></i><label for="pass" class="pl-2 font-weight-bold">Yeni Şifre</label>
                    <input type="password" class="form-control" placeholder="Şifre" name="rPassword">
                </div>
                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8'); ?>">
                <button type="submit" class="btn btn-danger mt-5 btn-block shadow-sm font-weight-bold" name="rSignup">Kaydol</button>
                <em style="font-size:10px;">Kaydol'a tıklayarak, şartlarımızı, veri ve çerez politikamızı kabul etmiş olursunuz.</em>
                <?php if (isset($regmsg)) { echo $regmsg; } ?>
            </form>
        </div>
    </div>
</div>
