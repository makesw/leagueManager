<?php
session_start();
if ( !isset( $_SESSION[ 'dataSession' ] ) ) {
    header( 'Location: ../index.html' );
}else{
    if($_SESSION[ 'dataSession' ]['perfil'] != 'admin'){
        header( 'Location: ../salir.php' );
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Leaguemanager - A fully responsive, HTML5 Football League Manager">
    <meta name="keywords" content="Responsive, HTML5, admin theme, business, professional, jQuery, web design, CSS3, sass">
    <title>LeagueManager</title>

    <!-- Site favicon -->
    <link rel='shortcut icon' type='image/x-icon' href='../images/favicon.ico' />
    <!-- /site favicon -->

    <!-- Font Material stylesheet -->
    <link rel="stylesheet" href="../fonts/material-design-iconic-font/css/material-design-iconic-font.min.css">
    <!-- /font material stylesheet -->

    <!-- sprite-flags-master stylesheet -->
    <link rel="stylesheet" href="../fonts/sprite-flags-master/sprite-flags-32x32.css">
    <!-- /sprite-flags-master stylesheet -->

    <!--Weather stylesheet -->
    <link rel="stylesheet" href="../fonts/weather-icons-master/css/weather-icons.min.css">
    <!--/Weather stylesheet -->

    <!-- Bootstrap stylesheet -->
    <link href="../css/mouldifi-bootstrap.css" rel="stylesheet">
    <!-- /bootstrap stylesheet -->

    <!-- Perfect Scrollbar stylesheet -->
    <link href="../node_modules/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
    <!-- /perfect scrollbar stylesheet -->

    <!-- c3 Chart's css file -->
    <link href="../node_modules/c3/c3.min.css" rel="stylesheet">
    <!-- /c3 chart stylesheet -->

    <!-- Chartists Chart's css file -->
    <link href="../node_modules/chartist/dist/chartist.min.css" rel="stylesheet">
    <!-- /chartists chart stylesheet -->

    <!-- Mouldifi-core stylesheet -->
    <link href="../css/mouldifi-core.css" rel="stylesheet">
    <!-- /mouldifi-core stylesheet -->

    <!-- Color-Theme stylesheet -->
    <link id="override-css-id" href="../css/theme-indigo.min.css" rel="stylesheet">
    <!-- Color-Theme stylesheet -->

</head>

<body id="body" data-theme="indigo">

<!-- Loader Backdrop -->
<div class="loader-backdrop">
    <!-- Loader -->
    <div class="loader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/>
        </svg>
    </div>
    <!-- /loader-->
</div>
<!-- loader backdrop -->

<!-- Page container -->
<div class="gx-container">

    <!-- Page Sidebar -->
    <div id="menu" class="side-nav gx-sidebar">
        <div class="navbar-expand-lg">
            <!-- Sidebar header  -->
            <div class="sidebar-header">
                <a class="site-logo" href="./">
                    <img src="../images/logo.png" alt="Mouldifi" title="Mouldifi">
                </a>
            </div>
            <!-- /sidebar header -->

            <!-- Main navigation -->
           <?php include("./menu.html");?>
            <!-- /main navigation -->
        </div>
    </div>
    <!-- /page sidebar -->

    <!-- Main Container -->
    <div class="gx-main-container">

        <!-- Main Header -->
        <header class="main-header">
            <div class="gx-toolbar">
                <div class="sidebar-mobile-menu">
                    <a class="gx-menu-icon menu-toggle" href="#menu">
                        <span class="menu-icon icon-grey"></span>
                    </a>
                </div>
                <ul class="quick-menu header-notifications ml-auto">
                    <li class="dropdown user-nav">
                        <a class="dropdown-toggle no-arrow d-inline-block" href="#" role="button" id="userInfo"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar size-40" src="../images/placeholder.jpg" alt="...">
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userInfo">
                            <div class="user-profile">
                                <img class="user-avatar border-0 size-40" src="<?php echo $_SESSION['dataSession']['url_foto'];?>">
                                <div class="user-detail ml-2">
                                    <h4 class="user-name mb-0"><?php echo $_SESSION['dataSession']['nombres'].' '.$_SESSION['dataSession']['apellidos'];?></h4>
                                    <small><?php echo $_SESSION['dataSession']['perfil'];?></small>
                                </div>
                            </div>   
                             <a class="dropdown-item" href="../salir.php">
                                <i class="zmdi zmdi-sign-in zmdi-hc-fw mr-1"></i>
                                Salir
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </header>
        <!-- /main header -->

        <!-- Main Content -->
        <div class="gx-main-content">
            <!--gx-wrapper-->
            <div class="gx-wrapper" id="divContenido">
            <div class="dashboard">
                    <div class="mouldifitron" style="text-align: center;vertical-align: top;">
                        <div class="display-4 mb-3">LEAGUE MANAGER</div>
                       <img src="../images/welcome_logo.png"/><br/><br/><br/><br/>
                </div>
            </div>
            <!--/gx-wrapper-->

            <!-- Footer -->
           <footer class="gx-footer">
                <div class="d-flex flex-row justify-content-between">
                    <p>MakeSw © 2019</p>
                    <a href="www.makesw.com" class="btn-link" target="_blank">www.makesw.com</a>
                </div>
            </footer>
            <!-- /footer -->

        </div>
        <!-- /main content -->

    </div>
    <!-- /main container -->

</div>
<!-- /page container -->

<!-- Menu Backdrop -->
<div class="menu-backdrop fade"></div>
<!-- /menu backdrop -->

<!--Load JQuery-->
<script src="../node_modules/jquery/dist/jquery.min.js"></script>
<!--Bootstrap JQuery-->
<script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<!--Perfect Scrollbar JQuery-->
<script src="../node_modules/perfect-scrollbar/dist/perfect-scrollbar.min.js"></script>
<!--Big Slide JQuery-->
<script src="../node_modules/bigslide/dist/bigSlide.min.js"></script>

<!--Custom JQuery-->
<script src="../js/functions.js"></script>
</body>
</html>