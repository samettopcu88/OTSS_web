<?php
// CSRF token oluşturma ve oturuma ekleme
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

include('dbConnection.php'); // Veritabanı bağlantı dosyasını dahil et

// Form gönderildiyse
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_REQUEST['submit'])) {
    // CSRF token doğrulama
    if ($_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die("CSRF token validation failed");
    }

    // XSS koruması
    $name = htmlspecialchars($_REQUEST['name']);
    $subject = htmlspecialchars($_REQUEST['subject']);
    $email = htmlspecialchars($_REQUEST['email']);
    $message = htmlspecialchars($_REQUEST['message']);

    // Form verilerini işleme
    // Buraya form verilerinin işlenmesiyle ilgili kodlarınızı ekleyin
    // Örneğin, form verilerini veritabanına kaydetme gibi işlemler yapılabilir
    // Bu kod örneği sadece CSRF ve XSS korumalarını göstermektedir
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css">

  <!-- Font Awesome CSS -->
  <link rel="stylesheet" href="css/all.min.css">

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="css/custom.css">

  <title>OTSS</title>
</head>

<body>
    <!-- Start Nav -->
    <nav class="navbar navbar-expand-sm navbar-dark bg-danger pl-5 fixed-top">
        <a href="index.php" class="navbar-brand">OTSS</a>
        <span class= "navbar-text">Müşteri Memnuniyeti Hedefimizdir</span>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#myMenu">
        </button>
        <div class="collapse navbar-collapse" id="myMenu">
            <ul class="navbar-nav pl-5 custom-nav">
             <li class="nav-item"><a href="index.php" class="nav-link">Ana Sayfa</a></li>
             <li class="nav-item"><a href="#Hizmetler" class="nav-link">Hizmetler</a></li>
             <li class="nav-item"><a href="#kayit" class="nav-link">Kayıt Ol</a></li>
             <li class="nav-item"><a href="Requester/RequesterLogin.php" class="nav-link">Giriş Yap</a></li>
             <li class="nav-item"><a href="#iletisim" class="nav-link">İletişim</a></li>
            </ul>
        </div>
    </nav> <!-- End Nav -->

  <!-- Start Header-->
  <header class="jumbotron back-image" style="background-image: url(images/Banner1.jpeg);">
    <div class="myclass mainHeading">
      <h1 class="text-uppercase text-danger font-weight-bold">OTSS'ye Hoşgeldiniz!</h1>
      <p style="color: white;" class="font-italic">Müşteri Memnuniyeti Hedefimizdir</p>
      <a href="Requester/RequesterLogin.php" class="btn btn-success mr-4">Giriş Yap</a>
      <a href="#kayit" class="btn btn-danger mr-4">Kayıt Ol</a>
    </div>
  </header> <!-- End Header -->

  <div class="container">
    <!--Bilgi Sec-->
    <div class="jumbotron">
      <h3 class="text-center">OTSS Teknik Servis</h3>
      <p>
      OTSS Hizmetleri, geniş bir hizmet yelpazesi sunan Türkiye'nin önde gelen Elektronik servis atölyeleri zinciridir. Dünya standartlarında Elektronik Eşya bakım hizmetleri sunarak kullanıcı deneyiminizi artırmaya odaklanıyoruz.
      </p>
      <p>
      En son teknolojiye sahip atölyelerimiz ülke genelinde birçok şehirde bulunmaktadır. Artık hizmetinizi çevrimiçi olarak kayıt yaparak da alabilirsiniz.
      </p>

    </div>
  </div>
  <!--Bilgi Sec End-->

<!-- Hizmetler Başlangıcı -->
<div class="container text-center border-bottom" id="Hizmetler">
    <h2>Hizmetlerimiz</h2>
    <div class="row mt-4">
      <div class="col-sm-4 mb-4">
        <a href="#"><i class="fas fa-tv fa-8x text-success"></i></a>
        <h4 class="mt-4">Elektronik Eşyalar</h4>
      </div>
      <div class="col-sm-4 mb-4">
        <a href="#"><i class="fas fa-sliders-h fa-8x text-primary"></i></a>
        <h4 class="mt-4">Önleyici Bakım</h4>
      </div>
      <div class="col-sm-4 mb-4">
        <a href="#"><i class="fas fa-cogs fa-8x text-info"></i></a>
        <h4 class="mt-4">Arıza Onarımı</h4>
      </div>
    </div>
  </div> <!-- Hizmetler Sonu -->

<!-- Kayıt Başlangıç Formu -->
<?php include('UserRegistration.php') ?>
<!-- Kayıt Formu Sonu -->

<!-- Müşteri Başlangıcı -->
<div class="jumbotron bg-danger" id="MutluMusteri">
  <!-- Mutlu Müşteri Başlangıcı -->
  <div class="container">
    <!-- Müşteri Konteyner Başlangıcı -->
    <h2 class="text-center text-white">Müşteri Geri Dönüşleri</h2>
    <div class="row mt-5">
      <div class="col-lg-3 col-sm-6">
        <!-- Müşteri 1. Sütun Başlangıcı-->
        <div class="card shadow-lg mb-2">
          <div class="card-body text-center">
            <img src="images/avtar1.jpeg" class="img-fluid" style="border-radius: 100px;">
            <h4 class="card-title">Mehmet Selim</h4>
            <p class="card-text">"Elektronik cihazımı servise bıraktım ve hızlı bir şekilde onarıldı. Çalışanlar son derece yardımsever ve profesyoneldi. Memnuniyetle tekrar tercih ederim."</p>
          </div>
        </div>
      </div> <!-- Müşteri 1. Sütun Sonu-->

      <div class="col-lg-3 col-sm-6">
        <!-- Müşteri 2. Sütun Başlangıcı-->
        <div class="card shadow-lg mb-2">
          <div class="card-body text-center">
            <img src="images/avtar2.jpeg" class="img-fluid" style="border-radius: 100px;">
            <h4 class="card-title">Sinem Baykal</h4>
            <p class="card-text">"Servis hizmetinden çok memnun kaldım. Sorunum hızlıca çözüldü ve iletişimleri oldukça düzgündü. Teşekkür ederim!"</p>
          </div>
        </div>
      </div> <!-- Müşteri 2. Sütun Sonu-->

      <div class="col-lg-3 col-sm-6">
        <!-- Müşteri 3. Sütun Başlangıcı-->
        <div class="card shadow-lg mb-2">
          <div class="card-body text-center">
            <img src="images/avtar3.jpeg" class="img-fluid" style="border-radius: 100px;">
            <h4 class="card-title">Serhat Kadim</h4>
            <p class="card-text">"Elektronik eşyamı servise gönderdim ve beklediğimden daha hızlı bir şekilde geri aldım. Tamirat sonrası cihazımın performansında belirgin bir iyileşme oldu. Teşekkürler."</p>
          </div>
        </div>
      </div> <!-- Müşteri 3. Sütun Sonu-->

      <div class="col-lg-3 col-sm-6">
        <!-- Müşteri 4. Sütun Başlangıcı-->
        <div class="card shadow-lg mb-2">
          <div class="card-body text-center">
            <img src="images/avtar4.jpeg" class="img-fluid" style="border-radius: 100px;">
            <h4 class="card-title">Eslem Kuzu</h4>
            <p class="card-text">"Servis ekibine teşekkür etmek istiyorum. Hızlı ve etkili bir şekilde sorunumu çözdüler. Memnun kaldım ve tavsiye ederim"</p>
          </div>
        </div>
      </div> <!-- Müşteri 4. Sütun Sonu-->
    </div> <!-- Müşteri Satırı Sonu-->
  </div> <!-- Müşteri Konteynerı Sonu -->
</div> <!-- Müşteri Sonu -->

<!--Start İletişime Geçin-->
<div class="container" id="iletisim">
    <!--Start İletişime Geçin Container-->
    <h2 class="text-center mb-4">İletişime Geçin</h2> <!-- İletişime Geçin Heading -->
    <div class="row">

<!--Start İletişime Geçin 1st Column-->
 <?php include('contactform.php') ?>
<!-- End İletişime Geçin 1st Column-->

<div class="col-md-4 text-center">
        
            <!-- Start İletişime Geçin 2nd Column-->
        <strong>Genel Merkez:</strong> <br>
        OTSS Ltd. Şti., <br>
       Altunizade , Üsküdar <br>
        İstanbul - 34568 <br>
        Phone: +92127776688 <br>
        <a href="#" target="_blank">www.otss.com</a> <br>

        <br><br>
        <strong>Ankara Bölgesi:</strong> <br>
        OSTS Ltd. Şti., <br>
        Kavaklıdere, Çankaya <br>
        Ankara - 06256 <br>
        Phone: +903127778855 <br>
        <a href="#" target="_blank">www.otss.com</a> <br>
      </div> <!-- End İletişime Geçin 2nd Column-->
    </div> <!-- End İletişime Geçin Row-->
  </div> <!-- End İletişime Geçin Container-->
  <!-- End İletişime Geçin -->

<!-- Footer Başlangıcı -->
<footer class="container-fluid bg-dark text-white mt-5" style="border-top: 3px solid #DC3545;">
  <div class="container">
    <!-- Footer Konteyneri Başlangıcı -->
    <div class="row py-3">
      <!-- Footer Satırı Başlangıcı -->
      <div class="col-md-6">
        <!-- Footer 1. Sütun Başlangıcı -->
        <span class="pr-2">Bizi Takip Edin: </span>
        <a href="#" target="_blank" class="pr-2 fi-color"><i class="fab fa-facebook-f"></i></a>
        <a href="#" target="_blank" class="pr-2 fi-color"><i class="fab fa-twitter"></i></a>
        <a href="#" target="_blank" class="pr-2 fi-color"><i class="fab fa-youtube"></i></a>
        <a href="#" target="_blank" class="pr-2 fi-color"><i class="fab fa-google-plus-g"></i></a>
        <a href="#" target="_blank" class="pr-2 fi-color"><i class="fas fa-rss"></i></a>
      </div> <!-- Footer 1. Sütun Sonu -->

      <div class="col-md-6 text-right">
        <!-- Footer 2. Sütun Başlangıcı -->
        <small> Tasarlayan: SametCT &copy; 2024.
        </small>
        <small class="ml-2"><a href="Admin/login.php">Yönetici Girişi</a></small>
      </div> <!-- Footer 2. Sütun Sonu -->
    </div> <!-- Footer Satırı Sonu -->
  </div> <!-- Footer Konteyneri Sonu -->
</footer> <!-- Footer Sonu -->


  <!-- Boostrap JavaScript -->
  <script src="js/jquery.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/all.min.js"></script>
</body>
</html>