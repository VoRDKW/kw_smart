<script>
    jQuery(document).ready(function ($) {
        $("#menu-top li").removeAttr('class');
    });
</script>
<div class="container-fluid" style="min-height: 800px;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4 class="page-head-line">ข้อมูลส่วนตัว</h4>
            </div>
            <div class="col-md-6">
                <dl class="dl-horizontal">
                    <dt>ชื่อผู้ใช้ :</dt>
                    <dd><?= $data['UserName'] ?></dd>
                    <dt>เลขประจำตัวประชาชน :</dt>
                    <dd><?= $data['PersonalID'] ?></dd>
                    <dt>อีเมล :</dt>
                    <dd><?= $data['Email'] ?></dd>
                    <dt>ชื่อ-นามสกุล :</dt>
                    <dd><?= $data['Fname'] . '' . $data['Lname'] ?></dd>
                    <dt>เข้าสู่ระบบล่าสุด :</dt>
                    <dd><?= $data['LastLogin'] ?></dd>                    
                </dl>
            </div>
            <div class="col-md-6">
                <img height="200" width="auto" src="<?= base_url('assets/upload/' . $data['ImageThumbPath']) ?>"  class="img-thumbnail">
            </div>
            <div class="col-md-12">
                <a href="<?= base_url('user/edit/') ?>" class="btn btn-warning"><i class="fa fa-lg fa-edit"></i>แก้ไขข้มูลส่วนตัว</a>
                <a href="<?= base_url('home') ?>" class="btn btn-default"><i class="fa fa-fw fa-home"></i>กลับหน้าหลัก</a>
            </div>
            
        </div>
    </div>
</div>