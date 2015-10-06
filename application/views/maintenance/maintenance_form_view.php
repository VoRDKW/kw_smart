<div class="content-wrapper">
    <div class="container">
        <div class="row">
            <h4 class="page-head-line">แจ้งซ่อม</h4>
            <form class="form-horizontal">
                <div class="col-md-12">
                    <div class="form-group <?= (form_error('JobName')) ? 'has-error' : '' ?>">
                        <label class="col-md-2 control-label">หัวข้อ :</label>
                        <div class="col-md-8">
                            <?= $form['JobName'] ?>
                            <?php echo form_error('JobName', '<font color="error">', '</font>'); ?>
                        </div>    
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-offset-1 col-md-3">
                                <div class="form-group <?= (form_error('Building')) ? 'has-error' : '' ?>">
                                    <label class="col-md-4">อาคาร :</label>
                                    <div class="col-md-8">
                                        <?= $form['BuildingID'] ?>
                                        <?php echo form_error('BuildingID', '<font color="error">', '</font>'); ?> 
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group <?= (form_error('RoomNo')) ? 'has-error' : '' ?>">
                                    <label class="col-md-3">ห้อง :</label>
                                    <div class="col-md-9">
                                        <?= $form['RoomNo'] ?>
                                        <?php echo form_error('RoomNo', '<font color="error">', '</font>'); ?> 
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group <?= (form_error('Floor')) ? 'has-error' : '' ?>">
                                    <label class="col-md-3">ชั้น :</label>
                                    <div class="col-md-9">
                                        <?= $form['Floor'] ?>
                                        <?php echo form_error('Floor', '<font color="error">', '</font>'); ?> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>                
                    <div class="form-group <?= (form_error('NumberKWDevice')) ? 'has-error' : '' ?>">
                        <label class="col-md-2 control-label">เลขที่ กว. :</label>
                        <div class="col-md-8">
                            <?= $form['NumberKWDevice'] ?>
                            <?php echo form_error('NumberKWDevice', '<font color="error">', '</font>'); ?>  
                        </div>         
                    </div>
                    <div class="form-group <?= (form_error('JobDetail')) ? 'has-error' : '' ?>">
                        <label class="col-md-2 control-label">ปัญหาที่แจ้ง :</label>
                        <div class="col-md-8">
                            <?= $form['JobDetail'] ?>
                            <?php echo form_error('JobDetail', '<font color="error">', '</font>'); ?>   
                        </div>        
                    </div>
                    <div class="form-group <?= (form_error('Note')) ? 'has-error' : '' ?>">
                        <label class="col-md-2 control-label">หมายเหตุ :</label>
                        <div class="col-md-8">
                            <?= $form['Note'] ?>
                            <?php echo form_error('Note', '<font color="error">', '</font>'); ?>
                        </div>           
                    </div>   
                    <div class="form-group <?= (form_error('ImageName')) ? 'has-error' : '' ?>">
                        <label class="col-md-2 control-label">แนบรูปภาพ :</label>
                        <div class="col-md-10">
                            <?= $form['ImageName'] ?>
                            <?php echo form_error('ImageName', '<font color="error">', '</font>'); ?> 
                        </div>          
                    </div><hr/>
                    <div class="form-group" style="float:right">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-check"></i>แจ้งซ่อม</button>
                        <a href="<?= base_url('home');?>" class="btn btn-danger" type="reset"><i class="fa fa-fw fa-times"></i>ยกเลิก</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>