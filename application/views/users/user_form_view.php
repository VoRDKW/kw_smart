<div class="container-fluid">
    <!-- Columns start at 50% wide on mobile and bump up to 33.3% wide on desktop -->
    <div class="row">
        <div class="col-md-12">
            <h1 class="page-header"><?= $page_title ?></h1>            
        </div>
    </div>
    <div class="row">
        <?= $form['form_open'] ?>
        <div class="col-md-12">        
            <div class="form-group <?= (form_error('PersonalID')) ? 'has-error' : '' ?>">
                <label class="col-sm-2 control-label">เลขประจำตัวประชาชน :</label>
                <div class="col-sm-10">    
                    <?= $form['PersonalID'] ?>
                    <?php echo form_error('PersonalID', '<font color="error">', '</font>'); ?>
                </div>
            </div>
            <button type="submit" class="btn btn-lg" >บันทึก</button>
        </div>
        <?= $form['form_close'] ?>
    </div>
</div>