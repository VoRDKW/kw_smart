<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="keywords"
              content="">
        <meta name="description"
              content="">
        <meta name="author" content="VoRDcs">  
        <title><?php echo $title; ?></title>

        <!-- Favicons -->
        <link rel="apple-touch-icon-precomposed" sizes="144x144"
              href="<?= asset_url() ?>img/apple-touch-icon-144-precomposed.png<?= '?v=' . $version ?>">
        <link rel="shortcut icon" href="<?= asset_url() ?>img/favicon.ico<?= '?v=' . $version ?>">
        <!-- Bootstrap core CSS ans JS -->

        <?php echo js('pace.min.js?v=' . $version); ?>

        <?php echo css('bootstrap.css?v=' . $version); ?>
        <?php echo css('bootflat.min.css?v=' . $version); ?>
        <?php echo css('pace.css?v=' . $version); ?>
        <?php echo css('label.min.css?v=' . $version); ?>
        <?php echo css('segment.min.css?v=' . $version); ?>
        <?php echo css('font-awesome.css?v=' . $version); ?>
        <?php echo css('animate.css?v=' . $version); ?>
        <?php echo css('site.min.css?v=' . $version); ?>
        <?php echo css('style.css?v=' . $version); ?>
        <!-- js -->
        <?php echo js('jquery.js?v=' . $version); ?>
        <?php echo js('site.min.js?v=' . $version); ?>

        <script type="text/javascript">
            $(window).scroll(function () {
                if ($(this).scrollTop() > 150) { //use `this`, not `document`
                    $('#top-nav').fadeOut();
                    $('#fix-menu').addClass('navbar-fixed-top');
                    $(".pace-progress").css("margin-top", "58px");
                } else {
                    $('#top-nav').fadeIn();
                    $('#fix-menu').removeClass('navbar-fixed-top');
                    $(".pace-progress").css("margin-top", "91px");
                }
                if ($(this).scrollTop() > $(window).height() / 2) {
                    $('#scroll-top').removeClass('hidden');
                } else {
                    $('#scroll-top').addClass('hidden');
                }
            });
            jQuery(window).load(function () {
                $('.alert').delay(3000).fadeOut();
            });
        </script>

    </head>
    <body>
        <!-- MENU SECTION START-->
        <div id="top-nav" class="navbar navbar-inverse set-radius-zero hidden-xs hidden-sm" >
            <div class="container">
                <div class="navbar-header">                        
                    <a class="navbar-brand" href="index.html">
                        <img width="100%" src="<?= base_url() ?>assets/img/kwcrs.png" />
                    </a>
                </div>
                <div class="left-div">
                    <div class="user-settings-wrapper">
                        <ul class="nav">
                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                                    <span class="glyphicon glyphicon-user" style="font-size: 25px;"></span>
                                </a>
                                <div class="dropdown-menu dropdown-settings color-white">
                                    <div class="media">
                                        <a class="media-left" href="#">
                                            <img src="<?= base_url() ?>assets/img/64-64.jpg" alt="" class="img-circle" />
                                        </a>
                                        <div class="media-body">
                                            <h4 class="media-heading color-white">Jhon Deo Alex </h4>
                                            <h5>Developer & Designer</h5>
                                        </div>
                                    </div>
                                    <hr />
                                    <h5><strong>Personal Bio : </strong></h5>
                                    Anim pariatur cliche reprehen derit.
                                    <hr />
                                    <a href="profile.html" class="btn btn-info btn-sm">ข้อมูลผู้ใช้</a>&nbsp; 
                                    <a href="login.html" class="btn btn-danger btn-sm">ออกจากระบบ</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- LOGO HEADER END-->
        <section id="fix-menu" class="menu-section">
            <div class="container-fluid">
                  <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>                      
                </div>
                <div class="row">                  
                    <div class="col-md-12">
                        <div class="navbar-collapse collapse">                            
                            <ul id="menu-top" class="nav navbar-nav navbar-right">
                                <li id="btnHome"><a class="menu-top-active" href="index.html">หน้าหลัก</a></li>
                                <li id="btnMaintenance"><a href="form-input.html">ซ่อมบำรุงคอมพิวเตอร์</a></li>
                                <!--<li id="btnHistrory"><a href="myjob.html">ประวัติแจ้งซ่อม</a></li>-->                   
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- MENU SECTION END-->
        <?php
        if (isset($debug) && $debug != NULL) {
            echo '<div class="container" style="margin-top: 60px;">';
            print '<pre>';
            print_r($debug);
            print '</pre>';
            echo '</div>';
        }

        if (isset($alert) && $alert != NULL) {
            if ($alert['alert_mode'] == 'success') {
                echo '<div class="container alert alert-success animated pulse" style="margin-top: 60px;"><strong>สำเร็จ</strong> ';
            } elseif ($alert['alert_mode'] == 'warning') {
                echo '<div class="container alert alert-warning animated pulse" style="margin-top: 60px;"><strong>คำเตือน</strong> ';
            } elseif ($alert['alert_mode'] == 'danger') {
                echo '<div class="container alert alert-danger animated pulse" style="margin-top: 60px;"><strong>ผิดพลาด</strong> ';
            } else {
                echo '<div class="container alert alert-info animated pulse" style="margin-top: 60px;"><strong>เพิ่มเติม</strong> ';
            }
            echo $alert['alert_message'];
            echo '</div>';
        }

        if (isset($real_alert) && $real_alert != NULL) {
            if ($real_alert['alert_mode'] == 'success') {
                echo '<div class="container alert alert-success animated pulse" style="margin-top: 60px;"><strong>สำเร็จ</strong> ';
            } elseif ($real_alert['alert_mode'] == 'warning') {
                echo '<div class="container alert alert-warning animated pulse" style="margin-top: 60px;"><strong>คำเตือน</strong> ';
            } elseif ($real_alert['alert_mode'] == 'danger') {
                echo '<div class="container alert alert-danger animated pulse" style="margin-top: 60px;"><strong>ผิดพลาด</strong> ';
            } else {
                echo '<div class="container alert alert-info animated pulse" style="margin-top: 60px;"><strong>เพิ่มเติม</strong> ';
            }
            echo $real_alert['alert_message'];
            echo '</div>';
        }
        ?>