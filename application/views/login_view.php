<?php $version = 1.0 ?>
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
        <title>เข้าสู่ระบบ | KW Smart App</title>

        <!-- Favicons -->
        <link rel="apple-touch-icon-precomposed" sizes="144x144"
              href="<?= asset_url() ?>img/apple-touch-icon-144-precomposed.png<?= '?v=' . $version ?>">
        <link rel="shortcut icon" href="<?= asset_url() ?>img/favicon.ico<?= '?v=' . $version ?>">
        <!-- Bootstrap core CSS ans JS -->

        <?php echo css('bootstrap.css?v=' . $version); ?>
        <?php echo css('bootflat.min.css?v=' . $version); ?>
        <?php echo css('font-awesome.css?v=' . $version); ?>
        <?php echo css('animate.css?v=' . $version); ?>
        <?php echo css('signin.css?v=' . $version); ?>
        <?php echo js('jquery.js?v=' . $version); ?>
        <?php echo js('bootstrap.js?v=' . $version); ?>

        <!-- custrom style-->
        <script type="text/javascript">
            jQuery(window).load(function () {
                $('.alert').delay(3000).fadeOut();
            });
        </script>

    </head>
    <body>
        <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">ระบบแจ้งซ่อมบำรุงคอมพิวเตอร์</a>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
                    <p class="navbar-text navbar-right"></p>
                </div>
            </div>
        </div>
        <div class="container">
            <?php if (validation_errors() != NULL) { ?>
                <div class="row animated bounceInDown" style="margin-top: 2%">
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4> ผิดพลาด ! <small><?= validation_errors() ?></small></h4>
                    </div>
                </div>
            <?php } ?>
            <div class="col-lg-8 col-md-8 col-sm-8" style="margin-top:60px;w">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">ยินดีต้อนรับ</h3>
                    </div>
                    <div class="panel-body">
                         &nbsp; ยินดีต้อนรับเข้าสู่ระบบเเจ้งซ่อมบำรุงคอมพิวเตอร์โรงเรียนกัลยาณวัตร จังหวัดขอนแก่น เป็นระบบที่ให้บริการความสะดวกสบายในการแจ้งซ่อมคอมพิวเตอร์หรืออุปกรณ์โสตทัศนูปโภคภายในโรงเรียนกัลยาณวัตร
                        <br />
                            <strong>บริการภายในระบบ :</strong>
                            <ul>
                                <li>
                                    แจ้งซ่อมคอมพิวเตอร์สะดวกสะบาย
                                </li>
                                <li>
                                    ดำเนินการซ่อมรวดเร็ว ทันใจอย่างมีประสิทธิภาพ
                                </li>
                                <li>
                                    สามารถติดตามผลการซ่อมภายหลังได้
                                </li>                            
                            </ul>
                    </div>                    
                </div>
                <div class="panel panel-success">
                        <div class="panel-body">
                           <strong>การลงชื่อเข้าสู่ระบบ :</strong>
                            <ul>
                                <li>
                                    ชื่อผู้ใช้ สามารถใช้รหัสประจำตัวนักเรียน/ครู
                                </li>
                                <li>
                                    ชื่อผู้ใช้สามารถใช้เลขบัตรประจำตัวประชาชน
                                </li>
                                <li>
                                    รหัสผ่านเริ่มต้น คือ 1234 
                                </li>
                            </ul>
                        </div>
                    </div>               
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4">

                <div class="login-container">

                    <?= $form_action ?>
                    <h3 class="form-signin-heading">เข้าสู่ระบบ</h3>
                    <?= $form_input['username'] ?>
                    <?= $form_input['password'] ?>    
                    <button class="btn btn-lg btn-success btn-block" type="submit">ลงชื่อเข้าใช้งาน</button>
                    <?= form_close() ?>                  
                </div>
            </div>
        </div>
    </body>
</html>