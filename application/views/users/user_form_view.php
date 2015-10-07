<script>
    jQuery(document).ready(function ($) {
        $("#menu-top li").removeAttr('class');
    });
</script>
<div class="container" style="min-height: 800px;">
    <!-- Columns start at 50% wide on mobile and bump up to 33.3% wide on desktop -->
    <div class="row">
        <div class="col-md-12">
             <h4 class="page-head-line"><?= $page_title ?></h4>            
        </div>
    </div>
    <div class="row">
        <?= $form['form_open'] ?>
        <div class="col-md-8">
            <div class="form-group <?= (form_error('PersonalID')) ? 'has-error' : '' ?>">
                <label class="col-sm-3 control-label">เลขที่บัตรประชาชน</label>
                <div class="col-sm-8">            
                    <?= $form['PersonalID'] ?>
                    <?php echo form_error('PersonalID', '<font color="error">', '</font>'); ?>
                </div>
            </div>
            <div class="form-group <?= (form_error('UserName')) ? 'has-error' : '' ?>">
                <label class="col-sm-3 control-label">ชื่อผู้ใช้ :</label>
                <div class="col-sm-5">
                    <?= $form['UserName'] ?>
                    <?php echo form_error('UserName', '<font color="error">', '</font>'); ?>
                </div>
            </div>
            <div class="form-group <?= (form_error('Password')) ? 'has-error' : '' ?>">
                <label class="col-sm-3 control-label">รหัสผ่าน :</label>
                <div class="col-sm-4">
                    <?= $form['Password'] ?>
                    <?php echo form_error('Password', '<font color="error">', '</font>'); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">ชื่อ :</label>
                <div class="col-sm-4 <?= (form_error('Fname')) ? 'has-error' : '' ?>">
                    <?= $form['Fname'] ?>
                    <?php echo form_error('Fname', '<font color="error">', '</font>'); ?>
                </div>
                <label class="col-sm-2 control-label">นามสกุล :</label>
                <div class="col-sm-4 <?= (form_error('Lname')) ? 'has-error' : '' ?>">
                    <?= $form['Lname'] ?>
                    <?php echo form_error('Lname', '<font color="error">', '</font>'); ?>
                </div>
            </div>
            <div class="form-group <?= (form_error('MobilePhone')) ? 'has-error' : '' ?>">
                <label class="col-sm-3 control-label">เบอร์โทรศัพท์ :</label>
                <div class="col-sm-6">
                    <?= $form['MobilePhone'] ?>
                    <?php echo form_error('MobilePhone', '<font color="error">', '</font>'); ?>
                </div>
                
            </div>
            <div class="form-group <?= (form_error('Email')) ? 'has-error' : '' ?>">
                <label class="col-sm-3 control-label">อีเมล :</label>
                <div class="col-sm-5">
                    <?= $form['Email'] ?>
                    <?php echo form_error('Email', '<font color="error">', '</font>'); ?>
                </div>
            </div>       

        </div>
        <div class="col-md-4">
            <div class="col-md-6 col-md-offset-3">
                <img src="<?= base_url() ?>assets/img/64-64.jpg" alt="" class="img-circle" />
            </div>
            <div class="col-md-12">
                <div class="form-group <?= (form_error('ImageUserID')) ? 'has-error' : '' ?>">
                    <label class="col-sm-3 control-label">รูปภาพ :</label>
                    <div class="col-sm-9">
                        <?= $form['ImageUserID'] ?>
                        <?php echo form_error('ImageUserID', '<font color="error">', '</font>'); ?>
                    </div>
                </div> 
            </div>

        </div>
        <div class="col-md-12 text-center">

            <button  type="submit" class="btn btn-lg btn-success"><i class="fa fa-save fa-lg"></i>&nbsp;บันทึก</button>
            <a href="<?= base_url("user") ?>" type="reset" class="btn btn-lg btn-danger"><i class="fa fa-times fa-lg"></i>&nbsp;ยกเลิก</a>
        </div>

        <?= $form['form_close'] ?>
    </div>
</div>