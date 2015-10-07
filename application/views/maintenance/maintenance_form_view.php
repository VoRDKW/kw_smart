<script type="text/javascript">
    jQuery(document).ready(function () {

        $("#menu-top li").removeAttr('class');
        $("#btnMaintenance").addClass("menu-top-active");

        var BuildingID = '';
        var FloorNo = '';
        $("#BuildingID").change(function () {
            BuildingID = $('#BuildingID').val();
            if (BuildingID !== 0) {
                $('#Floor').show();
                var data_post = {
                    'BuildingID': BuildingID
                };
                $.ajax({
                    url: '<?= base_url() . 'maintenance/get_floor' ?>',
                    type: 'POST',
                    dataType: 'json',
                    data: data_post,
                    error: function () {
                        alert("Error!");
                    },
                    success: function (response) {
                        console.log(response);
                        //alert(response.NumFloor);
                        var op = "<option value='0'> เลือกชั้น</option>";
                        for (i = 1; i <= response.NumFloor; i++) {
                            op += "<option value='" + i + "'> ชั้น " + i + "</option>";
                        }
                        $('#Floor').html(op);
                    } // End of success function of ajax form
                }); // End of ajax call
            }
        });
        $("#Floor").change(function () {
            FloorNo = $('#Floor').val();
            if (BuildingID !== '') {
                var data_post = {
                    'BuildingID': $('#BuildingID').val(),
                    'FloorNo': FloorNo
                };
                //alert('อาคาร ' + BuildingID + ' ชั้น ' + FloorNo);
                $.ajax({
                    url: '<?= base_url() . 'maintenance/get_room' ?>',
                    type: 'POST',
                    dataType: 'json',
                    data: data_post,
                    error: function () {
                        alert("Error!");
                    },
                    success: function (response) {
                        if (response.length <= 0) {
                            $('#RoomID').hide();
                        } else {
                            $('#RoomID').show();
                        }
                        var op = "<option value='0'>เลือกห้อง</option>";
                        for (var i = 0, len = response.length; i < len; i++) {
                            var RoomID = response[i].RoomID;
                            var RoomNO = response[i].RoomNO;
                            var RoomName = response[i].RoomName;
                            op += "<option value='" + RoomID + "'> ห้อง " + RoomNO + ' ' + RoomName + "</option>";
                            console.log(response[i]);
                        }
                        $('#RoomID').html(op);
                    } // End of success function of ajax form
                }); // End of ajax call
            }
        });
    });
</script>
<div class="container" style="padding-bottom: 8%;padding-top: 1%">
    <div class="row">
        <h4 class="page-head-line"><?= $page_title ?></h4>
    </div>
    <div class="row">
        <?= $form['form_open'] ?>
        <div class="col-md-12">
            <div class="form-group <?= (form_error('JobName')) ? 'has-error' : '' ?>">
                <label class="col-md-2 control-label">หัวข้อ :</label>
                <div class="col-md-8">
                    <?= $form['JobName'] ?>
                    <?php echo form_error('JobName', '<font color="error">', '</font>'); ?>
                </div>    
            </div>
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
                    <div class="form-group <?= (form_error('Floor')) ? 'has-error' : '' ?>">
                        <label class="col-md-3">ชั้น :</label>
                        <div class="col-md-9">
                            <?= $form['Floor'] ?>
                            <?php echo form_error('Floor', '<font color="error">', '</font>'); ?> 
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group <?= (form_error('RoomNo')) ? 'has-error' : '' ?>">
                        <label class="col-md-3">ห้อง :</label>
                        <div class="col-md-9">
                            <?= $form['RoomID'] ?>
                            <?php echo form_error('RoomNo', '<font color="error">', '</font>'); ?> 
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
            <div class="form-group <?= (form_error('Detail')) ? 'has-error' : '' ?>">
                <label class="col-md-2 control-label">ปัญหาที่แจ้ง : </label>
                <div class="col-md-8">
                    <?= $form['Detail'] ?>
                    <?php echo form_error('Detail', '<font color="error">', '</font>'); ?>   
                </div>        
            </div>
            <div class="form-group <?= (form_error('Note')) ? 'has-error' : '' ?>">
                <label class="col-md-2 control-label">หมายเหตุ : </label>
                <div class="col-md-8">
                    <?= $form['Note'] ?>
                    <?php echo form_error('Note', '<font color="error">', '</font>'); ?>
                </div>           
            </div>   
            <div class="form-group <?= (form_error('ImageName')) ? 'has-error' : '' ?>">
                <label class="col-md-2 control-label">รูปภาพ :</label>
                <div class="col-md-10">
                    <?= $form['ImageName'] ?>
                    <?php echo form_error('ImageName', '<font color="error">', '</font>'); ?> 
                </div>          
            </div>
        </div>
        <div class="col-md-12 text-center" >
            <button class="btn btn-lg btn-success" type="submit"><i class="fa fa-lg fa-save"></i>&nbsp;แจ้งซ่อม</button>
            <a href="<?= base_url('maintenance'); ?>" class="btn btn-lg  btn-danger" type="reset"><i class="fa fa-lg fa-times"></i>&nbsp;ยกเลิก</a>
        </div>
        <?= $form['form_close'] ?>
    </div>
</div>
