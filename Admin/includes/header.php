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
    <!-- Üst Menü Çubuğu -->
    <nav class="navbar navbar-dark fixed-top bg-danger p-0 shadow">
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="dashboard.php">OSMS</a>
    </nav>

    <!-- Yan Menü -->
    <div class="container-fluid mb-5" style="margin-top:40px;">
        <div class="row">
            <nav class="col-sm-3 col-md-2 bg-light sidebar py-5 d-print-none">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link <?php if(PAGE == 'dashboard') { echo 'active'; } ?> " href="dashboard.php">
                                <i class="fas fa-tachometer-alt"></i>
                                Kontrol Paneli
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if(PAGE == 'work') { echo 'active'; } ?>" href="work.php">
                                <i class="fab fa-accessible-icon"></i>
                                İş Emri
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if(PAGE == 'request') { echo 'active'; } ?>" href="request.php">
                                <i class="fas fa-align-center"></i>
                                Talepler
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if(PAGE == 'assets') { echo 'active'; } ?>" href="assets.php">
                                <i class="fas fa-database"></i>
                                Varlıklar
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if(PAGE == 'technician') { echo 'active'; } ?>" href="technician.php">
                                <i class="fab fa-teamspeak"></i>
                                Teknisyenler
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if(PAGE == 'requesters') { echo 'active'; } ?>" href="requester.php">
                                <i class="fas fa-users"></i>
                                Talep Sahipleri
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if(PAGE == 'sellreport') { echo 'active'; } ?>" href="soldproductreport.php">
                                <i class="fas fa-table"></i>
                                Satış Raporu
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if(PAGE == 'workreport') { echo 'active'; } ?>" href="workreport.php">
                                <i class="fas fa-table"></i>
                                İş Raporu
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if(PAGE == 'changepass') { echo 'active'; } ?>" href="changepass.php">
                                <i class="fas fa-key"></i>
                                Şifre Değiştirme
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../logout.php">
                                <i class="fas fa-sign-out-alt"></i>
                                Çıkış
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
