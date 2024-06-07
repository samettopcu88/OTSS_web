<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        <?php echo TITLE ?>
    </title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="../css/all.min.css">

    <!-- Özel CSS -->
    <link rel="stylesheet" href="../css/custom.css">
</head>

<body>
    <!-- Üst Navigasyon Çubuğu -->
    <nav class="navbar navbar-dark fixed-top bg-danger flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="RequesterProfile.php">OTSS</a>
    </nav>

    <!-- Yan Menü -->
    <div class="container-fluid mb-5 " style="margin-top:40px;">
        <div class="row">
            <nav class="col-sm-2 bg-light sidebar py-5 d-print-none">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link <?php if(PAGE == 'RequesterProfile') { echo 'active'; } ?>" href="RequesterProfile.php">
                                <i class="fas fa-user"></i>
                                Profil <span class="sr-only">(şu anki)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if(PAGE == 'SubmitRequest') { echo 'active'; } ?>" href="SubmitRequest.php">
                                <i class="fab fa-accessible-icon"></i>
                                Talep Gönder
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if(PAGE == 'CheckStatus') { echo 'active'; } ?>" href="CheckStatus.php">
                                <i class="fas fa-align-center"></i>
                                Hizmet Durumu
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if(PAGE == 'Requesterchangepass') { echo 'active'; } ?>" href="Requesterchangepass.php">
                                <i class="fas fa-key"></i>
                                Şifre Değiştir
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../logout.php">
                                <i class="fas fa-sign-out-alt"></i>
                                Çıkış Yap
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
